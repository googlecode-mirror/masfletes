<?php

namespace MasFletes\DefaultDb\Proxy\__CG__;

/**
 * THIS CLASS WAS GENERATED BY THE DOCTRINE ORM. DO NOT EDIT THIS FILE.
 */
class DefaultDb_Entity_Route extends \DefaultDb_Entity_Route implements \Doctrine\ORM\Proxy\Proxy
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

    public function setDriver($driver)
    {
        $this->__load();
        return parent::setDriver($driver);
    }

    public function getDriver()
    {
        $this->__load();
        return parent::getDriver();
    }

    public function getUnit()
    {
        $this->__load();
        return parent::getUnit();
    }

    public function setUnit($unit)
    {
        $this->__load();
        return parent::setUnit($unit);
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

    public function getStateOrigin()
    {
        $this->__load();
        return parent::getStateOrigin();
    }

    public function setStateOrigin($estateOrigin)
    {
        $this->__load();
        return parent::setStateOrigin($estateOrigin);
    }

    public function getStateDestiny()
    {
        $this->__load();
        return parent::getStateDestiny();
    }

    public function setStateDestiny($estateDestiny)
    {
        $this->__load();
        return parent::setStateDestiny($estateDestiny);
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

    public function getLoadAvailabilityDate()
    {
        $this->__load();
        return parent::getLoadAvailabilityDate();
    }

    public function setLoadAvailabilityDate($loadAvailabilityDate)
    {
        $this->__load();
        return parent::setLoadAvailabilityDate($loadAvailabilityDate);
    }

    public function getTiresCondition()
    {
        $this->__load();
        return parent::getTiresCondition();
    }

    public function setTiresCondition($tiresCondition)
    {
        $this->__load();
        return parent::setTiresCondition($tiresCondition);
    }

    public function getLetterMechanicalConditions()
    {
        $this->__load();
        return parent::getLetterMechanicalConditions();
    }

    public function setLetterMechanicalConditions($letterMechanicalConditions)
    {
        $this->__load();
        return parent::setLetterMechanicalConditions($letterMechanicalConditions);
    }

    public function getPlates()
    {
        $this->__load();
        return parent::getPlates();
    }

    public function setPlates($plates)
    {
        $this->__load();
        return parent::setPlates($plates);
    }

    public function getDriverLicence()
    {
        $this->__load();
        return parent::getDriverLicence();
    }

    public function setDriverLicence($driverLicence)
    {
        $this->__load();
        return parent::setDriverLicence($driverLicence);
    }

    public function getOwnTarpaulin()
    {
        $this->__load();
        return parent::getOwnTarpaulin();
    }

    public function setOwnTarpaulin($ownTarpaulin)
    {
        $this->__load();
        return parent::setOwnTarpaulin($ownTarpaulin);
    }

    public function getSatelitalTracking()
    {
        $this->__load();
        return parent::getSatelitalTracking();
    }

    public function setSatelitalTracking($satelitalTracking)
    {
        $this->__load();
        return parent::setSatelitalTracking($satelitalTracking);
    }

    public function getCellularPhone()
    {
        $this->__load();
        return parent::getCellularPhone();
    }

    public function setCellularPhone($cellularPhone)
    {
        $this->__load();
        return parent::setCellularPhone($cellularPhone);
    }

    public function getFrequency()
    {
        $this->__load();
        return parent::getFrequency();
    }

    public function setFrequency($frequency)
    {
        $this->__load();
        return parent::setFrequency($frequency);
    }

    public function getLetters_carry()
    {
        $this->__load();
        return parent::getLetters_carry();
    }

    public function setLetters_carry($letters_carry)
    {
        $this->__load();
        return parent::setLetters_carry($letters_carry);
    }

    public function getEmail()
    {
        $this->__load();
        return parent::getEmail();
    }

    public function setEmail($email)
    {
        $this->__load();
        return parent::setEmail($email);
    }

    public function getComments()
    {
        $this->__load();
        return parent::getComments();
    }

    public function setComments($comments)
    {
        $this->__load();
        return parent::setComments($comments);
    }

    public function getRouteAccepted()
    {
        $this->__load();
        return parent::getRouteAccepted();
    }

    public function setRouteAccepted($routeAccepted)
    {
        $this->__load();
        return parent::setRouteAccepted($routeAccepted);
    }

    public function getEffectiveDays()
    {
        $this->__load();
        return parent::getEffectiveDays();
    }

    public function setEffectiveDays($effectiveDays)
    {
        $this->__load();
        return parent::setEffectiveDays($effectiveDays);
    }


    public function __sleep()
    {
        return array('__isInitialized__', 'id', 'loadAvailabilityDate', 'tiresCondition', 'letterMechanicalConditions', 'plates', 'driverLicence', 'ownTarpaulin', 'satelitalTracking', 'cellularPhone', 'frequency', 'letters_carry', 'email', 'comments', 'routeAccepted', 'effectiveDays', 'vehicleType', 'unit', 'driver', 'vehicle', 'user', 'stateOrigin', 'stateDestiny', 'municipalityOrigin', 'municipalityDestiny');
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