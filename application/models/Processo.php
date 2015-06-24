<?php

class Processo extends MY_Model {

	public $rules = array(
		'orgao_responsavel' => array(
			'field' => 'orgao_responsavel',
			'label' => 'Orgão responsável',
			'rules' => 'required'
		),

		'nb' => array(
			'field' => 'nb',
			'label' => 'Número do Benefício',
			'rules' => 'validar_protocolo',
			'errors' => array(
				'validar_protocolo' => 'O Número do Benefício é inválido'
			)
		),

		'ctc' => array(
			'field' => 'ctc',
			'label' => 'CTC',
			'rules' => 'validar_protocolo',
			'errors' => array(
				'validar_protocolo' => 'O número CTC é inválido'
			)
		),
	);

	public function inserir() {

		$config = array('upload_path' => './uploads/', 'allowed_types' => 'pdf', 'max_size' => '20480', 'multi' => 'all');
		$this->load->library('upload', $config);

		$orgao = $this->doctrine->em->getRepository('Entity\Orgao');
		$orgao = $orgao->findBy(array('id' => $this->orgao_id))[0];

		$evento = $this->doctrine->em->getRepository('Entity\Evento');
		$evento = $evento->findBy(array('id' => 1))[0];

		$processo = new Entity\Processo();
		if ($this->input->post('nb') != '')
		{
			$processo->setNb(return_numbers($this->input->post('nb')));
		}
		else if ($this->input->post('ctc') != '')
		{
			$processo->setCtc(return_numbers($this->input->post('ctc')));
		}
		else
		{
			return false;
		}

		$processo->setCriado(new \DateTime("now"));
		$processo->setModificado(new \DateTime("now"));
		$processo->setOrgaoresponsavel($orgao);
		$processo->setOrgaoatual($orgao);
		$this->doctrine->em->persist($processo);

		$processo_evento = new Entity\Processoevento();
		$processo_evento->setComplemento('');
		$processo_evento->setCriado(new \DateTime("now"));
		$processo_evento->setProcesso($processo);
		$processo_evento->setEvento($evento);
		$usuario = $this->doctrine->em->getRepository('Entity\Usuario');
		$usuario = $usuario->findBy(array('id' => $this->usuario_id))[0];
		$processo_evento->setUsuario($usuario);

		$processo->addProcessoEvento($processo_evento);

		$this->upload->do_upload('uploadedfiles');
    $uploaded = $this->upload->data();

    if ($uploaded['file_name']) {
    	$documentos = array($uploaded);
    } else {
    	$documentos = $uploaded;
    }

    foreach ($documentos as $doc) {

    	$documento = new Entity\Documento();
  		$documento->setNome($doc['file_name']);
  		$documento->setTamanho($doc['file_size']);
  		$processo_evento->addDocumento($documento);

    }

    $this->doctrine->em->persist($processo_evento);
		$this->doctrine->em->flush();

		return $processo->getId();

	}

	public function obterProcessos() {
		$data = array();

		/*
		$config = array();
    $config['base_url'] = base_url('processos/index/');
    $config['total_rows'] = $this->processo->count(array());
    $this->pagination->initialize($config);

    $page = ($this->uri->segment(3)) ? $this->uri->segment(3) : 0;
    $orgao = $this->orgao->find(array('ol' => $this->ol))[0];


    $data['pagination'] = $this->pagination->create_links();
		$data['processos'] = $this->processo->find(array('orgaoatual' => $orgao->getId()), array('criado' => 'DESC'), $page);
		*/

		// Processos no SST (Gestor)
		if ($this->orgao_modalidade_id == 2 && in_array($this->perfil_id, array(1, 3))) {
			$data['processos_usuarios'] = $this->processo->obterProcessosSST($this->ol);
		} else if ($this->orgao_modalidade_id == 2 && $this->perfil_id == 4) {
			// Processos no SST (Médico) - só carrega seus respectivos processos
			$data['processos_usuarios'] = array($this->nome => $this->processo->obterDistribuidos($this->nome));
		}

		return $data;
	}

	public function obterProcessosSST($ol) {

		$orgao = $this->orgao->find(array('ol' => $ol))[0];
		$perfil = $this->perfil->find(array('id' => 4))[0];
		$usuario = array('orgao' => $orgao, 'perfil' => $perfil);

		$usuarios = $this->usuario->select_opts($usuario);

		$processos_usuarios = array();
		foreach ($usuarios as $id => $nome) {
			if ($nome !== ' ' and $nome !== 'Selecione') {
				$processos_usuarios[$nome] = $this->processo->obterDistribuidos($nome);
			}
		}

		return $processos_usuarios;

	}

	public function obterDistribuidos($nome) {

		$this->load->model('processoevento');

		$processoeventos = $this->processoevento->find(array('complemento' => $nome));
		$processos = array();

		foreach ($processoeventos as $processoevento) {
			$complemento_ultimo_evento = $processoevento->getProcesso()->getProcessoEventos()[0]->getComplemento();
			$complemento = $processoevento->getComplemento();
			if ($complemento_ultimo_evento === $complemento) {
				$processos[] = $processoevento->getProcesso();
			}
		}

		return $processos;

	}

	public function buscarProcessos($busca) {

		return $this->processo->find(array('nb' => return_numbers($busca)));

	}
}
