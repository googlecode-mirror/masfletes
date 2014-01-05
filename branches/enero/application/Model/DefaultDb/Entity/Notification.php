<?php

/**
 * @Entity
 * @Table(name="notifications")
 */
class DefaultDb_Entity_Notification
{
    const ACTION_TYPE_SHIPMENT = 1;
    const ACTION_TYPE_ROUTE = 2;

    /**
     * @Id @Column(type="integer")
     * @GeneratedValue
     * @var integer  
     */
    private $id;
     
    /**
     * @ManyToOne(targetEntity="DefaultDb_Entity_User")
     * @joinColumn(onDelete="CASCADE")
     */
    private $user;

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
     * @Column(type="smallint", name="action_type")
     * @var integer
     */
    private $actionType;
    
    /**
     * @Column(type="datetime", name="notification_date")
     * @var DateTime
     */
    private $notificationDate;
    
    public function getId()
    {
        return $this->id;
    }

    public function setId($id)
    {
        $this->id = $id;
    }

    public function getUser()
    {
        return $this->user;
    }

    public function setUser($user)
    {
        $this->user = $user;
    }

    public function getVehicle()
    {
        return $this->vehicle;
    }

    public function setVehicle($vehicle)
    {
        $this->vehicle = $vehicle;
    }
    
    public function getVehicleType()
    {
        return $this->vehicleType;
    }

    public function setVehicleType($vehicleType)
    {
        $this->vehicleType = $vehicleType;
    }
        
    public function getStateOrigin()
    {
        return $this->stateOrigin;
    }

    public function setStateOrigin($stateOrigin)
    {
        $this->stateOrigin = $stateOrigin;
    }

    public function getStateDestiny()
    {
        return $this->stateDestiny;
    }

    public function setStateDestiny($stateDestiny)
    {
        $this->stateDestiny = $stateDestiny;
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

    public function getActionType()
    {
        return $this->actionType;
    }

    public function setActionType($actionType)
    {
        $this->actionType = $actionType;
    }

    public function getNotificationDate()
    {
        return $this->notificationDate;
    }

    public function setNotificationDate($notificationDate)
    {
        $this->notificationDate = $notificationDate;
    }
}