<?php

class Perfis extends MY_Controller {

	public function __construct() {

    parent:: __construct(__CLASS__);
    $this->load->model('perfil');

	}

	function index() {

		$data['perfis'] = $this->perfil->find(array(), array('nome' => 'ASC'));

		$this->pageTitle = 'Perfis';
		$this->load->view('perfis/index', $data);

	}

	function cadastrar() {

		$this->form_validation->set_rules($this->perfil->rules);

		if (!$this->form_validation->run()) {

			$this->pageTitle = 'Cadastrar Perfil';
			$this->load->view('perfis/form');

		} else {

			$dados = array(
				'nome' => $this->input->post('nome')
				);
			if ($this->perfil->adicionarPerfil($dados)) {
				$this->session->set_flashdata('message_success', 'Perfil cadastrado com sucesso!');
			} else {
				$this->session->set_flashdata('message_error', 'Houve um erro');
			}
			redirect(base_url('perfis'));
		}

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
