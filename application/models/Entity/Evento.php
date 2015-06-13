<?php

namespace Entity;
// src/Evento.php
/**
 * @Entity @Table(name="eventos")
 **/
class Evento
{
  /** @Id @Column(type="integer") @GeneratedValue **/
  protected $id;

  /** @Column(type="string") **/
  protected $nome;

  /**
   * @ManyToOne(targetEntity="Perfil", inversedBy="eventos")
   * @JoinColumn(name="perfil_id", referencedColumnName="id")
   **/
  private $perfil;

  /** @Column(type="string") **/
  protected $ativo;

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

  public function getPerfil()
  {
    return $this->perfil;
  }

  public function setPerfil($perfil)
  {
    $this->perfil = $perfil;
  }

  public function getAtivo()
  {
    return $this->ativo;
  }

  public function setAtivo($ativo)
  {
    $this->ativo = $ativo;
  }
}