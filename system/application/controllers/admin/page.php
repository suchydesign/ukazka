<?php

class Page extends Controller {

	var $_menu;
	var $_editStatus;
	var $_actions;

	function Page()
	{
		parent::Controller();
				
		$this->load->model('Pages');
		$this->load->model('Files');
		$this->load->model('Users');		
		$this->load->helper('form');		
		$this->load->library('validation');		
		$this->config->load('admin_menu');		
		$this->_menu = $this->config->item('admin_menu');	
		
		$this->_login();
		if(!$this->session->userdata('admin') and current_url() != site_url('admin/page/login'))
		{
			redirect('admin/page/login');
			exit;
		}
		
		$this->_actions = $this->config->item('admin_actions');
			
		//$this->output->enable_profiler(TRUE);
	}

	function index()
	{
		$d['pagesList'] = $this->Pages->getAll();
		$this->load->view('admin/header', array('menu' => $this->_menu));
		$this->load->view('admin/pages', $d);
		$this->load->view('admin/footer');
	}
	
	function edit($page)
	{	
		$this->_edit();
		$p = $this->Pages->getOne($page);
		if(!empty($p))
		{
			$p['files'] = $this->Files->getAllByPageId($p['id']);
		
			$this->load->view('admin/header', array('menu' => $this->_menu));
			$this->load->view('admin/add_edit_page', $p);
			$this->load->view('admin/footer');
		} else
			show_404();
	}
	
	function _edit()
	{
		if($this->input->post('save'))
		{
			$rules['id'] = "required|integer";
			$rules['title'] = "trim|required|min_length[3]|max_length[70]|xss_clean";
			$rules['description'] = "trim|xss_clean";
			$rules['content'] = "trim|required";
			
			$this->validation->set_rules($rules);
				
			if ($this->validation->run())
			{
				$params = array(
					'title' => $this->input->post('title'),
					'description' => $this->input->post('description'),
					'content' => $this->input->post('content')
				);
				if($this->Pages->update($this->input->post('id'), $params))
					$this->_editStatus = 'Stránka bola uložená.';
			}
		}
	}
	
	function login()
	{
		$this->load->view('login');
	}
	
	function _login()
	{
		if($this->input->post('login'))
			if($this->Users->adminLogin($this->input->post('name'), $this->input->post('pass')))
			{
				$this->session->set_userdata('admin', true);
				$this->session->set_userdata('login', true);
				redirect('admin');
			}
	}
	
	function logout()
	{
		$this->session->unset_userdata('admin');
		$this->session->unset_userdata('login');
		redirect(site_url('admin'));
	}
	
}

/* End of file page.php */
/* Location: ./system/application/controllers/admin/page.php */