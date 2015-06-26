<?php

class MY_Controller extends CI_Controller {

  public function __construct($currentController = __CLASS__) {

    parent::__construct();

    if($this->session->userdata('logged_in')) {

      $session_data = $this->session->userdata('logged_in');

      $this->siape = $session_data['siape'];
      $this->nome = $session_data['nome'];
      $this->ol = $session_data['ol'];
      $this->lotacao = $session_data['lotacao'];
      // $this->cargo = $session_data['cargo'];
      $this->usuario_id = $session_data['usuario_id'];
      $this->orgao_id = $session_data['orgao_id'];
      $this->perfil_id = $session_data['perfil_id'];
      $this->perfil_nome = $session_data['perfil_nome'];
      $this->orgao_modalidade_id = $session_data['orgao_modalidade_id'];

      if (isset($session_data['perfis'])) {
        $this->perfis = $session_data['perfis'];
      }

      $this->layout = 'Yes';

      $permission = array('Eventos', 'Modalidades', 'Orgaos', 'Perfis', 'Usuarios');
      if ($this->perfil_id != 1 && in_array($currentController, $permission)) {
        $this->session->set_flashdata('message_error', 'Você não tem acesso a essa página.');
        redirect(base_url());
      }
    } else {
      redirect('conta/index');
    }

  }

}
