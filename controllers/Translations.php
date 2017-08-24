<?php

Class Translations extends CI_Controller
{
	public function __construct()
	{
		parent::__construct();
		$this->load->model('translation_model');
	}

	public function index()
	{
		$res["response"] = $this->translation_model->getTranslations();
		$this->load->view('translations/index',$res);
	}

	public function view()
	{
		$res["response"] = $this->translation_model->getTranslationsVar2();
		$res["title"] = 'translations archive';
		$this->load->view('translations/view',$res);
	}
	
}