<?php

namespace DoctrineProxies\__CG__\Entity;

/**
 * DO NOT EDIT THIS FILE - IT WAS CREATED BY DOCTRINE'S PROXY GENERATOR
 */
class Processo extends \Entity\Processo implements \Doctrine\ORM\Proxy\Proxy
{
    /**
     * @var \Closure the callback responsible for loading properties in the proxy object. This callback is called with
     *      three parameters, being respectively the proxy object to be initialized, the method that triggered the
     *      initialization process and an array of ordered parameters that were passed to that method.
     *
     * @see \Doctrine\Common\Persistence\Proxy::__setInitializer
     */
    public $__initializer__;

    /**
     * @var \Closure the callback responsible of loading properties that need to be copied in the cloned object
     *
     * @see \Doctrine\Common\Persistence\Proxy::__setCloner
     */
    public $__cloner__;

    /**
     * @var boolean flag indicating if this object was already initialized
     *
     * @see \Doctrine\Common\Persistence\Proxy::__isInitialized
     */
    public $__isInitialized__ = false;

    /**
     * @var array properties to be lazy loaded, with keys being the property
     *            names and values being their default values
     *
     * @see \Doctrine\Common\Persistence\Proxy::__getLazyProperties
     */
    public static $lazyPropertiesDefaults = array();



    /**
     * @param \Closure $initializer
     * @param \Closure $cloner
     */
    public function __construct($initializer = null, $cloner = null)
    {

        $this->__initializer__ = $initializer;
        $this->__cloner__      = $cloner;
    }







    /**
     * 
     * @return array
     */
    public function __sleep()
    {
        if ($this->__isInitialized__) {
            return array('__isInitialized__', 'id', 'nb', 'ctc', 'criado', 'modificado', 'orgaoresponsavel', 'orgaoatual', 'ultimoevento', 'processoeventos');
        }

        return array('__isInitialized__', 'id', 'nb', 'ctc', 'criado', 'modificado', 'orgaoresponsavel', 'orgaoatual', 'ultimoevento', 'processoeventos');
    }

    /**
     * 
     */
    public function __wakeup()
    {
        if ( ! $this->__isInitialized__) {
            $this->__initializer__ = function (Processo $proxy) {
                $proxy->__setInitializer(null);
                $proxy->__setCloner(null);

                $existingProperties = get_object_vars($proxy);

                foreach ($proxy->__getLazyProperties() as $property => $defaultValue) {
                    if ( ! array_key_exists($property, $existingProperties)) {
                        $proxy->$property = $defaultValue;
                    }
                }
            };

        }
    }

    /**
     * 
     */
    public function __clone()
    {
        $this->__cloner__ && $this->__cloner__->__invoke($this, '__clone', array());
    }

    /**
     * Forces initialization of the proxy
     */
    public function __load()
    {
        $this->__initializer__ && $this->__initializer__->__invoke($this, '__load', array());
    }

    /**
     * {@inheritDoc}
     * @internal generated method: use only when explicitly handling proxy specific loading logic
     */
    public function __isInitialized()
    {
        return $this->__isInitialized__;
    }

    /**
     * {@inheritDoc}
     * @internal generated method: use only when explicitly handling proxy specific loading logic
     */
    public function __setInitialized($initialized)
    {
        $this->__isInitialized__ = $initialized;
    }

    /**
     * {@inheritDoc}
     * @internal generated method: use only when explicitly handling proxy specific loading logic
     */
    public function __setInitializer(\Closure $initializer = null)
    {
        $this->__initializer__ = $initializer;
    }

    /**
     * {@inheritDoc}
     * @internal generated method: use only when explicitly handling proxy specific loading logic
     */
    public function __getInitializer()
    {
        return $this->__initializer__;
    }

    /**
     * {@inheritDoc}
     * @internal generated method: use only when explicitly handling proxy specific loading logic
     */
    public function __setCloner(\Closure $cloner = null)
    {
        $this->__cloner__ = $cloner;
    }

