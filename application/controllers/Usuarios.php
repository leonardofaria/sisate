<?php

class Usuarios extends MY_Controller {

	public function __construct() {

    parent:: __construct(__CLASS__);
    $this->load->model('usuario');

	}

	function index() {

		$data['usuarios'] = $this->usuario->find();

		$this->pageTitle = 'Usuários';
		$this->load->view('usuarios/index', $data);

	}

	function cadastrar() {
		$this->load->model('orgao');
		$this->load->model('perfil');

		$this->form_validation->set_rules($this->usuario->rules);

		if (!$this->form_validation->run()) {

			$data['orgao_select_opts'] = $this->orgao->select_opts();
			$data['perfil_select_opts'] = $this->perfil->select_opts();

			$this->pageTitle = 'Cadastrar Usuário';
			$this->load->view('usuarios/form', $data);

		} else {

			$dados = array(
				'siape' => $this->input->post('siape'),
				'nome' => $this->input->post('nome'),
				'email' => $this->input->post('email'),
				'perfil_id' => $this->input->post('perfil'),
				'orgao_id' => $this->input->post('orgao'),
				);
			if ($this->usuario->adicionarUsuario($dados, false)) {
				$this->session->set_flashdata('message_success', 'Usuário cadastrado com sucesso!');
			} else {
				$this->session->set_flashdata('message_error', 'Houve um erro');
			}
			redirect(base_url('usuarios'));
		}

	}

	function atualizar() {

		$id = $this->input->post('pk');
		$name = $this->input->post('name');
		$value = $this->input->post('value');

		if ($this->usuario->update($id, $name, $value)) {
			return true;
		} else {
			return false;
		}

	}

}
