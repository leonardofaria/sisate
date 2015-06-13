<?php
Class Sisref extends CI_Model
{
  function login($username, $password) {

    $password = substr(md5($password), 0, 14);
    $sisref = $this->load->database('sisref', true);

    if (ENVIRONMENT == 'production') {
      $senha = "and senha = '$password'";
    } else {
      $senha = "";
    }

    $query = $sisref->query("select u.siape, u.nome, u.setor as ol, v.lotacao_descricao as lotacao, u.senha, v.cargo, v.email from usuarios u, vw_servidores v where u.siape = v.siape and u.siape = '$username' $senha limit 1;");

    if($query->num_rows() == 1) {
      return $query->result();
    } else {
      return false;
    }

  }
}
?>