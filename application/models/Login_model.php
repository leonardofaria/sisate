<?php

/*
  Agemed   - agenda medica de pericia
 */

/**
 *  Responsável pelas funções ligadas aos dados de usuários para CRUD usuário
 *
 * @author Israel Eduardo Zebulon Martins de Souza 12/2014
 */
class Login_model extends CI_Model {

  public function __construct() {
    try {
      $this->load->database('sisref', true);
      // $this->load->database();
      parent::__construct();
    } catch (Exception $e) {
      $this->session->set_flashdata('erro', 'Erro acessar base de dados');
      log_message('debug', ' Erro ao validar login ' . $e);
      redirect(base_url());
    }
  }

    /*
     *
     * @param: @var matricula do usuário
     * return: objeto query do mysqli contendo os dados do usuário
     *      */

    public function obterDadosUsuario($usuario) {

      try {

        $query = $this->db->query("SELECT
          u . *, l.descricao,l.logradouro, tp.descricao as descUsuario
          FROM
          usuario as u
          Inner join
          lotacao as l ON u.lotacao = l.id
          inner join
          tipo_usuario as tp ON u.id_tipo_usuario = tp.id
          where
          matricula = $usuario
          and u.bol_excluido = 'N'");
      } catch (Exception $e) {
        $this->session->set_flashdata('erro', 'Erro ao validar login');
        log_message('debug', ' Erro ao validar login ' . $e);
        redirect(base_url());
      }
      return $query;
    }

    /*
     *  Checa se o usuário está logado
     *      */

    public function logged() {

      $logged = $this->session->userdata('logado');

      if (!isset($logged) || $logged != true) {
        $this->load->model('mensagensModel');
        $this->mensagensModel->defineMesagens(10);
        redirect(base_url());
      }
    }

    /*
     * @param usuario e senha
     * true caso login positivo e false para o contrário
     */

    public function validarSisref($usuario, $senha) {
      try {
        $params = array('usuario' => $usuario, 'senha' => $senha);
        $this->load->helper('url');
        $this->load->library('sisref', $params);
        $result = $this->sisref->validar();

        if ($result->resultado) {
          return true;
        } else {
          return false;
        }
      } catch (Exception $e) {
        $this->session->set_flashdata('erro', 'Erro ao validar login');
        log_message('debug', ' Erro ao validar login ' . $e);
        base_url();
      }
    }

    /*
     * @param usuario e query
     * sem retorno, apenas grava os dados nome, id, matricula na sessao
     */

    public function gravaDadosNaSessao($usuario, $query) {
      try {
        $this->session->set_userdata("logado", 1);
        $this->session->set_userdata("usuario", $usuario);
        foreach ($query->result() as $row) {

          $this->session->set_userdata("nome", $row->nome);
          $this->session->set_userdata("matricula", $row->matricula);
          $this->session->set_userdata("lotacao", $row->lotacao);
          $this->session->set_userdata("descricao_lotacao", $row->descricao);
          $this->session->set_userdata("id", $row->id);
          $this->session->set_userdata("tipoUsuario", $row->id_tipo_usuario);
          $this->session->set_userdata("ip", $_SERVER['REMOTE_ADDR']);
          $this->session->set_userdata("descUsuario", $row->descUsuario);
          $this->session->set_userdata("logradouro", $row->logradouro);
          $apelido = explode(' ', $row->nome);
          $this->session->set_userdata("apelido", ($apelido[0]));
        }
      } catch (ErrorException $e) {
        $this->session->set_flashdata('erro', 'Erro ao validar login');
        log_message('debug', ' Erro ao validar login ' . $e);
        base_url();
      }
    }

    /*
     * Destruir  a sessão do usuário
     */

    function logout() {
      $this->session->unset_userdata("logado");
      $this->session->sess_destroy();
    }

    /*
     * Gerar um salt para encriptar a senha do usário
     *  */

    public function gerarSalt() {
      return base_convert(sha1(uniqid(mt_rand(), TRUE)), 16, 36);
    }

    /*
     * Gerar senha encriptada
     *  */

    public function gerarHash($senha, $salt) {
      $hashSenha = hash('sha512', $senha . $salt);
      for ($i = 0; $i < 10; $i++) {
        $hashSenha = hash('sha512', $hashSenha);
      }
      return $hashSenha;
    }

    /*

     * Verifica a validade da senha
     * @return: boolean TRUE para senha correta     */

    public function validarSenha($senhaEncriptada, $senhaGravada) {

      return $senhaEncriptada == $senhaGravada ? TRUE : FALSE;
    }

    /*

     * Fazer as encriptações e chamar verificação de senha
     *      */

    public function isBValidSenha($senha, $query) {

      foreach ($query->result() as $row) {
        $salt = $row->salt;
        $senhaGravada = $row->senha;
      }
      $senhaEncriptada = self::gerarHash($senha, $salt);
      return self::validarSenha($senhaEncriptada, $senhaGravada);
    }

    /*

     * Gravar a senha atual no banco para o caso do Sisref estar offline     */

    public function gravarSenhaHashBanco($senha, $query) {
      $salt = self::gerarSalt();
      $senhaEncriptada = self::gerarHash($senha, $salt);

      foreach ($query->result() as $row) {
        $id = $row->id;
      }


      try {
        $dados = array(
          'senha' => $senhaEncriptada,
          'salt' => $salt
          );

        $this->db->trans_start();
        $this->db->where('id', $id);
        $this->db->update('usuario', $dados);
        $this->db->trans_complete();

        if ($this->db->trans_status() === FALSE) {
          log_message('debug', ' Erro ao persistir senha no banco ' . $id);
        }
      } catch (Exception $e) {
        $this->session->set_flashdata('erro', 'Erro ao persistir senha no banco' . $e);
        redirect(base_url());
      }
    }

  }
