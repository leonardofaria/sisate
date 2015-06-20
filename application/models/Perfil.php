<?php

class Perfil extends MY_Model {

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

	public function adicionarPerfil($dados) {

		$perfil = new Entity\Perfil();
		$perfil->setNome($dados['nome']);

		$this->doctrine->em->persist($perfil);
		$this->doctrine->em->flush();

		return $perfil;

	}

}

?>