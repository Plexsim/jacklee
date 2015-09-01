<?php
Class Story_Model extends CI_Model
{

	/********************************************************************
	story Custom functions
	********************************************************************/
	function __construct()
	{
			parent::__construct();
	}	
	
	function get_list()
	{		
		$res = $this->db->get('story');
		return $res->result_array();
	}
	
	function get_story($id)
	{
		$res = $this->db->where('id', $id)->get('story');
		return $res->row_array();
	}
	
	function save_story($data)
	{		
		if(!empty($data['id']) && isset($data['id']))
		{
			$this->db->where('id', $data['id'])->update('story', $data);
			return $data['id'];
		}
		else 
		{
			$this->db->insert('story', $data);
			return $this->db->insert_id();
		}
	}
	
	function delete_story($id)
	{
		$this->db->where('id', $id)->delete('story');
		return $id;
	}
	
	function display_one_story()
	{
		$res = $this->db->where('status', 'Enable')->order_by('sequence',"ASC")->get('story');				
		return $res->result_array();
	}
	
	
	
}