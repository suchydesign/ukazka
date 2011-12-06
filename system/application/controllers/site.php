<?php

class Site extends Controller {

	var $_mainMenu;
	var $_categories;
	var $_actions;
	var $_editStatus;
	var $_panelLimit = 3;

	function Site()
	{
		parent::Controller();	
		$this->load->model('Pages');
		$this->load->model('Articles');
		$this->load->model('Categories');
		$this->load->model('Users');
		$this->load->model('Files');
		$this->load->model('Questions');
		$this->load->helper('form');
		$this->load->library('validation');
		$this->load->config('admin_menu');
		
		$this->_mainMenu = $this->Pages->getMenuList();
		$this->_categories = $this->Categories->getMenuList();
		
		$this->_actions = $this->config->item('admin_actions');
		
		$this->_login();
		//$this->output->enable_profiler(TRUE);
	}
	
	function index($page = 'o-asociacii')
	{
		$p = $this->Pages->getOne($page);
		if(!empty($p))
		{
			if(!$p['login'] or $this->_isLoged())
			{			
				if($this->_isLoged()) 
				{
					$p['files'] = $this->Files->getAllByPageId($p['id']);
				} 
				else
				{
					$p['files'] = $this->Files->getAllPublicByPageId($p['id']);
				}	
				$p['menu'] = $this->_mainMenu;
				$p['categories'] = $this->_categories;
				$p['articles']['news'] = $this->Articles->getAllByCategory(1, $this->_panelLimit);
				$p['articles']['activities'] = $this->Articles->getAllByCategory(2, $this->_panelLimit);
				$p['page'] = $page;
				if($page == 'o-asociacii')
					$p['header_text'] = $this->Pages->getOneById(11);
				$this->load->view('page', $p);
			}
			else
				$this->login();			
		} 
		else
			show_404();
	}
	
	function articles($cid, $pg = 0)
	{
		$ppg = 10;
	    $p = $this->Categories->getOne($cid);
	    if(!empty($p)) {
	        $p['artcls'] = $this->Articles->getAllByCategory($cid, $ppg, $pg);
			if(!empty($p['artcls']))
			{
				$this->load->library('pagination');
				if($cid == 1)
					$config['base_url'] = base_url() . 'aktuality/';
				else
					$config['base_url'] = base_url() . 'aktivity/';
					
				$config['total_rows'] = $this->Articles->getTotal($cid);
				$config['per_page'] = $ppg;			
				$config['uri_segment'] = 2;	
				$this->pagination->initialize($config);
								
				$p['pagination'] = $this->pagination->create_links();
				$p['menu'] = $this->_mainMenu;
				$p['categories'] = $this->_categories;
				$p['articles']['news'] = $this->Articles->getAllByCategory(1, $this->_panelLimit);
				$p['articles']['activities'] = $this->Articles->getAllByCategory(2, $this->_panelLimit);
				$this->load->view('category', $p);
			} 
			else
				show_404();
		} 
		else
		    show_404();
	}

 	function article($aid)
 	{
        $p = $this->Articles->getOne($aid);
		if(!empty($p))
		{
			$p['menu'] = $this->_mainMenu;
			$p['categories'] = $this->_categories;
			$p['articles']['news'] = $this->Articles->getAllByCategory(1, $this->_panelLimit);
			$p['articles']['activities'] = $this->Articles->getAllByCategory(2, $this->_panelLimit);
			$p['page'] = '';
			$this->load->view('page', $p);
		} 
		else
			show_404();
	}
	
	function download($file = '')
	{
	    $f = $this->Files->getOne($file);
	    if(!empty($f))
	    {
	    	if($f['public'] or $this->_isLoged())
	    	{
				$file = $f['path'];
			    $this->load->helper('download');
				$data = file_get_contents(FTP_FILES . $file);
				force_download($file, $data);
			}
			else
				$this->login();
		} 
		else
		    show_404();
		
	}
	
	function questions()
	{
		$this->_add_question();
		$this->load->model('Questions');
		$q['title'] = 'Otázky a odpovede';
		$q['questions'] = $this->Questions->getAllPublic();
		$q['menu'] = $this->_mainMenu;
		$q['categories'] = $this->_categories;
		$q['articles']['news'] = $this->Articles->getAllByCategory(1, $this->_panelLimit);
		$q['articles']['activities'] = $this->Articles->getAllByCategory(2, $this->_panelLimit);
		$this->load->view('questions', $q);
	}
	
	function _add_question()
	{
		$this->_rules = array(
			'name' => "trim|required|min_length[3]|max_length[45]|xss_clean",
			'title' => "trim|required|min_length[3]|max_length[70]|xss_clean",
			'question' => "trim|required|xss_clean"
		);
		if($this->input->post('save'))
		{
			$this->validation->set_rules($this->_rules);
			if ($this->validation->run())
			{
				$params['name'] = $this->input->post('name');
				$params['title'] = $this->input->post('title');
				$params['question'] = $this->input->post('question');
				$params['ip'] = $this->input->ip_address();
				if($this->Questions->add($params))
				{
					$this->_editStatus = 'Zmeny boli uspesne vykonane.';
					$_POST = array();
				}
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
			if($this->Users->login($this->input->post('name'), $this->input->post('pass')))
			{
				$this->session->set_userdata('login', true);
				if($this->input->post('where'))
					redirect($this->input->post('where'));
			}
	}
	
	function _isLoged()
	{
		if($this->session->userdata('login'))
			return true;
		return false;
	}
	
	function logout()
	{
		$this->session->unset_userdata('login');
		redirect('');
	}
	
}

/* End of file welcome.php */
/* Location: ./system/application/controllers/welcome.php */