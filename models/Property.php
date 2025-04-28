<?php
declare(strict_types=1);


abstract class Property
{
    protected $id_property;
    protected $region;
    protected $city;
    protected $surface;

    public function __construct(string $region, string $city, int $surface, ?int $id_property = null)
    {
        $this->region = $region;
        $this->city = $city;
        $this->surface = $surface;
        $this->id_property = $id_property;
    }

    abstract public function calculateTax();

    /**
     * Get the value of region
     */ 
    public function getRegion()
    {
        return $this->region;
    }

    /**
     * Set the value of region
     *
     * @return  self
     */ 
    public function setRegion($region)
    {
        $this->region = $region;

        return $this;
    }

    /**
     * Get the value of city
     */ 
    public function getCity()
    {
        return $this->city;
    }

    /**
     * Set the value of city
     *
     * @return  self
     */ 
    public function setCity($city)
    {
        $this->city = $city;

        return $this;
    }

    /**
     * Get the value of surface
     */ 
    public function getSurface()
    {
        return $this->surface;
    }

    /**
     * Set the value of surface
     *
     * @return  self
     */ 
    public function setSurface($surface)
    {
        $this->surface = $surface;

        return $this;
    }

    /**
     * Get the value of id_property
     */ 
    public function getId_property()
    {
        return $this->id_property;
    }

    /**
     * Set the value of id_property
     *
     * @return  self
     */ 
    public function setId_property($id_property)
    {
        $this->id_property = $id_property;

        return $this;
    }
}

?>