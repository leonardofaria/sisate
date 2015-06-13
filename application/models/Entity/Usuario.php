<?php

namespace Entity;
// src/Usuario.php
/**
 * @Entity @Table(name="usuarios")
 **/
class Usuario
{
  /** @Id @Column(type="integer") @GeneratedValue **/
  protected $id;

  /** @Column(type="string") **/
  protected $siape;

  /** @Column(type="string") **/
  protected $nome;

  /** @Column(type="string") **/
  protected $email;

  /** @Column(type="datetime") **/
  protected $criado;

  /**
   * @ManyToOne(targetEntity="Orgao", inversedBy="usuarios")
   * @JoinColumn(name="orgao_id", referencedColumnName="id")
   **/
  private $orgao;

  /**
   * @ManyToOne(targetEntity="Perfil", inversedBy="usuarios")
   * @JoinColumn(name="perfil_id", referencedColumnName="id")
   **/
  private $perfil;

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

  public function getEmail()
  {
    return $this->email;
  }

  public function setEmail($email)
  {
    $this->email = $email;
  }

  public function getCriado()
  {
    return $this->criado->format('d/m/Y H:i:s');
  }

  public function setCriado($criado)
  {
    $this->criado = $criado;
  }

  public function getUltimoacesso()
  {
    return $this->ultimoacesso->format('d/m/Y H:i:s');
  }

  public function setUltimoacesso($ultimoacesso)
  {
    $this->ultimoacesso = $ultimoacesso;
  }

  public function getSiape()
  {
    return $this->siape;
  }

  public function setSiape($siape)
  {
    $this->siape = $siape;
  }

  public function getOrgao()
  {
    return $this->orgao;
  }

  public function setOrgao($orgao)
  {
    $this->orgao = $orgao;
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