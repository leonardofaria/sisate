<?php

class Eventos extends MY_Controller {

	public function __construct() {

    parent:: __construct(__CLASS__);
    $this->load->model('evento');

	}

	function index() {

		$data['eventos'] = $this->evento->find();

		$this->pageTitle = 'Eventos';
		$this->load->view('eventos/index', $data);

	}

	function atualizar() {

		$id = $this->input->post('pk');
		$name = $this->input->post('name');
		$value = $this->input->post('value');

		if ($this->evento->update($id, $name, $value)) {
			return true;
		} else {
			return false;
		}

	}
}

?>