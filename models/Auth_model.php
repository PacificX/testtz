<?php

Class Auth_model extends CI_Model
{
	public function __construct()
	{
		$this->load->database();
	}

	public function authorisation()
	{
		$userinformation = $this->input->get();
		if (isset($userinformation["Login"]) && isset($userinformation["Pass"]))
		{
			$query = $this->db->get_where('accounts', array('Login' => $userinformation['Login']));
			if ($query->num_rows()>0)
			{
				$account = $query->result_array();
				if ($account[0]["Password"] === $userinformation["Pass"])
				{
					$token = 'A507HlcpODkc29'; // сюда вместо этой строки можно вставить функцию по генерации токенов 
					$data  = array(
						'Login' =>  $userinformation["Login"],
						'Token' => $token,
						'Expires_in' => time()+60*60*24
						);
					$this->db->insert('accounts_token',$data);
					return $token;
				}
				else 
				{
					return "A001";  // это код ошибки говорящий о том,что пароль не подходит
				}
			}
			else
			{
				return "A002"; // Такого пользователя не существует
			}
		}
		return  null; 
	}

	public function authorisation_token()
	{
		$userinformation = $this->input->get();
		if (isset($userinformation["Login"]) && isset($userinformation["Token"]))
		{
			$query = $this->db->get_where('accounts_token', array('Login' => $userinformation['Login'], 'Token' => 			  $userinformation['Token'] ));
			if ($query->num_rows()>0)
			{
				$info = $query->result_array();
				if ($info[0]['Expires_in'] <= time())
				{
					return 'A000'; // код ошибки показывающий что статус OK
				}
				else
				{
					return 'A004'; // код ошибки показывающий что истек срок давности токена
				}
			}	
			else
			{
				return 'A003'; // неправильный токен;
			}
		}
		return false;
	}


}