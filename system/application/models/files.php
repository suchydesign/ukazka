<?php

class Files extends Model {

	var $_tblName = 'files';

	function Files()
	{
		parent::Model();
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
	
	function getAll()
	{
	    $result = array();
		$q = $this->db->order_by('name', 'asc')->get($this->_tblName);

		foreach($q->result_array() as $row)
		    $result[] = $row;
		    
		return $result;
	}
	
	function getAllPublic()
	{
	    $result = array();
		$q = $this->db->order_by('name', 'asc')->get_where($this->_tblName, array('public' => 1));

		foreach($q->result_array() as $row)
		    $result[] = $row;
		    
		return $result;
	}
	
	function getAllUnpublic()
	{
	    $result = array();
		$q = $this->db->order_by('name', 'asc')->get_where($this->_tblName, array('public' => 0));

		foreach($q->result_array() as $row)
		    $result[] = $row;
		    
		return $result;
	}
	
	function getAllPublicByPageId($pid)
	{
	    $result = array();
		$q = $this->db->order_by('name', 'asc')->get_where($this->_tblName, array('public' => 1, 'static_pages_id' => $pid));

		foreach($q->result_array() as $row)
		    $result[] = $row;
		    
		return $result;
	}
	
	function getAllByPageId($pid)
	{
	    $result = array();
		$q = $this->db->order_by('name', 'asc')->get_where($this->_tblName, array('static_pages_id' => $pid));

		foreach($q->result_array() as $row)
		    $result[] = $row;
		    
		return $result;
	}
	
	function exists($name)
	{
		$q = $this->db->get_where($this->_tblName, array('seo_url' => $name), 1);

		if($q->num_rows() == 1)
		{
			return true;
		}

		return false;
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
		            ->limit(1)
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

/* End of file files.php */
/* Location: ./system/application/models/files.php */