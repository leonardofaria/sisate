<?php

namespace Entity;
// src/Processo.php
/**
 * @Entity @Table(name="processos")
 **/
class Processo
{
  /** @Id @Column(type="integer") @GeneratedValue **/
  protected $id;
  /** @Column(type="string") **/
  protected $nb;
  /** @Column(type="string") **/
  protected $ctc;
  /** @Column(type="datetime") **/
  protected $criado;
  /** @Column(type="datetime") **/
  protected $modificado;
  /** @ManyToOne(targetEntity="Orgao") */
  protected $orgaoresponsavel;
  /** @ManyToOne(targetEntity="Orgao") **/
  protected $orgaoatual;
  /** @Column(type="string") **/
  // protected $upload;

  /**
   * @OneToMany(targetEntity="ProcessoEvento", mappedBy="processo", cascade={"persist", "remove"}, orphanRemoval=TRUE)
   */
  protected $processoeventos;

  public function __construct()
  {
    $this->processoeventos = new \Doctrine\Common\Collections\ArrayCollection();
  }

  public function getId()
  {
    return $this->id;
  }

  public function getNb()
  {
    return $this->nb;
  }

  public function setNb($nb)
  {
    $this->nb = $nb;
  }

  public function getCtc()
  {
    return $this->ctc;
  }

  public function setCtc($ctc)
  {
    $this->ctc = $ctc;
  }

  public function getCriado()
  {
    return $this->criado->format('d/m/Y H:i:s');
  }

  public function setCriado($criado)
  {
    $this->criado = $criado;
  }

  public function getModificado()
  {
    return $this->modificado->format('d/m/Y H:i:s');
  }

  public function setModificado($modificado)
  {
    $this->modificado = $modificado;
  }

  public function getOrgaoResponsavel()
  {
    return $this->orgaoresponsavel;
  }

  public function setOrgaoResponsavel($orgaoresponsavel)
  {
    $this->orgaoresponsavel = $orgaoresponsavel;
  }

  public function getOrgaoAtual()
  {
    return $this->orgaoatual;
  }

  public function setOrgaoAtual($orgaoatual)
  {
    $this->orgaoatual = $orgaoatual;
  }

  public function getProcessoEventos()
  {
    $eventos = $this->processoeventos->toArray();
    return array_reverse($eventos);
  }

  public function addProcessoEvento(ProcessoEvento $processoevento)
  {
    if (!$this->processoeventos->contains($processoevento)) {
      $this->processoeventos->add($processoevento);
      $processoevento->setProcesso($this);
    }

    return $this;
  }

  public function removeProcessoEvento(ProcessoEvento $processoevento)
  {
    if ($this->processoeventos->contains($processoevento)) {
      $this->processoeventos->removeElement($processoevento);
      $processoevento->setProcesso(null);
    }

    return $this;
  }

  public function alterarOrgao($id_orgao)
  {
    $this->setOrgaoAtual($id_orgao);
    return $this;
  }

}