<?php

class Modalidade extends MY_Model {

	public $rules = array(
		'nome' => array(
			'field' => 'nome',
			'label' => 'Nome',
			'rules' => 'required'
		)
	);

	public function __construct() {
		parent::__construct();
	}

	public function adicionarModalidade($dados) {

		$modalidade = new Entity\Modalidade();
		$modalidade->setNome($dados['nome']);

		$this->doctrine->em->persist($modalidade);
		$this->doctrine->em->flush();

		return $modalidade;

	}

}

?>