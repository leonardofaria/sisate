<?php

namespace Entity;
// src/Perfil.php
/**
 * @Entity @Table(name="perfis")
 **/
class Perfil
{
  /** @Id @Column(type="integer") @GeneratedValue **/
  protected $id;
  /** @Column(type="string") **/
  protected $nome;

  public function getId()
  {
    return $this->id;
  }

  public function getNome()
  {
    return $this->nome;
  }

  public function setNome($nome)
  {
    $this->nome = $nome;
  }

}