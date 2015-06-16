<?php

class Ajuda extends MY_Controller {

	public function __construct() {

    parent:: __construct(__CLASS__);
    $this->load->model('perfil');

	}

	function index() {

		$data['siape'] = $this->siape;
		$data['ol'] = $this->ol;

		$this->pageTitle = 'Ajuda';
		$this->load->view('ajuda/index', $data);

	}
}
