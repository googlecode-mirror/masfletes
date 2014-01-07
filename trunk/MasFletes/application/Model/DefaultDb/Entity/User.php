<?php

/**
 * @Entity(repositoryClass="DefaultDb_Repositories_UserRepository")
 * @Table(name="users")
 */
class DefaultDb_Entity_User
{

    const TYPE_ADMIN = 1;
    const TYPE_COORDINATOR = 2;
    const TYPE_USER = 3;

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
    private $username;

    /**
     * @Column
     * @var string
     */
    private $password;

    /**
     * @Column(type="integer")
     * @var integer
     */
    private $type;

    /**
     * @Column(name="first_name")
     * @var string
     */
    private $firstName;

    /**
     * @Column(name="last_name")
     * @var string
     */
    private $lastName;

    /**
     * @Column
     * @var string
     */
    private $address;

    /**
     * @Column
     * @var string
     */
    private $city;

    /**
     * @Column
     * @var string
     */
    private $state;

    /**
     * @Column
     * @var string
     */
    private $country;

    /**
     * @Column(name="zip_code")
     * @var string
     */
    private $zipCode;

    /**
     * @Column
     * @var string
     */
    private $phone;
    
    public function getId()
    {
        return $this->id;
    }

    public function setId($id)
    {
        $this->id = $id;
    }

    public function getUsername()
    {
        return $this->username;
    }

    public function setUsername($username)
    {
        $this->username = $username;
    }

    public function getPassword()
    {
        return $this->password;
    }

    public function setPassword($password)
    {
        $this->password = $password;
    }

    public function getType()
    {
        return $this->type;
    }

    public function setType($type)
    {
        $this->type = $type;
    }

    public function getFirstName()
    {
        return $this->firstName;
    }

    public function setFirstName($firstName)
    {
        $this->firstName = $firstName;
    }

    public function getLastName()
    {
        return $this->lastName;
    }

    public function setLastName($lastName)
    {
        $this->lastName = $lastName;
    }

    public function getAddress()
    {
        return $this->address;
    }

    public function setAddress($address)
    {
        $this->address = $address;
    }

    public function getCity()
    {
        return $this->city;
    }

    public function setCity($city)
    {
        $this->city = $city;
    }

    public function getState()
    {
        return $this->state;
    }

    public function setState($state)
    {
        $this->state = $state;
    }

    public function getCountry()
    {
        return $this->country;
    }

    public function setCountry($country)
    {
        $this->country = $country;
    }

    public function getZipCode()
    {
        return $this->zipCode;
    }

    public function setZipCode($zipCode)
    {
        $this->zipCode = $zipCode;
    }

    public function getPhone()
    {
        return $this->phone;
    }

    public function setPhone($phone)
    {
        $this->phone = $phone;
    }
    
    public function getData()
    {
        return array('id' => $this->id, 'username' => $this->username, 'password' => $this->password, 'type' => $this->type);
    }


}
