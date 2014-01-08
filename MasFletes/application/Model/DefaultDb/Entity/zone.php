<?php

/**
 * @Entity(repositoryClass="DefaultDb_Repositories_ZoneRepository")
 * @Table(name="zone")
 */
class DefaultDb_Entity_Zone
{
    /**
     * @Id @Column(type="integer")
     * @GeneratedValue
     * @var integer  
     */
    private $id_zone;
     
    /**
     * @Column
     * @var string
     */
    private $name;
    
    /**
     * @Column
     * @var integer
     */
    private $number;
    /**
     * @Column
     * @var integer
     */
    private $id_state;
    /**
     * @Column
     * @var integer
     */
    private $id_city;
    
    public function getId()
    {
        return $this->id_zone;
    }

    public function getName()
    {
        return $this->name;
    }

    public function getNumber()
    {
        return $this->number;
    }
    public function getState()
    {
        return $this->id_state;
    }
    public function getCity()
    {
        return $this->id_city;
    }

}