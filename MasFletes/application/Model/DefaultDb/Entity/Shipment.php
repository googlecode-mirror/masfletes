<?php

/**
 * @Entity(repositoryClass="DefaultDb_Repositories_ShipmentRepository")
 * @Table(name="shipments")
 */
class DefaultDb_Entity_Shipment
{
    /**
     * @Id @Column(type="integer")
     * @GeneratedValue
     * @var integer  
     */
    private $id;
    
    /**
     * @Column(type="datetime")
     * @var DateTime
     */
    private $creation_date;

    /**
     * @ManyToOne(targetEntity="DefaultDb_Entity_Vehicle")
     * @joinColumn(onDelete="CASCADE")
     */
    private $vehicle;
    
    /**
     * @ManyToOne(targetEntity="DefaultDb_Entity_VehicleType")
     * @joinColumn(onDelete="CASCADE", name="vehicle_type_id")
     */
    private $vehicleType;
    
    /**
     * @ManyToOne(targetEntity="DefaultDb_Entity_User")
     * @joinColumn(onDelete="CASCADE")
     */
    private $user;
    
    /**
     * @ManyToOne(targetEntity="DefaultDb_Entity_State")
     * @joinColumn(onDelete="CASCADE", name="state_origin_id")
     */
    private $stateOrigin;
    
    /**
     * @ManyToOne(targetEntity="DefaultDb_Entity_State")
     * @joinColumn(onDelete="CASCADE", name="state_destiny_id")
     */
    private $stateDestiny;
    
    /**
     * @ManyToOne(targetEntity="DefaultDb_Entity_City")
     * @joinColumn(onDelete="CASCADE", name="municipality_origin_id")
     */
    private $municipalityOrigin;
    
    /**
     * @ManyToOne(targetEntity="DefaultDb_Entity_City")
     * @joinColumn(onDelete="CASCADE", name="municipality_destiny_id")
     */
    private $municipalityDestiny;
        
    /**
     * @Column
     * @var string
     */
    private $frequency;
    
    /**
     * @Column(type="smallint", name="shipment_accepted")
     * @var integer
     */
    private $shipmentAccepted;
    
    /**
     * @Column(type="integer", name="effective_days")
     * @var integer
     */
    private $effectiveDays;
    
    /**
     * @Column(name="contact_name")
     * @var string
     */
    private $contactName;
    
    /**
     * @Column(name="contact_phone")
     * @var string
     */
    private $contactPhone;
    
    /**
     * @Column(type="datetime", name="source_date")
     * @var DateTime
     */
    private $sourceDate;
    
    /**
     * @Column(name="source_address")
     * @var string
     */
    private $sourceAddress;
    
    /**
     * @Column(type="datetime", name="destiny_date")
     * @var DateTime
     */
    private $destinyDate;
    
    /**
     * @Column(name="destiny_address")
     * @var string
     */
    private $destinyAddress;
    
    /**
     * @ManyToOne(targetEntity="DefaultDb_Entity_ShipmentType")
     * @joinColumn(onDelete="CASCADE", name="shipment_type_id")
     */
    private $shipmentType;
    
    /**
     * @Column
     * @var string
     */
    private $comments;
    
    public function getId()
    {
        return $this->id;
    }

    public function getCreation_date()
    {
        return $this->creation_date;
    }

    public function getVehicle()
    {
        return $this->vehicle;
    }
        
    public function getVehicleType()
    {
        return $this->vehicleType;
    }

    public function getUser()
    {
        return $this->user;
    }

    public function getStateOrigin()
    {
        return $this->stateOrigin;
    }

    public function getStateDestiny()
    {
        return $this->stateDestiny;
    }

    public function getMunicipalityOrigin()
    {
        return $this->municipalityOrigin;
    }

    public function getMunicipalityDestiny()
    {
        return $this->municipalityDestiny;
    }

    public function getFrequency()
    {
        return $this->frequency;
    }

    public function getShipmentAccepted()
    {
        return $this->shipmentAccepted;
    }

    public function getEffectiveDays()
    {
        return $this->effectiveDays;
    }
    
    public function getContactName()
    {
        return $this->contactName;
    }

    public function getContactPhone()
    {
        return $this->contactPhone;
    }
    
    public function getSourceDate()
    {
        return $this->sourceDate;
    }

    public function getSourceAddress()
    {
        return $this->sourceAddress;
    }
    
    public function getDestinyDate()
    {
        return $this->destinyDate;
    }

    public function getDestinyAddress()
    {
        return $this->destinyAddress;
    }

    public function getShipmentType()
    {
        return $this->shipmentType;
    }
    
    public function getComments()
    {
        return $this->comments;
    }

    public function setComments($comments)
    {
        $this->comments = $comments;
    }

    public function setCreation_date(DateTime $creation_date)
    {
        $this->creation_date = $creation_date;
    }

    public function setVehicle($vehicle)
    {
        $this->vehicle = $vehicle;
    }
        
    public function setVehicleType($vehicleType)
    {
        $this->vehicleType = $vehicleType;
    }

    public function setUser($user)
    {
        $this->user = $user;
    }

    public function setStateOrigin($stateOrigin)
    {
        $this->stateOrigin = $stateOrigin;
    }

    public function setStateDestiny($stateDestiny)
    {
        $this->stateDestiny = $stateDestiny;
    }

    public function setMunicipalityOrigin($municipalityOrigin)
    {
        $this->municipalityOrigin = $municipalityOrigin;
    }

    public function setMunicipalityDestiny($municipalityDestiny)
    {
        $this->municipalityDestiny = $municipalityDestiny;
    }

    public function setFrequency($frequency)
    {
        $this->frequency = $frequency;
    }

    public function setShipmentAccepted($shipmentAccepted)
    {
        $this->shipmentAccepted = $shipmentAccepted;
    }

    public function setEffectiveDays($effectiveDays)
    {
        $this->effectiveDays = $effectiveDays;
    }

    public function setContactName($contactName)
    {
        $this->contactName = $contactName;
    }

    public function setContactPhone($contactPhone)
    {
        $this->contactPhone = $contactPhone;
    }
    
    public function setSourceDate(DateTime $sourceDate)
    {
        $this->sourceDate = $sourceDate;
    }

    public function setSourceAddress($sourceAddress)
    {
        $this->sourceAddress = $sourceAddress;
    }
    
    public function setDestinyDate(DateTime $destinyDate)
    {
        $this->destinyDate = $destinyDate;
    }

    public function setDestinyAddress($destinyAddress)
    {
        $this->destinyAddress = $destinyAddress;
    }
    
    public function setShipmentType($shipmentType)
    {
        $this->shipmentType = $shipmentType;
    }
    
    public function getTypeText()
    {
  
            $typeText='Cargas';
            $eventText='Rutas';
      
        return array($typeText, $eventText);
    }

}
