<?php

namespace Entity;

/**
 * @Entity @Table(name="processos_eventos")
 */
class ProcessoEvento
{
  /** @Id @Column(type="integer") @GeneratedValue **/
  protected $id;

  /**
   * @ManyToOne(targetEntity="Processo", inversedBy="processoseventos")
   * @JoinColumn(name="processo_id", referencedColumnName="id", nullable=FALSE)
   */
  protected $processo;

  /**
   * @ManyToOne(targetEntity="Evento", inversedBy="processoseventos")
   * @JoinColumn(name="evento_id", referencedColumnName="id", nullable=FALSE)
   */
  protected $evento;

  /** @Column(type="string") **/
  protected $complemento;

  /** @Column(type="datetime") **/
  protected $criado;

  /**
   * @OneToMany(targetEntity="Documento", mappedBy="processoevento", cascade={"persist", "remove"}, orphanRemoval=TRUE)
   **/
  protected $documentos;

  /**
   * @ManyToOne(targetEntity="Usuario", inversedBy="processoseventos")
   * @JoinColumn(name="usuario_id", referencedColumnName="id")
   **/
  protected $usuario;

  public function __construct() {
    $this->documentos = new \Doctrine\Common\Collections\ArrayCollection();
  }

  public function getId()
  {
    return $this->id;
  }

  public function getProcesso()
  {
    return $this->processo;
  }

  public function setProcesso(Processo $processo = null)
  {
    $this->processo = $processo;
    return $this;
  }

  public function getEvento()
  {
    return $this->evento;
  }

  public function setEvento(Evento $evento = null)
  {
    $this->evento = $evento;
    return $this;
  }

  public function getComplemento()
  {
    return $this->complemento;
  }

  public function setComplemento($complemento)
  {
    $this->complemento = $complemento;
    return $this;
  }

  public function getCriado()
  {
    return $this->criado->format('d/m/Y H:i:s');
  }

  public function setCriado($criado)
  {
    $this->criado = $criado;
  }

  public function getDocumentos()
  {
    return $this->documentos;
  }

  public function addDocumento(Documento $documento)
  {
    if (!$this->documentos->contains($documento)) {
      $this->documentos->add($documento);
      $documento->setProcessoevento($this);
    }

    return $this;
  }

  public function getUsuario()
  {
    return $this->usuario;
  }

  public function setUsuario($usuario)
  {
    $this->usuario = $usuario;
  }
}
