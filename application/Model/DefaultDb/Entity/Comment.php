<?php

/**
 * @Entity
 * @Table(name="comments")
 */
class DefaultDb_Entity_Comment
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
    private $comment;
    
    /**
     * @Column(type="datetime", name="comment_date")
     * @var DateTime
     */
    private $commentDate;
}