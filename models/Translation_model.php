<?php

Class Translation_Model extends CI_Model
{

	public function __construct()
	{
		$this->load->database();
	}

	public function getTranslations()
	{
		$response = $this->input->get();
		if(isset($response["id"]))
		{
			$query = $this->db->get_where('translations', array('id' => $response['id']));
			return $query->result_array();
		}
		$this->db->select('id,name');
		$query = $this->db->get('translations');
		return $query->result_array();
	}

	public function getTranslationsVar2()
	{
		$this->db->select('id,name');
		$query = $this->db->get('translations');
		return $query->result_array();
	}
}