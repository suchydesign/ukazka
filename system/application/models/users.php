<?php

class Users extends Model {

	var $_tblName = 'admin_accounts';

	function Users()
	{
		parent::Model();
	}

	function getAllByType($type)
	{
	    $result = array();
		$q = $this->db->order_by('name', 'asc')->get_where($this->_tblName, array('type' => $type));

		foreach($q->result_array() as $row)
			$result[] = $row;

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
	
	function exists($name)
	{
		$q = $this->db->get_where($this->_tblName, array('name' => $name), 1);

		if($q->num_rows() == 1)
		{
			return true;
		}

		return false;
	}
	
	function login($name, $pass)
	{
		$q = $this->db->get_where($this->_tblName, array('name' => $name, 'pass' => sha1($pass)), 1);

		if($q->num_rows() == 1)
		{
			return true;
		}

		return false;
	}
	
	function adminLogin($name, $pass)
	{
		$q = $this->db->get_where($this->_tblName, array('name' => $name, 'pass' => sha1($pass), 'type' => 'a'), 1);

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

/* End of file users.php */
/* Location: ./system/application/models/users.php */