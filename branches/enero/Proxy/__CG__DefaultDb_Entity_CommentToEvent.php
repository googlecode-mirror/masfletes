<?php

namespace Proxy\__CG__;

/**
 * THIS CLASS WAS GENERATED BY THE DOCTRINE ORM. DO NOT EDIT THIS FILE.
 */
class DefaultDb_Entity_CommentToEvent extends \DefaultDb_Entity_CommentToEvent implements \Doctrine\ORM\Proxy\Proxy
{
    private $_entityPersister;
    private $_identifier;
    public $__isInitialized__ = false;
    public function __construct($entityPersister, $identifier)
    {
        $this->_entityPersister = $entityPersister;
        $this->_identifier = $identifier;
    }
    /** @private */
    public function __load()
    {
        if (!$this->__isInitialized__ && $this->_entityPersister) {
            $this->__isInitialized__ = true;

            if (method_exists($this, "__wakeup")) {
                // call this after __isInitialized__to avoid infinite recursion
                // but before loading to emulate what ClassMetadata::newInstance()
                // provides.
                $this->__wakeup();
            }

            if ($this->_entityPersister->load($this->_identifier, $this) === null) {
                throw new \Doctrine\ORM\EntityNotFoundException();
            }
            unset($this->_entityPersister, $this->_identifier);
        }
    }

    /** @private */
    public function __isInitialized()
    {
        return $this->__isInitialized__;
    }

    
    public function getId()
    {
        if ($this->__isInitialized__ === false) {
            return (int) $this->_identifier["id"];
        }
        $this->__load();
        return parent::getId();
    }

    public function getUser()
    {
        $this->__load();
        return parent::getUser();
    }

    public function getComment()
    {
        $this->__load();
        return parent::getComment();
    }

    public function getEventType()
    {
        $this->__load();
        return parent::getEventType();
    }

    public function getEventId()
    {
        $this->__load();
        return parent::getEventId();
    }

    public function getCommentDate()
    {
        $this->__load();
        return parent::getCommentDate();
    }

    public function setUser($user)
    {
        $this->__load();
        return parent::setUser($user);
    }

    public function setComment($comment)
    {
        $this->__load();
        return parent::setComment($comment);
    }

    public function setEventType($eventType)
    {
        $this->__load();
        return parent::setEventType($eventType);
    }

    public function setEventId($eventId)
    {
        $this->__load();
        return parent::setEventId($eventId);
    }

    public function setCommentDate(\DateTime $commentDate)
    {
        $this->__load();
        return parent::setCommentDate($commentDate);
    }


    public function __sleep()
    {
        return array('__isInitialized__', 'id', 'comment', 'eventType', 'eventId', 'commentDate', 'user');
    }

    public function __clone()
    {
        if (!$this->__isInitialized__ && $this->_entityPersister) {
            $this->__isInitialized__ = true;
            $class = $this->_entityPersister->getClassMetadata();
            $original = $this->_entityPersister->load($this->_identifier);
            if ($original === null) {
                throw new \Doctrine\ORM\EntityNotFoundException();
            }
            foreach ($class->reflFields as $field => $reflProperty) {
                $reflProperty->setValue($this, $reflProperty->getValue($original));
            }
            unset($this->_entityPersister, $this->_identifier);
        }
        
    }
}