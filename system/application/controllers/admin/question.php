<?php

class Question extends Controller {

	var $_menu;
	var $_editStatus;
	var $_rules;
	var $_actions;

	function Question()
	{
		parent::Controller();
		
		$this->load->model('Questions');		
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
			'name' => "trim|required|min_length[3]|max_length[45]|xss_clean",
			'title' => "trim|required|min_length[3]|max_length[70]|xss_clean",
			'question' => "trim|required|xss_clean",
			'answer' => "trim|required|xss_clean",
			'public' => "trim|required|integer"
		);
				
		//$this->output->enable_profiler(TRUE);
	}

	function index()
	{
		$this->_delete();
		
		$d['questions'] = $this->Questions->getAll();
		
		$this->load->view('admin/header', array('menu' => $this->_menu));
		$this->load->view('admin/questions', $d);
		$this->load->view('admin/footer');
	}
	
	function edit($id)
	{	
		$this->_edit();
		$p = $this->Questions->getOne($id);
		if(!empty($p))
		{			
			$this->load->view('admin/header', array('menu' => $this->_menu));
			$this->load->view('admin/edit_question', $p);
			$this->load->view('admin/footer');
		} else
			show_404();
	}
	
	/*function add()
	{	
		$this->_add();
		$p = array(
			'id' => '',
			'title' => '',
			'seo_url' => '',
			'description' => '',
			'content' => '',
			'categories_id' => ''
		);
		
		$p['articlesMenu'] = $this->_articlesMenu;
		$p['categories'] = $this->Categories->getMenuList();		
			
		$this->load->view('admin/header', array('menu' => $this->_menu));
		$this->load->view('admin/articles_menu', $p);
		$this->load->view('admin/add_edit_article', $p);
		$this->load->view('admin/footer');
	}*/
	
	function _edit()
	{	
		if($this->input->post('save'))
		{
			$this->validation->set_rules($this->_rules);
			if ($this->validation->run())
				if($this->Questions->update($this->input->post('id'), $this->_generateInput()))
					$this->_editStatus = 'Zmeny boli uspesne vykonane.';
		}
	}
	
	/*function _add()
	{
		$rules = $this->_rules;
		$rules['id'] = "trim";
		$rules['seo_url'] = "trim|required|min_length[3]|max_length[70]|alpha_dash";
		$this->validation->set_rules($rules);
		if ($this->validation->run())
		{
			$params = $this->_generateInput();
			$params['admin_accounts_id'] = 1;
			if($this->Articles->add($params))
				$this->_editStatus = 'Clanok bol ulozeny.';
		}
	}*/
	
	function _generateInput()
	{
		return array(
			'name' => $this->input->post('name'),
			'title' => $this->input->post('title'),
			'question' => $this->input->post('question'),
			'answer' => $this->input->post('answer'),
			'public' => $this->input->post('public')
		);
	}
	
	function _delete()
	{
		if($this->input->post('delete'))
			$this->Questions->delete($this->input->post('id'));
	}
	
}

/* End of file question.php */
/* Location: ./system/application/controllers/admin/question.php */