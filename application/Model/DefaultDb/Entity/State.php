<?php

/**
 * @Entity
 * @Table(name="states")
 */
class DefaultDb_Entity_State
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
     * @OneToMany(targetEntity="DefaultDb_Entity_City", mappedBy="state")
     * */
    private $cities;

    public function setName($name)
    {
        $this->name = $name;
    }

    public function getId()
    {
        return $this->id;
    }

    public function getName()
    {
        return $this->name;
    }

    public function getCities()
    {
        return $this->cities;
    }

}