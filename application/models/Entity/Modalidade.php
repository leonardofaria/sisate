<?php

namespace Entity;
// src/Modalidade.php
/**
 * @Entity @Table(name="modalidades")
 **/
class Modalidade
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