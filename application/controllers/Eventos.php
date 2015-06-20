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

	function cadastrar() {

		$this->load->model('perfil');

		$this->form_validation->set_rules($this->evento->rules);

		if (!$this->form_validation->run()) {

			$data['perfil_select_opts'] = $this->perfil->select_opts();
			$data['documento_select_opts'] = array('' => 'Selecione', 'S' => 'Sim', 'N' => 'Não');

			$this->pageTitle = 'Cadastrar Evento';
			$this->load->view('eventos/form', $data);

		} else {

			$dados = array(
				'nome' => $this->input->post('nome'),
				'perfil' => $this->input->post('perfil'),
				'documento' => $this->input->post('documento')
				);
			if ($this->evento->adicionarEvento($dados)) {
				$this->session->set_flashdata('message_success', 'Evento cadastrado com sucesso!');
			} else {
				$this->session->set_flashdata('message_error', 'Houve um erro');
			}
			redirect(base_url('eventos'));
		}

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
