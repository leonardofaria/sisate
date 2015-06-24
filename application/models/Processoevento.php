<?php

class Processoevento extends MY_Model {

	public $rules = array(
		/*
		'evento' => array(
			'field' => 'evento',
			'label' => 'Evento',
			'rules' => 'required',
			'errors' => array(
				'required' => 'É necessário informar o evento'
			)
		),
		*/
	);

	public function adicionarEvento($processo_id, $evento_id, $complemento = '', $usuario_id = 1, $documentos = array(), $params = array()) {

		$this->load->model('evento');
		$this->load->model('processo');
		$this->load->model('orgao');
		$this->load->model('usuario');

		$processo = $this->processo->find(array('id' => $processo_id))[0];
		$evento = $this->evento->find(array('id' => $evento_id))[0];
		$orgao = $this->orgao->find(array('ol' => $this->ol))[0];

		$processo_evento = new Entity\ProcessoEvento();

		if (in_array($evento_id, array(4, 5)) and isset($complemento)) {
			$usuario = $this->usuario->find(array('id' => $complemento))[0];
			$complemento = $usuario->getNome();
		}
		$processo_evento->setComplemento($complemento);
		$processo_evento->setCriado(new \DateTime("now"));
		$processo_evento->setProcesso($processo);
		$processo_evento->setEvento($evento);

		$usuario = $this->usuario->find(array('id' => $this->usuario_id))[0];
		$processo_evento->setUsuario($usuario);

		// Altera o órgão atual em casos de encaminhamento
		if ($evento_id == 2 and isset($params['id_orgao_destino'])) {

			$orgao_destino = $this->orgao->find(array('id' => $params['id_orgao_destino']))[0];
			$processo->alterarOrgao($orgao_destino);

		}

		$processo->addProcessoEvento($processo_evento);
		$processo->setUltimoevento($evento);

		$config = array('upload_path' => './uploads/', 'allowed_types' => 'pdf', 'max_size' => '20480', 'multi' => 'all');
		$this->load->library('upload', $config);

		if ($this->upload->do_upload('uploadedfiles')) {

		  $uploaded = $this->upload->data();

		  if ($uploaded['file_name'] != "") {
		  	$documentos = array($uploaded);
		  } else {
		  	$documentos = $uploaded;
		  }

		  if (count($documentos) > 0) {
			  foreach ($documentos as $doc) {
			  	if (isset($doc['file_name'])) {
	  		  	$documento = new Entity\Documento();
	  				$documento->setNome($doc['file_name']);
	  				$documento->setTamanho($doc['file_size']);
	  				$processo_evento->addDocumento($documento);
			  	}
			  }
		  }
		}

    $this->doctrine->em->persist($processo_evento);
		$this->doctrine->em->flush();

		// Faz o encaminhamento do processo nos casos de
		// análise concluída e cadastramento de exigência
		if (in_array($evento_id, array(6, 7)) && $orgao->getModalidade()->getId() == 2) {
			$params = array('id_orgao_destino' => $processo->getOrgaoResponsavel()->getId());
			$complemento = 'De ' . $this->ol . ' para ' . $processo->getOrgaoResponsavel()->getOl();
			$this->processoevento->adicionarEvento($processo_id, 2, $complemento, 1, array(), $params);
		}

		return $processo->getId();

	}

}