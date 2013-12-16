<?php

/**
 * @Entity
 * @Table(name="units")
 */
class DefaultDb_Entity_Unit
{
    
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
     * @Column
     * @var string 
     */
    private $brand;

    /**
     * @Column
     * @var string
     */
    private $model;

    /**
     * @Column
     * @var string
     */
    private $color;

    /**
     * @Column(name="economic_number")
     * @var string
     */
    private $economicNumber;

    /**
     * @Column
     * @var string
     */
    private $plates;

    /**
     * @Column
     * @var string
     */
    private $comments;
       
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

    public function getBrand()
    {
        return $this->brand;
    }

    public function setBrand($brand)
    {
        $this->brand = $brand;
    }

    public function getModel()
    {
        return $this->model;
    }

    public function setModel($model)
    {
        $this->model = $model;
    }

    public function getColor()
    {
        return $this->color;
    }

    public function setColor($color)
    {
        $this->color = $color;
    }

    public function getComments()
    {
        return $this->comments;
    }

    public function setComments($comments)
    {
        $this->comments = $comments;
    }

    public function getEconomicNumber()
    {
        return $this->economicNumber;
    }

    public function setEconomicNumber($economicNumber)
    {
        $this->economicNumber = $economicNumber;
    }

    public function getPlates()
    {
        return $this->plates;
    }

    public function setPlates($plates)
    {
        $this->plates = $plates;
    }
}
