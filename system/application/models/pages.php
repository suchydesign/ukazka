<?php

class Pages extends Model {

	var $_tblName = 'static_pages';

	function Pages()
	{
		parent::Model();
	}

	function getMenuList()
	{
		$result = array();
		$q = $this->db->select('title, seo_url')
					  ->from($this->_tblName)
					  ->get();
					  
		foreach($q->result_array() as $row)
		    $result[] = $row;

		return $result;
	}
	
	function getAll()
	{
		$result = array();
		$q = $this->db->from($this->_tblName)
					  ->order_by('title', 'asc')
					  ->get();
					  
		foreach($q->result_array() as $row)
		    $result[] = $row;

		return $result;
	}

	function getOne($page)
	{
	    $result = array();
		$q = $this->db->get_where($this->_tblName, array('seo_url' => $page), 1);
					  
		if($q->num_rows() == 1)
		{
			$result = $q->result_array();
			return $result[0];
		}

		return $result;
	}
	
	function getOneById($id)
	{
	    $result = array();
		$q = $this->db->get_where($this->_tblName, array('id' => $id), 1);
					  
		if($q->num_rows() == 1)
		{
			$result = $q->result_array();
			return $result[0];
		}

		return $result;
	}
	
	function add($params)
	{
		if($this->db->insert($this->_tblName, $params))
		    return true;
		else
		    return false;
	}
	
	function update($id, $params)
	{
		if($this->db->where('id', $id)
					  ->update($this->_tblName, $params))
			return true;
		else
		    return false;
	}
	
	function delete($id)
	{
		if($this->db->where('id', $id)
					->limit(1)
					->delete($this->_tblName))
			return true;
		else
		    return false;
	}

}

/* End of file pages.php */
/* Location: ./system/application/models/pages.php */