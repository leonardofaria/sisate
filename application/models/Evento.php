<?php

class Evento extends MY_Model {

	public $rules = array(
		'nome' => array(
			'field' => 'nome',
			'label' => 'Nome',
			'rules' => 'trim|required'
		),

		'perfil' => array(
			'field' => 'perfil',
			'label' => 'Perfil',
			'rules' => 'trim|required'
		)
	);

	public function __construct() {
		parent::__construct();
	}

	public function adicionarEvento($dados) {

		$this->load->model('perfil');

		$evento = new Entity\Evento();
		$evento->setNome($dados['nome']);
		$evento->setAtivo('S');
		$evento->setDocumento($dados['documento']);

		$perfil = $this->perfil->find(array('id' => $dados['perfil']))[0];
		$evento->setPerfil($perfil);

		$this->doctrine->em->persist($evento);
		$this->doctrine->em->flush();

		return $evento;

	}

}

?>