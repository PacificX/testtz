<?php

Class Auth_token extends CI_Controller
{
	public function __construct()
	{
		parent::__construct();
		$this->load->model('auth_model');
	}

	public function index()
	{
		
	}

	public function auth()
	{
		$data["Token"] = $this->auth_model->authorisation();
		switch ($data["Token"])
		{
			case "A001":
			{
				$data["Success"] = FALSE;
				$data["Error_Text"] = 'Incorrent Login or password';
				break;
			}
			case "A002":
			{
				$data["Success"] = FALSE;
				$data["Error_Text"] = 'This user does not exist';
				break;
			}
			case null:
			{
				$data["Success"] = FALSE;
				$data["Error_Text"] = 'Unexpected error';
				break;	
			}
			default:
			{
				$data["Success"] = TRUE;
				$data["Error_Text"] = 'Operation success';
				break;
			}
		}
		return $this->output
			->set_content_type('application/json')
			->set_status_header(200)
			->set_output(json_encode($data
			));
	}

	public function token_auth()
	{
		$data["code"] = $this->auth_model->authorisation_token();
		switch ($data["code"])
		{
			case "A000":
			{
				$data["Success"] = TRUE;
				$data["Error_Text"] = 'Operation success';
				break;
			}
			case "A003":
			{
				$data["Success"] = FALSE;
				$data["Error_Text"] = 'Incorrect token';
				break;
			}
			case "A004":
			{
				$data["Success"] = FALSE;
				$data["Error_Text"] = 'The stature of the token expired';
				break;
			}
			default:
			{
				$data["Success"] = FALSE;
				$data["Error_Text"] = 'Unexpected error';
				break;
			}
		}
		return $this->output
			->set_content_type('application/json')
			->set_status_header(200)
			->set_output(json_encode($data
			));

	}
}

