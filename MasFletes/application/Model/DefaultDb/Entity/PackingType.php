<?php

/**
 * @Entity
 * @Table(name="packing_types")
 */
class DefaultDb_Entity_PackingType
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

    public function setName($name)
    {
        $this->name = $name;
    }

    public function setDescription($description)
    {
        $this->description = $description;
    }

}