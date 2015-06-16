<?php

class Modalidades extends MY_Controller {

	public function __construct() {

    parent:: __construct(__CLASS__);
    $this->load->model('modalidade');

	}

	function index() {

		$data['modalidades'] = $this->modalidade->find();

		$this->pageTitle = 'Modalidades';
		$this->load->view('modalidades/index', $data);

	}

	function atualizar() {

		$id = $this->input->post('pk');
		$name = $this->input->post('name');
		$value = $this->input->post('value');

		if ($this->modalidade->update($id, $name, $value)) {
			return true;
		} else {
			return false;
		}

	}
}
