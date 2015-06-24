<?php

class Erros extends CI_Controller {

	public function __construct() {

    parent:: __construct();
    $this->layout = false;

	}

	function erro404() {

		$this->output->set_status_header('404');
    $this->load->view('erros/erro404');

	}
}
