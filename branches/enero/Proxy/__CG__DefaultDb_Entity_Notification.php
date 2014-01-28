<?php

namespace Proxy\__CG__;

/**
 * THIS CLASS WAS GENERATED BY THE DOCTRINE ORM. DO NOT EDIT THIS FILE.
 */
class DefaultDb_Entity_Notification extends \DefaultDb_Entity_Notification implements \Doctrine\ORM\Proxy\Proxy
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

    public function setId($id)
    {
        $this->__load();
        return parent::setId($id);
    }

    public function getUser()
    {
        $this->__load();
        return parent::getUser();
    }

    public function setUser($user)
    {
        $this->__load();
        return parent::setUser($user);
    }

    public function getVehicle()
    {
        $this->__load();
        return parent::getVehicle();
    }

    public function setVehicle($vehicle)
    {
        $this->__load();
        return parent::setVehicle($vehicle);
    }

    public function getVehicleType()
    {
        $this->__load();
        return parent::getVehicleType();
    }

    public function setVehicleType($vehicleType)
    {
        $this->__load();
        return parent::setVehicleType($vehicleType);
    }

    public function getStateOrigin()
    {
        $this->__load();
        return parent::getStateOrigin();
    }

    public function setStateOrigin($stateOrigin)
    {
        $this->__load();
        return parent::setStateOrigin($stateOrigin);
    }

    public function getStateDestiny()
    {
        $this->__load();
        return parent::getStateDestiny();
    }

    public function setStateDestiny($stateDestiny)
    {
        $this->__load();
        return parent::setStateDestiny($stateDestiny);
    }

    public function getMunicipalityOrigin()
    {
        $this->__load();
        return parent::getMunicipalityOrigin();
    }

    public function setMunicipalityOrigin($municipalityOrigin)
    {
        $this->__load();
        return parent::setMunicipalityOrigin($municipalityOrigin);
    }

    public function getMunicipalityDestiny()
    {
        $this->__load();
        return parent::getMunicipalityDestiny();
    }

    public function setMunicipalityDestiny($municipalityDestiny)
    {
        $this->__load();
        return parent::setMunicipalityDestiny($municipalityDestiny);
    }

    public function getActionType()
    {
        $this->__load();
        return parent::getActionType();
    }

    public function setActionType($actionType)
    {
        $this->__load();
        return parent::setActionType($actionType);
    }

    public function getNotificationDate()
    {
        $this->__load();
        return parent::getNotificationDate();
    }

    public function setNotificationDate($notificationDate)
    {
        $this->__load();
        return parent::setNotificationDate($notificationDate);
    }


    public function __sleep()
    {
        return array('__isInitialized__', 'id', 'actionType', 'notificationDate', 'user', 'vehicle', 'vehicleType', 'stateOrigin', 'stateDestiny', 'municipalityOrigin', 'municipalityDestiny');
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