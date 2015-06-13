<?php

class Orgaos extends MY_Controller {

	public function __construct() {

    parent:: __construct(__CLASS__);
    $this->load->model('orgao');

	}

	function index() {

		$data['orgaos'] = $this->orgao->find();

		$this->pageTitle = 'Orgãos';
		$this->load->view('orgaos/index', $data);

	}

	function atualizar() {

		$id = $this->input->post('pk');
		$name = $this->input->post('name');
		$value = $this->input->post('value');

		if ($this->orgao->update($id, $name, $value)) {
			return true;
		} else {
			return false;
		}

	}
}

?>