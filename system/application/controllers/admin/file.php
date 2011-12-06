<?php

class File extends Controller {

	var $_menu;
	var $_editStatus;
	var $_rules;
	var $_uploadError;
	var $ftp_config;
	var $_actions;

	function File()
	{
		parent::Controller();
		
		$this->load->model('Files');
		$this->load->model('Pages');		
		$this->load->helper('form');		
		$this->load->library('validation');		
		$this->config->load('admin_menu');
		$this->load->library('ftp');
		
		if(!$this->session->userdata('admin') and current_url() != site_url('admin/page/login'))
		{
			redirect('admin/page/login');
			exit;
		}
		
		$this->_actions = $this->config->item('admin_actions');
		
		$this->ftp_config['hostname'] = 'apszsr.sk';
		$this->ftp_config['username'] = 'robotapsz';
		$this->ftp_config['password'] = 'KkmTZsfPFrLg';
		$this->ftp_config['debug'] = FALSE;
				
		$this->_menu = $this->config->item('admin_menu');		
		$this->_rules = array(
			'id' => "required|integer",
			'name' => "trim|required|min_length[3]|max_length[70]|xss_clean",
			'seo_url' => "trim|required|min_length[3]|max_length[70]|alpha_dash",
			'description' => "trim|xss_clean",
			'public' => "trim|integer",
			'static_pages_id' => "trim|integer"
		);
		
		$config['upload_path'] = FTP_FILES;
		$config['allowed_types'] = 'zip|rar|doc|docx|xls|xlsx|ppt|pptx|csv|ods|odt|odp|pdf|rtf|sxc|txt|gif|jpg|jpeg|png';
		$config['encrypt_name'] = TRUE;		
		$this->load->library('upload', $config);
	
		//$this->output->enable_profiler(TRUE);
	}

	function index($type = '')
	{
		$this->_delete();
		if(is_numeric($type))
		{
			if($type == 1)
				$d['files'] = $this->Files->getAllPublic($type);
			elseif($type == 0)
				$d['files'] = $this->Files->getAllUnpublic($type);
			
			$d['title'] = ($type == 1) ? 'Verejné' : 'Privátne';
		}
		else
		{
			$d['files'] = $this->Files->getAll();
			$d['title'] = "Všetky";	
		}	
		
		$this->load->view('admin/header', array('menu' => $this->_menu));
		$this->load->view('admin/files_menu', $d);
		$this->load->view('admin/files', $d);
		$this->load->view('admin/footer');
	}
	
	function edit($id)
	{	
		$this->_edit();
		
		$p = $this->Files->getOneById($id);
		if(!empty($p))
		{	
			$p['pages'] = $this->Pages->getAll();
			$p['title'] = $p['name'];
			$this->load->view('admin/header', array('menu' => $this->_menu));
			$this->load->view('admin/files_menu', $p);
			$this->load->view('admin/add_edit_file', $p);
			$this->load->view('admin/footer');
		} else
			show_404();
	}
	
	function add()
	{	
		$this->_add();		
		
		$p = array(
			'id' => '',
			'title' => 'Pridaj',
			'name' => '',
			'seo_url' => '',
			'description' => '',
			'content' => '',
			'categories_id' => '',
			'pages' => $this->Pages->getAll()
		);
		
		
		$this->load->view('admin/header', array('menu' => $this->_menu));
		$this->load->view('admin/files_menu', $p);
		$this->load->view('admin/add_edit_file', $p);
		$this->load->view('admin/footer');
	}
	
	function _edit()
	{	
		if($this->input->post('save'))
		{
			$f = $this->Files->getOneById($this->input->post('id'));			
			$this->validation->set_rules($this->_rules);
			if ($this->validation->run())
			{
				$params = $this->_generateInput();
				if(!$this->upload->do_upload('path'))
				{
					$u = $this->upload->data();
					if(!empty($u['file_name']))
						$this->_uploadError = $this->upload->display_errors();
				}				
				else
				{
					$u = $this->upload->data();
					$params['path'] = $u['file_name'];
					
					$this->ftp->connect($this->ftp_config);
					$this->ftp->delete_file($f['path']);
					$this->ftp->close();
				}
				if(empty($this->_uploadError))
					if($this->Files->update($this->input->post('id'), $params))
						$this->_editStatus = 'Zmeny boli uložené.';
			}
		}
	}
	
	function _add()
	{
		if($this->input->post('save'))
		{		
			$rules = $this->_rules;
			$rules['id'] = "";
			$rules['path'] = "";
			$rules['seo_url'] = "callback_filename_check|trim|required|min_length[3]|max_length[70]|alpha_dash";
			$this->validation->set_rules($rules);
			if ($this->validation->run())
			{		
				if(!$this->upload->do_upload('path'))
				{
					$this->_uploadError = $this->upload->display_errors();
				}
				else
				{
					$u = $this->upload->data();
					$params = $this->_generateInput();
					$params['path'] = $u['file_name'];
					if($this->Files->add($params))
					{
						$this->_editStatus = 'Súbor bol pridaný.';
						$_POST = array();
					}
				}
				
			}
		}
	}
	
	function _generateInput()
	{
		return array(
			'name' => $this->input->post('name'),
			'seo_url' => $this->input->post('seo_url'),
			'description' => $this->input->post('description'),
			'public' => $this->input->post('public'),
			'static_pages_id' => $this->input->post('static_pages_id') ? $this->input->post('static_pages_id') : NULL
		);
	}
	
	function _delete()
	{
		if($this->input->post('delete'))
		{
			$f = $this->Files->getOneById($this->input->post('id'));
			if($this->Files->delete($this->input->post('id')))
			{
				$this->ftp->connect($this->ftp_config);
				$this->ftp->delete_file($f['path']);
				$this->ftp->close();
			}
		}
	}
	
	function filename_check($str)
	{
		if ($this->Files->exists($str))
		{
			$this->validation->set_message('filename_check', "Súbor s adresou '$str' už existuje.");
			return FALSE;
		}
		else
		{
			return TRUE;
		}
	}
}

/* End of file file.php */
/* Location: ./system/application/controllers/admin/file.php */