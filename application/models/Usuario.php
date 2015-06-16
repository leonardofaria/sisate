<?php

class Usuario extends MY_Model {

	public $rules = array(
		'siape' => array(
			'field' => 'siape',
			'label' => 'Siape',
			'rules' => 'trim|required|min_length[7]|max_length[7]',
			'errors' => array(
				'required' => 'É necessário informar o SIAPE',
				'min_length' => 'O SIAPE deve ter 7 dígitos',
				'max_length' => 'O SIAPE deve ter 7 dígitos',
			)
		),

		'nome' => array(
			'field' => 'nome',
			'label' => 'Nome',
			'rules' => 'trim|required',
			'errors' => array(
				'required' => 'É necessário informar o nome'
			)
		),

		'email' => array(
			'field' => 'email',
			'label' => 'E-mail',
			'rules' => 'trim|required',
			'errors' => array(
				'required' => 'É necessário informar o e-mail',
				'email' => 'E-mail inválido'
			)
		),

		'perfil' => array(
			'field' => 'perfil',
			'label' => 'Perfil',
			'rules' => 'trim|required',
			'errors' => array(
				'required' => 'É necessário informar o perfil'
			)
		),

		'orgao' => array(
			'field' => 'orgao',
			'label' => 'Orgão',
			'rules' => 'trim|required',
			'errors' => array(
				'required' => 'É necessário informar o órgão'
			)
		)
	);

	public function __construct() {
		parent::__construct();
	}

	public function autenticar($dados) {

		$usuario = $this->usuario->find(array('siape' => $dados['siape']));

		if (!$usuario) {
			return $this->adicionarUsuario($dados);
		} else {
			if (count($usuario) > 1) {
				return $usuario;
			} else {
				return $usuario[0];
			}
		}

	}


	public function adicionarUsuario($dados, $auto = true) {

		$this->load->model('orgao');
		$this->load->model('perfil');

		// Cadastro automático no primeiro acesso
		if ($auto) {
			// Força os médicos da GEXDIV se cadastrarem no SST
			if (strpos($dados['ol'], '11023') !== false) {
				$dados['ol'] = '11423000';
			}

			// Obtém ou cria o órgão do usuário
			if ($this->orgao->find(array('ol' => $dados['ol']))) {
				$orgao = $this->orgao->find(array('ol' => $dados['ol']))[0];
			} else {
				$dados_orgao = array('ol' => $dados['ol'], 'nome' => $dados['lotacao']);
				$orgao = $this->orgao->adicionarOrgao($dados_orgao);
			}

			// Atribui automaticamente o perfil de acordo com a lotação
			$perfil_id = 2;
			if (strpos($dados['lotacao'], 'SECAO DE SAUDE DO TRABALHADOR') !== false) {
				$perfil_id = 3;
			}
			if (strpos($dados['cargo'], 'MEDICO') !== false) {
				$perfil_id = 4;
			}
		} else {
			$orgao = $this->orgao->find(array('id' => $dados['orgao_id']))[0];
			$perfil_id = $dados['perfil_id'];
		}

		$usuario = new Entity\Usuario();
		$usuario->setSiape($dados['siape']);
		$usuario->setNome($dados['nome']);
		$usuario->setEmail($dados['email']);
		$usuario->setOrgao($orgao);

		$perfil = $this->perfil->find(array('id' => $perfil_id))[0];
		$usuario->setPerfil($perfil);
		$usuario->setCriado(new \DateTime("now"));

		$this->doctrine->em->persist($usuario);
		$this->doctrine->em->flush();

		return $usuario;

	}
}

?>