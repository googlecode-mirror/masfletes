<?php

/**
 * @Entity
 * @Table(name="operations")
 */
class DefaultDb_Entity_Operation
{

    /**
     * @Id @Column(type="integer")
     * @GeneratedValue
     * @var integer  
     */
    private $id;

    /**
     * @ManyToOne(targetEntity="DefaultDb_Entity_Shipment")
     * @joinColumn(onDelete="CASCADE")
     */
    private $shipment;

    /**
     * @ManyToOne(targetEntity="DefaultDb_Entity_Route")
     * @joinColumn(onDelete="CASCADE")
     */
    private $route;
    
    /**
     * @ManyToOne(targetEntity="DefaultDb_Entity_User")
     * @joinColumn(onDelete="CASCADE")
     */
    private $user;

    /**
     * @Column(type="datetime", name="operation_date")
     * @var DateTime
     */
    private $operationDate;
    
    /**
     * @Column(type="smallint")
     * @var integer
     */
    private $status;
    
    /**
     * @Column(type="float", name="cost")
     * @var float
     */
    
    private $cost;
    
    /**
     * @Column(type="float", name="costo_enviador")
     * @var float
     */
    
    private $costoEnviador;
    
    /**
     * @Column(type="smallint", length=1, name="maniobras")
     * @var integer
     */
    private $maniobras;
    
    /**
     * @Column(type="float", name="costo_trans")
     * @var float
     */
    private $costoTrans;
    
    /**
     * @Column(type="float", name="seguro")
     * @var float
     */
    private $seguro;
    
    /**
     * @Column
     * @var string
     */
    private $documents;
    
    /**
     * @Column(type="string", length=128)
     * @var string
     */
    private $custodia;
    
    /**
     * @Column(type="string", length=128, name="ref_enviador")
     * @var string
     */
    private $refEnviador;
    
    /**
     * @Column(type="string", length=128, name="ref_trans")
     * @var string
     */
    private $refTrans;
    
    /**
     * @Column(type="string", length=128, name="cal_enviador")
     * @var string
     */
    private $calEnviador;
    
    /**
     * @Column(type="string", length=128, name="cal_trans")
     * @var string
     */
    private $calTrans;
    
    /**
     * @Column(type="string", length=128, name="ind_enviador")
     * @var string
     */
    private $indEnviador;
    
    /**
     * @Column(type="string", length=128, name="ind_trans")
     * @var string
     */
    private $indTrans;
    
    /**
     * @Column
     * @var string
     */
    private $comments;
 
    public function getId()
    {
        return $this->id;
    }

    public function getShipment()
    {
        return $this->shipment;
    }

    public function getRoute()
    {
        return $this->route;
    }
    
    public function getUser()
    {
        return $this->user;
    }

    public function getOperationDate()
    {
        return $this->operationDate;
    }
    
    public function getStatus()
    {
        return $this->status;
    }
    
    public function getCost()
    {
        return $this->cost;
    }
    
    public function getCostoEnviador()
    {
        return $this->costoEnviador;
    }
    
    public function getManiobras()
    {
        return $this->maniobras;
    }
    
    public function getCostoTrans()
    {
        return $this->costoTrans;
    }
    
    public function getSeguro()
    {
        return $this->seguro;
    }
    
    public function getDocuments()
    {
        return $this->documents;
    }
    
    public function getCustodia()
    {
        return $this->custodia;
    }
    
    public function getRefEnviador()
    {
        return $this->refEnviador;
    }
    
    public function getRefTrans()
    {
        return $this->refTrans;
    }
    
    public function getCalEnviador()
    {
        return $this->calEnviador;
    }
    
    public function getCalTrans()
    {
        return $this->calTrans;
    }
    
    public function getIndEnviador()
    {
        return $this->indEnviador;
    }
    
    public function getIndTrans()
    {
        return $this->indTrans;
    }

    public function getComments()
    {
        return $this->comments;
    }
    
    public function setDocuments($documents)
    {
        $this->documents = $documents;
    }
    
    public function setCustodia($custodia)
    {
        $this->custodia = $custodia;
    }
    
    public function setRefEnviador($refEnviador)
    {
        $this->refEnviador = $refEnviador;
    }
    
    public function setRefTrans($refTrans)
    {
        $this->refTrans = $refTrans;
    }
    
    public function setCalEnviador($calEnviador)
    {
        $this->calEnviador = $calEnviador;
    }
    
    public function setCalTrans($calTrans)
    {
        $this->calTrans = $calTrans;
    }
    
    public function setIndEnviador($indEnviador)
    {
        $this->indEnviador = $indEnviador;
    }
    
    public function setIndTrans($indTrans)
    {
        $this->indTrans = $indTrans;
    }
    
    public function setSeguro($seguro)
    {
        $this->seguro = $seguro;
    }
    
    public function setComments($comments)
    {
        $this->comments = $comments;
    }
    
    public function setCostoTrans($costoTrans)
    {
        $this->costoTrans = $costoTrans;
    }
    
    public function setManiobras($maniobras)
    {
        $this->maniobras = $maniobras;
    }

    public function setShipment($shipment)
    {
        $this->shipment = $shipment;
    }

    public function setRoute($route)
    {
        $this->route = $route;
    }
    
    public function setUser($user)
    {
        $this->user = $user;
    }

    public function setOperationDate(DateTime $operationDate)
    {
        $this->operationDate = $operationDate;
    }
    
    public function setStatus($status)
    {
        $this->status = $status;
    }
    
    public function setCost($cost)
    {
        $this->cost = $cost;
    }
    
    public function setCostoEnviador($costoEnviador)
    {
        $this->costoEnviador = $costoEnviador;
    }
}
