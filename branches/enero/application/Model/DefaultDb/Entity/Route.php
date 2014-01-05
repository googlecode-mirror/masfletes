<?php

/**
 * @Entity
 * @Table(name="routes")
 */
class DefaultDb_Entity_Route
{
    /**
     * @Id @Column(type="integer")
     * @GeneratedValue
     * @var integer  
     */
    private $id;

    /**
     * @ManyToOne(targetEntity="DefaultDb_Entity_VehicleType")
     * @joinColumn(onDelete="CASCADE")
     */
    private $vehicleType;
    
    /**
     * @ManyToOne(targetEntity="DefaultDb_Entity_Unit")
     * @joinColumn(onDelete="CASCADE")
     */
    private $unit;
    
    /**
     * @ManyToOne(targetEntity="DefaultDb_Entity_Driver")
     * @joinColumn(onDelete="CASCADE")
     */
    private $driver;
    
    /**
     * @ManyToOne(targetEntity="DefaultDb_Entity_Vehicle")
     * @joinColumn(onDelete="CASCADE")
     */
    private $vehicle;
    
    /**
     * @ManyToOne(targetEntity="DefaultDb_Entity_User")
     * @joinColumn(onDelete="CASCADE")
     */
    private $user;
    
    /**
     * @ManyToOne(targetEntity="DefaultDb_Entity_State")
     * @joinColumn(onDelete="CASCADE")
     */
    private $stateOrigin;
    
    /**
     * @ManyToOne(targetEntity="DefaultDb_Entity_State")
     * @joinColumn(onDelete="CASCADE")
     */
    private $stateDestiny;
    
    /**
     * @ManyToOne(targetEntity="DefaultDb_Entity_City")
     * @joinColumn(onDelete="CASCADE")
     */
    private $municipalityOrigin;
    
    /**
     * @ManyToOne(targetEntity="DefaultDb_Entity_City")
     * @joinColumn(onDelete="CASCADE")
     */
    private $municipalityDestiny;
    
    /**
     * @Column(type="datetime", name="load_availability_date")
     * @var DateTime
     */
    private $loadAvailabilityDate;
       
    /**
     * @Column(name="tires_condition")
     * @var string
     */
    private $tiresCondition;
    
    /**
     * @Column(type="smallint", name="letter_mechanical_conditions")
     * @var integer
     */
    private $letterMechanicalConditions;
    
    /**
     * @Column(type="smallint")
     * @var integer
     */
    private $plates;
    
    /**
     * @Column(type="smallint", name="driver_licence")
     * @var integer
     */
    private $driverLicence;
    
    /**
     * @Column(type="smallint", name="own_tarpaulin")
     * @var integer
     */
    private $ownTarpaulin;
    
    /**
     * @Column(type="smallint", name="satelital_tracking")
     * @var integer
     */
    private $satelitalTracking;
    
    /**
     * @Column(name="cellular_phone")
     * @var string
     */
    private $cellularPhone;
    
    /**
     * @Column
     * @var string
     */
    private $frequency;
    
    /**
     * @Column(name="letters_carry")
     * @var string
     */
    private $letters_carry;
    
    /**
     * @Column
     * @var string
     */
    private $email;
    
    /**
     * @Column
     * @var string
     */
    private $comments;
    
    /**
     * @Column(type="smallint", name="route_accepted")
     * @var integer
     */
    private $routeAccepted;
    
    /**
     * @Column(type="integer", name="effective_days")
     * @var integer
     */
    private $effectiveDays;
    
    public function getId()
    {
        return $this->id;
    }

    public function setId($id)
    {
        $this->id = $id;
    }

    public function getVehicleType()
    {
        return $this->vehicleType;
    }

    public function setVehicleType($vehicleType)
    {
        $this->vehicleType = $vehicleType;
    }    
    
    public function getVehicle()
    {
        return $this->vehicle;
    }

    public function setVehicle($vehicle)
    {
        $this->vehicle = $vehicle;
    }
    
