<?php

class Categories extends Model {

	var $_tblName = 'categories';

	function Categories()
	{
		parent::Model();
	}

	function getMenuList()
	{
		$result = array();
		$q = $this->db->select('id, title, seo_url')
					  ->from($this->_tblName)
					  ->get();

		foreach($q->result_array() as $row)
		    $result[] = $row;

		return $result;
	}

	function getOne($page)
	{
	    $result = array();
		$q = $this->db->get_where($this->_tblName, array('id' => $page), 1);

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

	function update($params)
	{
		if($this->db->where('id', $params['cid'])
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

/* End of file categories.php */
/* Location: ./system/application/models/categories.php */