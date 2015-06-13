<?php

namespace Entity;
// src/Documento.php
/**
 * @Entity @Table(name="documentos")
 **/
class Documento
{
  /** @Id @Column(type="integer") @GeneratedValue **/
  protected $id;

  /** @Column(type="string") **/
  protected $nome;

  /** @Column(type="integer") **/
  protected $tamanho;

  /**
   * @ManyToOne(targetEntity="ProcessoEvento", inversedBy="documentos")
   * @JoinColumn(name="processoevento_id", referencedColumnName="id")
   **/
  private $processoevento;

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

  public function getTamanho()
  {
    return $this->tamanho;
  }

  public function setTamanho($tamanho)
  {
    $this->tamanho = $tamanho;
  }

  public function setProcessoEvento(ProcessoEvento $processoevento = null)
  {
    $this->processoevento = $processoevento;
    return $this;
  }

}