<?php
declare(strict_types=1);


require_once __DIR__ . '/Property.php';

class House extends Property
{
    private $hasPool ;


    public function __construct(string $region, string $city, int $surface, bool $hasPool, ?int $id = null) 
    {
        parent::__construct($region, $city, $surface, $id);
        $this->hasPool = $hasPool;
    }


    public function calculateTax(): int
    {
        if ($this->region === 'Occitanie') 
        {
            $taxe = $this->surface * 14;                //maison (14 €/m2)
        }
        else
        {
            $taxe = $this->surface * 15;                // maison (15 €/m2)  
        }

        if ($this->hasPool ) 
        {
            $taxe += 100;                              // Si piscine, un coût de 100€ est rajouté (quelque soit la région)
        }

        return (int)$taxe;
    }
    

    /**
     * Get the value of hasPool
     */ 
    public function getHasPool(): bool
    {
        return $this->hasPool;
    }

    /**
     * Set the value of hasPool
     *
     * @return  self
     */ 
    public function setHasPool($hasPool)
    {
        $this->hasPool = $hasPool;

        return $this;
    }
}

?>