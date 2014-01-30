<?php

/**
 * @Entity
 * @Table(name="cities")
 */
class DefaultDb_Entity_City
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
     * @ManyToOne(targetEntity="DefaultDb_Entity_State", inversedBy="cities")
     * @joinColumn(onDelete="CASCADE")
     */
    private $state;
    
    public function getId()
    {
        return $this->id;
    }

    public function getName()
    {
        return $this->name;
    }

    public function getState()
    {
        return $this->state;
    }

}