    /**
     * {@inheritDoc}
     * @internal generated method: use only when explicitly handling proxy specific cloning logic
     */
    public function __getCloner()
    {
        return $this->__cloner__;
    }

    /**
     * {@inheritDoc}
     * @internal generated method: use only when explicitly handling proxy specific loading logic
     * @static
     */
    public function __getLazyProperties()
    {
        return self::$lazyPropertiesDefaults;
    }

    
    /**
     * {@inheritDoc}
     */
    public function getId()
    {
        if ($this->__isInitialized__ === false) {
            return (int)  parent::getId();
        }


        $this->__initializer__ && $this->__initializer__->__invoke($this, 'getId', array());

        return parent::getId();
    }

    /**
     * {@inheritDoc}
     */
    public function getNb()
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'getNb', array());

        return parent::getNb();
    }

    /**
     * {@inheritDoc}
     */
    public function setNb($nb)
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'setNb', array($nb));

        return parent::setNb($nb);
    }

    /**
     * {@inheritDoc}
     */
    public function getCtc()
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'getCtc', array());

        return parent::getCtc();
    }

    /**
     * {@inheritDoc}
     */
    public function setCtc($ctc)
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'setCtc', array($ctc));

        return parent::setCtc($ctc);
    }

    /**
     * {@inheritDoc}
     */
    public function getCriado()
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'getCriado', array());

        return parent::getCriado();
    }

    /**
     * {@inheritDoc}
     */
    public function setCriado($criado)
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'setCriado', array($criado));

        return parent::setCriado($criado);
    }

    /**
     * {@inheritDoc}
     */
    public function getModificado()
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'getModificado', array());

        return parent::getModificado();
    }

    /**
     * {@inheritDoc}
     */
    public function setModificado($modificado)
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'setModificado', array($modificado));

        return parent::setModificado($modificado);
    }

    /**
     * {@inheritDoc}
     */
    public function getOrgaoResponsavel()
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'getOrgaoResponsavel', array());

        return parent::getOrgaoResponsavel();
    }

    /**
     * {@inheritDoc}
     */
    public function setOrgaoResponsavel($orgaoresponsavel)
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'setOrgaoResponsavel', array($orgaoresponsavel));

        return parent::setOrgaoResponsavel($orgaoresponsavel);
    }

    /**
     * {@inheritDoc}
     */
    public function getOrgaoAtual()
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'getOrgaoAtual', array());

        return parent::getOrgaoAtual();
    }

    /**
     * {@inheritDoc}
     */
    public function setOrgaoAtual($orgaoatual)
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'setOrgaoAtual', array($orgaoatual));

        return parent::setOrgaoAtual($orgaoatual);
    }

    /**
     * {@inheritDoc}
     */
    public function getUltimoevento()
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'getUltimoevento', array());

        return parent::getUltimoevento();
    }

    /**
     * {@inheritDoc}
     */
    public function setUltimoevento($ultimoevento)
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'setUltimoevento', array($ultimoevento));

        return parent::setUltimoevento($ultimoevento);
    }

    /**
     * {@inheritDoc}
     */
    public function getProcessoEventos()
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'getProcessoEventos', array());

        return parent::getProcessoEventos();
    }

    /**
     * {@inheritDoc}
     */
    public function addProcessoEvento(\Entity\Processoevento $processoevento)
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'addProcessoEvento', array($processoevento));

        return parent::addProcessoEvento($processoevento);
    }

    /**
     * {@inheritDoc}
     */
    public function removeProcessoEvento(\Entity\Processoevento $processoevento)
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'removeProcessoEvento', array($processoevento));

        return parent::removeProcessoEvento($processoevento);
    }

    /**
     * {@inheritDoc}
     */
    public function alterarOrgao($id_orgao)
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'alterarOrgao', array($id_orgao));

        return parent::alterarOrgao($id_orgao);
    }

}
