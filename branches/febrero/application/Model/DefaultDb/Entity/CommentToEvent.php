<?php

/**
 * @Entity
 * @Table(name="comments_to_events")
 */
class DefaultDb_Entity_CommentToEvent
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
     * @Column(type="smallint", name="event_type")
     * @var integer
     */
    private $eventType;

    /**
     * @Column(type="integer", name="event_id")
     * @var integer
     */
    private $eventId;

    /**
     * @Column(type="datetime", name="comment_date")
     * @var DateTime
     */
    private $commentDate;

    public function getId()
    {
        return $this->id;
    }

    public function getUser()
    {
        return $this->user;
    }

    public function getComment()
    {
        return $this->comment;
    }

    public function getEventType()
    {
        return $this->eventType;
    }

    public function getEventId()
    {
        return $this->eventId;
    }

    public function getCommentDate()
    {
        return $this->commentDate;
    }

    public function setUser($user)
    {
        $this->user = $user;
    }

    public function setComment($comment)
    {
        $this->comment = $comment;
    }

    public function setEventType($eventType)
    {
        $this->eventType = $eventType;
    }

    public function setEventId($eventId)
    {
        $this->eventId = $eventId;
    }

    public function setCommentDate(DateTime $commentDate)
    {
        $this->commentDate = $commentDate;
    }

}