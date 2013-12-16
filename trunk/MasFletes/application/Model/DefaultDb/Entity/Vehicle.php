<?php

/**
 * @Entity
 * @Table(name="vehicles")
 */
class DefaultDb_Entity_Vehicle
{
    
    /**
     * @Id @Column(type="integer")
     * @GeneratedValue
     * @var integer  
     */
    private $id;

    /**
     * @Column
     * @var string 
     */
    private $name;

    /**
     * @Column
     * @var string
     */
    private $description;

    /**
     * @Column(type="integer")
     * @var integer
     */
    private $capacity;
    
    public function getId()
    {
        return $this->id;
    }

    public function getName()
    {
        return $this->name;
    }

    public function getDescription()
    {
        return $this->description;
    }

    public function getCapacity()
    {
        return $this->capacity;
    }
    
    public function setName($name)
    {
        $this->name = $name;
    }
    
    public function setDescription($description)
    {
        $this->description = $description;
    }
    
    public function setCapacity($capacity)
    {
        $this->capacity = $capacity;
    }

}
