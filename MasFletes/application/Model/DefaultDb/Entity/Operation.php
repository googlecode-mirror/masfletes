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
     * @var @float
     */
    
    private $cost;
 
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
    
    public function setShipment($shipment)
    {
        $this->shipment = $shipment;
    }

    public function setRoute($route)
    {
        $this->route = $route;
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

}
