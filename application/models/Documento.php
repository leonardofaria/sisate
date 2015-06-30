<?php

class Documento extends MY_Model {

	public function __construct() {
		parent::__construct();
	}

	public function excluirProcessoInicial($processo_id) {

		$this->load->model('processo');
		$processo = $this->processo->find(array('id' => $processo_id))[0];

		foreach ($processo->getProcessoEventos() as $evento) {
			if ($evento->getEvento()->getId() === 1) {

				$documentos = $evento->getDocumentos();
				foreach ($documentos as $documento) {
					$this->load->model('documento');
					$this->documento->delete($documento->getId());
					unlink(FCPATH . 'uploads/' . $documento->getNome());
				}
			}
		}

	}

}

?>