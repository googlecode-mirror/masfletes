<?php

/**
 * @Entity
 * @Table(name="drivers")
 */
class DefaultDb_Entity_Driver
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
     * @Column
     * @var string 
     */
    private $name;

    /**
     * @Column
     * @var string
     */
    private $licence;

    /**
     * @Column(type="datetime", name="license_duration")
     * @var DateTime
     */
    private $licenceDuration;

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

    public function getName()
    {
        return $this->name;
    }

    public function setName($name)
    {
        $this->name = $name;
    }

    public function getLicence()
    {
        return $this->licence;
    }

    public function setLicence($licence)
    {
        $this->licence = $licence;
    }

    public function getLicenceDuration()
    {
        return $this->licenceDuration;
    }

    public function setLicenceDuration($licenceDuration)
    {
        $this->licenceDuration = $licenceDuration;
    }
}