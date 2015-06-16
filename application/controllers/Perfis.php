<?php

class Perfis extends MY_Controller {

	public function __construct() {

    parent:: __construct(__CLASS__);
    $this->load->model('perfil');

	}

	function index() {

		$data['perfis'] = $this->perfil->find();

		$this->pageTitle = 'Perfis';
		$this->load->view('perfis/index', $data);

	}

	function atualizar() {

		$id = $this->input->post('pk');
		$name = $this->input->post('name');
		$value = $this->input->post('value');

		if ($this->perfil->update($id, $name, $value)) {
			return true;
		} else {
			return false;
		}

	}
}
