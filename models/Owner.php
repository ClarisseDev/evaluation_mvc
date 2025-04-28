<?php
declare(strict_types=1);

class Owner
{
    private $idOwner;
    private $firstName;
    private $lastName;
    private $properties = [];

    public function __construct(string $firstName, string $lastName, ?int $idOwner = null)
    {
        $this->idOwner = $idOwner;
        $this->firstName = $firstName;
        $this->lastName = $lastName;
    }

    public function addProperty($property) {
        $this->properties[] = $property;
    }

    public function getProperties() {
        return $this->properties;
    }

    public function getFullName() {
        return $this->firstName . ' ' . $this->lastName;
    }

    /**
     * Get the value of firstname
     */ 
    public function getFirstname()
    {
        return $this->firstName;
    }

    /**
     * Set the value of firstname
     *
     * @return  self
     */ 
    public function setFirstname($firstName)
    {
        $this->firstName = $firstName;

        return $this;
    }

    /**
     * Get the value of lastname
     */ 
    public function getLastname()
    {
        return $this->lastName;
    }

    /**
     * Set the value of lastname
     *
     * @return  self
     */ 
    public function setLastname($lastName)
    {
        $this->lastName = $lastName;

        return $this;
    }

    /**
     * Get the value of id_owner
     */ 
    public function getId()
    {
        return $this->idOwner;
    }

    /**
     * Set the value of id_owner
     *
     * @return  self
     */ 
    public function setId($idOwner)
    {
        $this->idOwner = $idOwner;

        return $this;
    }
}

?>