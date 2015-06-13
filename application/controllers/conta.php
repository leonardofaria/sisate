<?php

if (!defined('BASEPATH')) {
  exit('No direct script access allowed');
}

class Conta extends CI_Controller{

  public function __construct(){

    parent::__construct();
    $this->layout = "No";

  }

  function index() {

    $this->load->model('sisref', '', TRUE);
    $this->load->library('form_validation');
    $this->form_validation->set_rules('username', 'Username', 'trim|required');
    $this->form_validation->set_rules('password', 'Password', 'trim|required|callback_check_database');

    if(!$this->form_validation->run()) {
      $this->load->view('conta/index');
    } else {
      $session_data = $this->session->userdata('logged_in');
      $this->session->set_flashdata('message_success', 'Olá ' . $session_data['nome'] . '!');
      redirect(base_url());
    }

  }

  function perfil() {

    $session_data = $this->session->userdata('logged_in');
    $siape = $session_data['siape'];

    $id = $this->uri->segment(3);

    $this->load->model('usuario');
    $usuario = $this->usuario->find(array('id' => $id));

    if ($usuario) {
      if ($usuario[0]->getSiape() === $siape) {

        $sess_array = array(
          'siape' => $usuario[0]->getSiape(),
          'ol' => $usuario[0]->getOrgao()->getOl(),
          'lotacao' => $usuario[0]->getOrgao()->getNome(),
          'nome' => $usuario[0]->getNome(),
          'email' => $usuario[0]->getEmail(),
          'usuario_id' => $usuario[0]->getId(),
          'orgao_id' => $usuario[0]->getOrgao()->getId(),
          'orgao_modalidade_id' => $usuario[0]->getOrgao()->getModalidade()->getId(),
          'perfil_id' => $usuario[0]->getPerfil()->getId(),

        );

        $usuarios = $this->usuario->find(array('siape' => $siape));

        foreach ($usuarios as $u) {
          $perfis[] = array(
            'usuario_id' => $u->getId(),
            'perfil_nome' => $u->getPerfil()->getNome(),
            'ol' => $u->getOrgao()->getOl()
          );
        }
        $sess_array['perfis'] = $perfis;

        $this->session->set_userdata('logged_in', $sess_array);
        redirect(base_url());

      }
    }
  }

  function check_database($password) {

    $this->load->model('usuario');
    $this->load->model('sisref', '', TRUE);
    $username = $this->input->post('username');
    $result = $this->sisref->login($username, $password);

    if($result) {
      $sess_array = array();
      foreach($result as $row) {
        $sess_array = array(
          'siape' => $row->siape,
          'ol' => $row->ol,
          'nome' => $row->nome,
          'email' => $row->email,
          'lotacao' => $row->lotacao,
          'cargo' => $row->cargo
        );

        $usuario = $this->usuario->autenticar($sess_array);

        if (count($usuario) > 1) {

          $perfis = array();

          foreach ($usuario as $u) {
            $perfis[] = array(
              'usuario_id' => $u->getId(),
              'perfil_nome' => $u->getPerfil()->getNome(),
              'ol' => $u->getOrgao()->getOl()
            );
          }
          $sess_array['perfis'] = $perfis;
          $usuario = $usuario[0];

        }

        $sess_array['ol'] = $usuario->getOrgao()->getOl();
        $sess_array['usuario_id'] = $usuario->getId();
        $sess_array['orgao_id'] = $usuario->getOrgao()->getId();
        $sess_array['perfil_id'] = $usuario->getPerfil()->getId();
        $sess_array['orgao_modalidade_id'] = $usuario->getOrgao()->getModalidade()->getId();

        $this->session->set_userdata('logged_in', $sess_array);
      }
      return TRUE;
    } else {
      $this->form_validation->set_message('check_database', 'Usuário ou senha inválidos');
      return false;
    }
  }

  function logout(){
    $this->session->unset_userdata('logged_in');
    session_destroy();
    redirect(base_url());
  }

}
