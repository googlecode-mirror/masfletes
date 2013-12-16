<?php

/**
 * @Entity
 * @Table(name="estados")
 */
class DefaultDb_Entity_Edos
{
    /**
     * @Id @Column(type="integer")
     * @GeneratedValue
     * @var integer
     * @OneToMany(targetEntity="DefaultDb_Entity_Municipio")
     * @joinColumn(onDelete="CASCADE")
     */
    private $id;
     
    /**
     * @estado @Column(type="string", length=255)
     * @var string
     */
    private $estado;
    
    /**
     * @abrev @Column(type="string", length=100)
     * @var string
     */
    private $abrev;
    
    public function getId()
    {
        return $this->id;
    }

    public function getEstado()
    {
        return $this->estado;
    }

    public function getAbrev()
    {
        return $this->abrev;
    }

}