    public function setDriver($driver)
    {
        $this->driver = $driver;
    }
    
    public function getDriver()
    {
        return $this->driver;
    }

    public function getUnit()
    {
        return $this->unit;
    }

    public function setUnit($unit)
    {
        $this->unit = $unit;
    }

    public function getUser()
    {
        return $this->user;
    }

    public function setUser($user)
    {
        $this->user = $user;
    }

    public function getStateOrigin()
    {
        return $this->stateOrigin;
    }

    public function setStateOrigin($estateOrigin)
    {
        $this->stateOrigin = $estateOrigin;
    }

    public function getStateDestiny()
    {
        return $this->stateDestiny;
    }

    public function setStateDestiny($estateDestiny)
    {
        $this->stateDestiny = $estateDestiny;
    }

    public function getMunicipalityOrigin()
    {
        return $this->municipalityOrigin;
    }

    public function setMunicipalityOrigin($municipalityOrigin)
    {
        $this->municipalityOrigin = $municipalityOrigin;
    }

    public function getMunicipalityDestiny()
    {
        return $this->municipalityDestiny;
    }

    public function setMunicipalityDestiny($municipalityDestiny)
    {
        $this->municipalityDestiny = $municipalityDestiny;
    }

    public function getLoadAvailabilityDate()
    {
        return $this->loadAvailabilityDate;
    }

    public function setLoadAvailabilityDate($loadAvailabilityDate)
    {
        $this->loadAvailabilityDate = $loadAvailabilityDate;
    }

    public function getTiresCondition()
    {
        return $this->tiresCondition;
    }

    public function setTiresCondition($tiresCondition)
    {
        $this->tiresCondition = $tiresCondition;
    }

    public function getLetterMechanicalConditions()
    {
        return $this->letterMechanicalConditions;
    }

    public function setLetterMechanicalConditions($letterMechanicalConditions)
    {
        $this->letterMechanicalConditions = $letterMechanicalConditions;
    }

    public function getPlates()
    {
        return $this->plates;
    }

    public function setPlates($plates)
    {
        $this->plates = $plates;
    }

    public function getDriverLicence()
    {
        return $this->driverLicence;
    }

    public function setDriverLicence($driverLicence)
    {
        $this->driverLicence = $driverLicence;
    }

    public function getOwnTarpaulin()
    {
        return $this->ownTarpaulin;
    }

    public function setOwnTarpaulin($ownTarpaulin)
    {
        $this->ownTarpaulin = $ownTarpaulin;
    }

    public function getSatelitalTracking()
    {
        return $this->satelitalTracking;
    }

    public function setSatelitalTracking($satelitalTracking)
    {
        $this->satelitalTracking = $satelitalTracking;
    }

    public function getCellularPhone()
    {
        return $this->cellularPhone;
    }

    public function setCellularPhone($cellularPhone)
    {
        $this->cellularPhone = $cellularPhone;
    }

    public function getFrequency()
    {
        return $this->frequency;
    }

    public function setFrequency($frequency)
    {
        $this->frequency = $frequency;
    }

    public function getLetters_carry()
    {
        return $this->letters_carry;
    }

    public function setLetters_carry($letters_carry)
    {
        $this->letters_carry = $letters_carry;
    }

    public function getEmail()
    {
        return $this->email;
    }

    public function setEmail($email)
    {
        $this->email = $email;
    }

    public function getComments()
    {
        return $this->comments;
    }

    public function setComments($comments)
    {
        $this->comments = $comments;
    }

    public function getRouteAccepted()
    {
        return $this->routeAccepted;
    }

    public function setRouteAccepted($routeAccepted)
    {
        $this->routeAccepted = $routeAccepted;
    }

    public function getEffectiveDays()
    {
        return $this->effectiveDays;
    }

    public function setEffectiveDays($effectiveDays)
    {
        $this->effectiveDays = $effectiveDays;
    }
}
