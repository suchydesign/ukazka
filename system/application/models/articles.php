<?php

class Articles extends Model {

	var $_tblName = 'articles';

	function Articles()
	{
		parent::Model();
	}

	function getAllByCategory($cid, $limit = 10, $page = 0)
	{
		if($limit == 0)
			$limit = $this->getTotal($cid);
	    $result = array();
		$q = $this->db->order_by('id', 'desc')
					  ->limit($limit, ($page) * $limit)
					  ->get_where($this->_tblName, array('categories_id' => $cid));

		foreach($q->result_array() as $row)
			$result[] = $row;

		return $result;
	}
	
	function getAll($limit = 10, $page = 0)
	{
		if($limit == 0)
			$limit = $this->getTotal();
		$result = array();
		$q = $this->db->order_by('id', 'desc')
					  ->limit($limit, ($page) * $limit)
					  ->get($this->_tblName);

		foreach($q->result_array() as $row)
			$result[] = $row;

		return $result;
	}
	
	function getTotal($cid = 0)
	{
		if($cid == 0)
		{
			$query = $this->db->query('SELECT * FROM ' . $this->_tblName);
			return $query->num_rows();
		}
		else
		{
			$query = $this->db->query('SELECT * FROM ' . $this->_tblName . ' where categories_id = ' . intval($cid));
			return $query->num_rows();
		}
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
	
	function getOneById($page)
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
	
	function exists($seo_url)
	{
		$q = $this->db->get_where($this->_tblName, array('seo_url' => $seo_url), 1);

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

/* End of file articles.php */
/* Location: ./system/application/models/articles.php */