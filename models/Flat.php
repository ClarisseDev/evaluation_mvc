<?php
declare(strict_types=1);

require_once __DIR__ . '/Property.php';

class Flat extends Property
{
    private $floor;


    public function __construct(string $region, string $city, int $surface, int $floor, ?int $idProperty = null) 
    {
        parent::__construct($region, $city, $surface, $idProperty);
        $this->floor = $floor;
    }


    public function calculateTax(): int
    {
        if ($this->region === 'Occitanie') 
        {
            $taxe = $this->surface * 12;                // appartement (12 €/m2)
        }
        else
        {
            $taxe = $this->surface * 13;                // appartement (13 €/m2) 
        }

        return (int)$taxe;
    }
    


    /**
     * Get the value of floor
     */ 
    public function getFloor(): int
    {
        return $this->floor;
    }

    /**
     * Set the value of floor
     *
     * @return  self
     */ 
    public function setFloor($floor)
    {
        $this->floor = $floor;

        return $this;
    }
}

?>