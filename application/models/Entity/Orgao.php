<?php

namespace Entity;
// src/Orgao.php
/**
 * @Entity @Table(name="orgaos")
 **/
class Orgao
{
  /** @Id @Column(type="integer") @GeneratedValue **/
  protected $id;
  /** @Column(type="string") **/
  protected $nome;
  /** @Column(type="integer") **/
  protected $ol;

  /**
   * @ManyToOne(targetEntity="Modalidade", inversedBy="orgaos")
   * @JoinColumn(name="modalidade_id", referencedColumnName="id")
   **/
  private $modalidade;

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

  public function getOl()
  {
    return $this->ol;
  }

  public function setOl($ol)
  {
    $this->ol = $ol;
  }

  public function getModalidade()
  {
    return $this->modalidade;
  }

  public function setModalidade($modalidade)
  {
    $this->modalidade = $modalidade;
  }
}