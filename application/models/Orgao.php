<?php

class Orgao extends MY_Model {

	public $rules = array(
		'nome' => array(
			'field' => 'nome',
			'label' => 'Nome',
			'rules' => 'required'
		),

		'ol' => array(
			'field' => 'ol',
			'label' => 'OL',
			'rules' => 'required'
		),

		'modalidade' => array(
			'field' => 'modalidade',
			'label' => 'Modalidade',
			'rules' => 'required'
		),
	);

	public function __construct() {
		parent::__construct();
	}

	public function adicionarOrgao($dados) {

		$orgao = $this->doctrine->em->getRepository('Entity\orgao');

		if (!$orgao->findBy(array('ol' => $dados['ol']))) {

			$orgao = new Entity\Orgao();
			$orgao->setOl($dados['ol']);

			$nome = $dados['nome'];
			if (strpos($nome, 'AGENCIA DA PREVIDENCIA SOCIAL') !== false) {
				$nome = str_replace('AGENCIA DA PREVIDENCIA SOCIAL', 'APS', $nome);
			}

			$orgao->setNome($nome);

			$modalidade_id = 1;
			if (strpos($dados['nome'], 'SECAO DE SAUDE DO TRABALHADOR') !== false) {
				$modalidade_id = 2;
			}
			$modalidade = $this->doctrine->em->getRepository('Entity\modalidade');
			$modalidade = $modalidade->findBy(array('id' => $modalidade_id))[0];
			$orgao->setModalidade($modalidade);

			$this->doctrine->em->persist($orgao);
			$this->doctrine->em->flush();

			return $orgao;

		} else {

			return $orgao->findBy(array('ol' => $dados['ol']));

		}

	}

}

?>