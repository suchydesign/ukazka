<?php

class Article extends Controller {

	var $_menu;
	var $_editStatus;
	var $_articlesMenu;
	var $_rules;
	var $_actions;

	function Article()
	{
		parent::Controller();
		
		$this->load->model('Articles');
		$this->load->model('Categories');		
		$this->load->helper('form');		
		$this->load->library('validation');		
		$this->config->load('admin_menu');
		
		if(!$this->session->userdata('admin') and current_url() != site_url('admin/page/login'))
		{
			redirect('admin/page/login');
			exit;
		}
		
		$this->_menu = $this->config->item('admin_menu');
		$this->_articlesMenu = $this->Categories->getMenuList();
		$this->_articlesMenu[] = array(
			'id' => '', 
			'title' => 'Všetky', 
			'seo_url' => ''
		);
		
		$this->_actions = $this->config->item('admin_actions');
		
		$this->_rules = array(
			'id' => "required|integer",
			'title' => "trim|required|min_length[3]|max_length[70]|xss_clean",
			'seo_url' => "callback_seo_url_check|trim|required|min_length[3]|max_length[70]|alpha_dash",
			'description' => "trim|xss_clean",
			'content' => "trim|required",
			'categories_id' => "trim|required|integer"
		);
				
		//$this->output->enable_profiler(TRUE);
	}

	function index($cid = '')
	{
		$this->_delete();
		if(is_numeric($cid) and $cid > 0)
		{
			$d['articles'] = $this->Articles->getAllByCategory($cid);
			$d['categories'] = $this->Categories->getOne($cid);
			if(empty($d['categories']))
				$d['categories']['title'] = 'Neexistuje';
		} else
		{
			$d['articles'] = $this->Articles->getAll();
			$d['categories']['title'] = 'Vsetky';
		}
			
		$d['articlesMenu'] = $this->_articlesMenu;
		
		$this->load->view('admin/header', array('menu' => $this->_menu));
		$this->load->view('admin/articles_menu', $d);
		$this->load->view('admin/articles', $d);
		$this->load->view('admin/footer');
	}
	
	function edit($page)
	{	
		$this->_edit();
		$p = $this->Articles->getOneById($page);
		if(!empty($p))
		{	
			$p['articlesMenu'] = $this->_articlesMenu;
			$p['categories'] = $this->Categories->getMenuList();
			
			$this->load->view('admin/header', array('menu' => $this->_menu));
			$this->load->view('admin/articles_menu', $p);
			$this->load->view('admin/add_edit_article', $p);
			$this->load->view('admin/footer');
		} else
			show_404();
	}
	
	function add()
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
	}
	
	function _edit()
	{	
		if($this->input->post('save'))
		{
			$rules = $this->_rules;
			$rules['seo_url'] = "trim|required|min_length[3]|max_length[70]|alpha_dash";
			$this->validation->set_rules($rules);
			if ($this->validation->run())
				if($this->Articles->update($this->input->post('id'), $this->_generateInput()))
					$this->_editStatus = 'Článok bol uložený.';
		}
	}
	
	function _add()
	{
		if($this->input->post('save'))
		{
			$rules = $this->_rules;
			$rules['id'] = "trim|xss_clean";
			$this->validation->set_rules($rules);
			if ($this->validation->run())
			{
				$params = $this->_generateInput();
				$params['admin_accounts_id'] = 1;
				if($this->Articles->add($params))
				{
					$this->_editStatus = 'Článok bol pridaný.';
					$_POST = array();
				}
			}
		}
	}
	
	function _generateInput()
	{
		return array(
			'title' => $this->input->post('title'),
			'seo_url' => $this->input->post('seo_url'),
			'description' => $this->input->post('description'),
			'content' => $this->input->post('content'),
			'categories_id' => $this->input->post('categories_id')
		);
	}
	
	function _delete()
	{
		if($this->input->post('delete'))
			$this->Articles->delete($this->input->post('id'));
	}
	
	function seo_url_check($str)
	{
		if ($this->Articles->exists($str))
		{
			$this->validation->set_message('seo_url_check', "Adresa '$str' už existuje.");
			return FALSE;
		}
		else
		{
			return TRUE;
		}
	}
	
}

/* End of file article.php */
/* Location: ./system/application/controllers/admin/article.php */