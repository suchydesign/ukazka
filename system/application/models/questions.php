<?php

class Questions extends Model {

	var $_tblName = 'questions';

	function Questions()
	{
		parent::Model();
	}

	function getOne($id)
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
		$q = $this->db->order_by('id', 'desc')->get($this->_tblName);
					  
		foreach($q->result_array() as $row)
		    $result[] = $row;

		return $result;
	}
	
	function getAllPublic()
	{
		$result = array();
		$q = $this->db->order_by('id', 'desc')->get_where($this->_tblName, array('public' => 1));
		foreach($q->result_array() as $row)
		    $result[] = $row;

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

/* End of file questions.php */
/* Location: ./system/application/models/questions.php */