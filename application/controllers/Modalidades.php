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

	function cadastrar() {

		$this->form_validation->set_rules($this->modalidade->rules);

		if (!$this->form_validation->run()) {

			$this->pageTitle = 'Cadastrar Modalidade';
			$this->load->view('modalidades/form');

		} else {

			$dados = array(
				'nome' => $this->input->post('nome')
				);
			if ($this->modalidade->adicionarModalidade($dados)) {
				$this->session->set_flashdata('message_success', 'Modalidade cadastrada com sucesso!');
			} else {
				$this->session->set_flashdata('message_error', 'Houve um erro');
			}
			redirect(base_url('modalidades'));
		}

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
