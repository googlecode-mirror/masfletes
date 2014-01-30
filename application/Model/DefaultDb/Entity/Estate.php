<?php

/**
 * @Entity
 * @Table(name="estates")
 */
class DefaultDb_Entity_Estate
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
     * @Column(type="datetime", name="comment_date")
     * @var DateTime
     */
    private $commentDate;
}