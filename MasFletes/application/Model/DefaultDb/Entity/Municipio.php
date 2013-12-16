<?php

/**
 * @Entity
 * @Table(name="municipios")
 */
class DefaultDb_Entity_Municipio
{
    /**
     * @id @Column(type="integer")
     * @GeneratedValue
     * @var integer  
     */
    private $id;
     
    /**
     * @municipio @Column(type="varchar")
     * @var string
     */
    private $municipio;
    
    /**
     * @idEdo @Column(type="integer")
     * @ManyToOne(targetEntity="DefaultDb_Entity_Edos")
     * @joinColumn(onDelete="CASCADE")
     */
    private $idEdo;
    
    public function getId()
    {
        return $this->id;
    }

    public function getMunicipio()
    {
        return $this->municipio;
    }

    public function getIdEdo()
    {
        return $this->idEdo;
    }

}