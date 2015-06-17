<?php

class Processos extends MY_Controller {

	public function __construct() {

    parent::__construct(__CLASS__);
    $this->load->model('Processo', 'processo');
    $this->load->model('orgao');

	}

	function index() {

		$this->load->model('usuario');
		$this->load->model('perfil');

		$data = $this->processo->obterProcessos();

		$this->pageTitle = 'Processos';
		$this->load->view('processos/index', $data);

	}

	function buscar() {

		$data['processos'] = $this->processo->buscarProcessos($this->input->post('busca'));
		$this->pageTitle = 'Buscar: ' . $this->input->post('busca');

		if (count($data['processos']) > 1)
		{
			$this->load->view('processos/buscar', $data);
		}
		else if (count($data['processos']) == 1)
		{
			$id = $data['processos'][0]->getId();
			redirect(base_url('processos/visualizar/' . $id));
		}
		else
		{
			$this->session->set_flashdata('message_error', 'Nenhum processo encontrado');
			redirect(base_url());
		}

	}

	function cadastrar() {

		$this->form_validation->set_rules($this->processo->rules);

		if (!$this->form_validation->run())
		{
			$data['select_opts'] = $this->orgao->select_opts();

			$this->pageTitle = 'Cadastrar Processo';
			$this->load->view('processos/form', $data);
		}
		else
		{

			$id = $this->processo->inserir();
			$this->session->set_flashdata('message_success', 'Processo cadastrado com sucesso!');
			redirect(base_url('processos/visualizar/' . $id));
		}

	}

	function visualizar() {

		$this->load->model('evento');
		$this->load->model('perfil');
		$this->load->model('usuario');

		$id = $this->uri->segment(3);

		$data['processo'] = $this->processo->find(array('id' => $id))[0];
		$perfil = $this->perfil->find(array('id' => $this->perfil_id))[0];
		$data['evento_select_opts'] = $this->evento->select_opts(array('perfil' => $perfil, 'ativo' => 'S'));
		$data['orgao_select_opts'] = $this->orgao->select_opts();

		$orgao = $this->orgao->find(array('ol' => $this->ol))[0];
		$perfil = $this->perfil->find(array('id' => 4))[0];
		$usuario = array('orgao' => $orgao, 'perfil' => $perfil);
		$data['complemento_select_opts'] = $this->usuario->select_opts($usuario);

		$data['id'] = $id;
		$data['siape'] = $this->siape;
		$data['orgao_id'] = $this->orgao_id;

		if ($data['processo']->getNb())
		{
			$objeto = $this->inss->formataProtocolo($data['processo']->getNb());
		}
		else
		{
			$objeto = $this->inss->formataProtocolo($data['processo']->getCtc());
		}
		$this->pageTitle = 'Processo ' . $objeto;
		$this->load->view('processos/visualizar', $data);
		$this->load->view('processos/form_analisar', $data);
		$this->load->view('processos/form_encaminhar', $data);

	}

	function encaminhar() {

		$this->load->model('processoevento');

		$id = $this->uri->segment(3);

		$params = array('id_orgao_destino' => $this->input->post('orgao'));
		$orgao = $this->orgao->find(array('id' => $this->input->post('orgao')))[0];
		$complemento = 'De ' . $this->ol . ' para ' . $orgao->getOl();
		$this->processoevento->adicionarEvento($id, 2, $complemento, 1, array(), $params);

		$this->session->set_flashdata('message_success', 'Processo encaminhado com sucesso!');
		redirect(base_url('processos/visualizar/' . $id));

	}

	function analisar() {

		$this->load->model('processoevento');
		$id = $this->uri->segment(3);

		$this->processoevento->adicionarEvento($id, $this->input->post('evento'), $this->input->post('complemento'), 1);

		$this->form_validation->set_rules($this->processoevento->rules);

		if (!$this->form_validation->run())
		{
			echo "Erro";
		}

		$this->session->set_flashdata('message_success', 'Evento lançado com sucesso!');
		redirect(base_url('processos/visualizar/' . $id));

	}
}