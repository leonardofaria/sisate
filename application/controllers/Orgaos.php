<?php

class Orgaos extends MY_Controller {

	public function __construct() {

    parent:: __construct(__CLASS__);
    $this->load->model('orgao');

	}

	function index() {

		$data['orgaos'] = $this->orgao->find(array(), array('ol' => 'ASC'));

		$this->pageTitle = 'Orgãos';
		$this->load->view('orgaos/index', $data);

	}

	function cadastrar() {

		$this->load->model('modalidade');

		$this->form_validation->set_rules($this->orgao->rules);

		if (!$this->form_validation->run()) {

			$data['modalidade_select_opts'] = $this->modalidade->select_opts();

			$this->pageTitle = 'Cadastrar Órgão';
			$this->load->view('orgaos/form', $data);

		} else {

			$dados = array(
				'ol' => $this->input->post('ol'),
				'nome' => $this->input->post('nome'),
				'modalidade' => $this->input->post('modalidade')
				);
			if ($this->orgao->adicionarOrgao($dados)) {
				$this->session->set_flashdata('message_success', 'Órgão cadastrado com sucesso!');
			} else {
				$this->session->set_flashdata('message_error', 'Houve um erro');
			}
			redirect(base_url('orgaos'));
		}

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
