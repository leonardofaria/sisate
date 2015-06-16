<?php

class Api extends MY_Controller {

	public function __construct() {

    parent:: __construct(__CLASS__);
    $this->layout = 'No';

	}

	function modalidades() {

		$this->load->model('modalidade');

		$modalidades = $this->modalidade->find();

		$json = array();
		foreach ($modalidades as $modalidade) {
			$json[$modalidade->getId()] = utf8_encode($modalidade->getNome());
		}

		echo json_encode($json);

	}

	function orgaos() {

		$this->load->model('orgao');

		$orgaos = $this->orgao->find();

		$json = array();
		foreach ($orgaos as $orgao) {
			$json[$orgao->getId()] = $orgao->getOl() . " - " . utf8_encode($orgao->getNome());
		}

		echo json_encode($json);

	}

	function processos() {

		$this->load->model('orgao');
		$this->load->model('processo');

		if(isset($_GET["offset"])) {
			$page = $_GET["offset"];
		} else {
			$page = 0;
		}

		if(isset($_GET["sort"])) {
			if ($_GET["sort"] == 'link') {
				$sort = "nb";
			} else if ($_GET["sort"] == 'data') {
				$sort = "criado";
			} else {
				$sort = $_GET["sort"];
			}

		} else {
			$sort = "criado";
		}

		if(isset($_GET["order"])) {
			$order = $_GET["order"];
		} else {
			$order = "desc";
		}

		$orgao = $this->orgao->find(array('ol' => $this->ol))[0];
		$per_page = 10;

		$processos = $this->processo->find(array('orgaoatual' => $orgao->getId()), array($sort => $order), $page, $per_page);

		$total = $this->processo->count(array('orgaoatual' => $orgao->getId()), array(), $page);

		$result = array('total' => $total);
		$json = array();

		foreach ($processos as $processo) {
			if ($processo->getNb()) {
				$objeto = $processo->getNb();
			} else {
				$objeto = $processo->getCtc();
			}

			$evento = $processo->getProcessoEventos()[0]->getEvento()->getNome();
			if ($processo->getProcessoEventos()[0]->getComplemento()) {
				$evento .= ' - ' . $processo->getProcessoEventos()[0]->getComplemento();
			}
			$json[] = array(
				'id' => $processo->getId(),
				'link' => '<a href="' . base_url('processos/visualizar/' . $processo->getId()) . '">' . $this->inss->formataProtocolo($objeto) . '</a>',
				'objeto' => $this->inss->formataProtocolo($objeto),
				'data' => $processo->getCriado(),
				'evento' => $evento,
				'orgao' => $processo->getOrgaoResponsavel()->getNome()
				);
		}
		$result['rows'] = $json;

		echo json_encode($result);

	}

	function perfis() {

		$this->load->model('perfil');

		$perfis = $this->perfil->find();

		$json = array();
		foreach ($perfis as $perfil) {
			$json[$perfil->getId()] = utf8_encode($perfil->getNome());
		}

		echo json_encode($json);
	}
}
