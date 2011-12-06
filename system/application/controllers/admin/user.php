<?php

class User extends Controller {

	var $_menu;
	var $_editStatus;
	var $_rules;
	var $_actions;

	function User()
	{
		parent::Controller();
		
		$this->load->model('Users');		
		$this->load->helper('form');		
		$this->load->library('validation');		
		$this->config->load('admin_menu');
		
		if(!$this->session->userdata('admin') and current_url() != site_url('admin/page/login'))
		{
			redirect('admin/page/login');
			exit;
		}
		
		$this->_actions = $this->config->item('admin_actions');
		
		$this->_menu = $this->config->item('admin_menu');
		$this->_rules = array(
			'id' => "required|integer",
			'type' => "trim|required|xss_clean",
			'pass' => "min_length[6]|matches[pass2]",
			'pass2' => "matches[pass]"
		);
	
		//$this->output->enable_profiler(TRUE);
	}

	function index($type = '')
	{
		$this->_delete();
		if($type != '')
		{
			$d['users'] = $this->Users->getAllByType($type);
			$d['name'] = ($type == 'u') ? 'Používatelia' : 'Administrátori';
		}
		else
		{
			$d['users'] = $this->Users->getAll();
			$d['name'] = "Všetci";	
		}	
		
		$this->load->view('admin/header', array('menu' => $this->_menu));
		$this->load->view('admin/users_menu', $d);
		$this->load->view('admin/users', $d);
		$this->load->view('admin/footer');
	}
	
	function edit($id)
	{	
		$this->_edit();
		$p = $this->Users->getOne($id);
		if(!empty($p))
		{	
			$this->load->view('admin/header', array('menu' => $this->_menu));
			$this->load->view('admin/users_menu', $p);
			$this->load->view('admin/edit_user', $p);
			$this->load->view('admin/footer');
		} else
			show_404();
	}
	
	function add()
	{	
		$this->_add();		
		$p['name'] = 'Pridaj';
		
		$this->load->view('admin/header', array('menu' => $this->_menu));
		$this->load->view('admin/users_menu', $p);
		$this->load->view('admin/add_user');
		$this->load->view('admin/footer');
	}
	
	function _edit()
	{	
		if($this->input->post('save'))
		{
			$this->validation->set_rules($this->_rules);
			if ($this->validation->run())
			{
				$params = $this->_generateInput();
				if($this->input->post('pass'))
					$params['pass'] = sha1($this->input->post('pass'));
					
				if($this->Users->update($this->input->post('id'), $params))
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
			$rules['name'] = "callback_username_check|trim|required|min_length[3]|max_length[45]|xss_clean";
			$rules['pass'] = "required|min_length[6]";
			$rules['pass2'] = "required|matches[pass]";
			$this->validation->set_rules($rules);
			if ($this->validation->run())
			{
				$params = $this->_generateInput();
				$params['name'] = $this->input->post('name');
				$params['pass'] = sha1($this->input->post('pass'));
				if($this->Users->add($params))
				{
					$this->_editStatus = 'Používateľ bol pridaný.';
					$_POST = array();
				}
			}
		}
	}
	
	function _generateInput()
	{
		return array(
			'type' => $this->input->post('type')
		);
	}
	
	function _delete()
	{
		if($this->input->post('delete'))
			$this->Users->delete($this->input->post('id'));
	}
	
	function username_check($str)
	{
		if ($this->Users->exists($str))
		{
			$this->validation->set_message('username_check', "Používateľ s menom '$str' už existuje.");
			return FALSE;
		}
		else
		{
			return TRUE;
		}
	}
}

/* End of file user.php */
/* Location: ./system/application/controllers/admin/user.php */