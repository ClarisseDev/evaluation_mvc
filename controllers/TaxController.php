<?php
declare(strict_types=1);

require_once __DIR__ . '/../models/Owner.php';
require_once __DIR__ . '/../models/Flat.php';
require_once __DIR__ . '/../models/House.php';
require_once __DIR__ . '/../repositories/OwnerRepository.php';

class TaxController
{
    private $ownerRepository;

    public function __construct()
    {
        $this->ownerRepository = new OwnerRepository();
    }

    public function index(): void
    {
        include 'views/home.php';
    }

    public function calculateTax(): void
    {
        try {
            $ownerId = isset($_POST['ownerId']) ? filter_var($_POST['ownerId'], FILTER_VALIDATE_INT) : null;
            if ($ownerId === false || $ownerId === null || $ownerId < 1) {
                $ownerId = null;
            } else {
                $ownerId = (int) $ownerId;
            }

            $propertyType = $_POST['propertyType'] ?? '';

            if ($propertyType === 'flat') {
                $region = $_POST['flatRegion'] ?? $_POST['region'];
                if ($region === 'Autre') {
                    $region = $_POST['flatRegionName'] ?? $_POST['regionName'];
                }
                $city = $_POST['flatCity'] ?? $_POST['city'];
                $surface = isset($_POST['flatSurface']) ? (int)$_POST['flatSurface'] : (int)$_POST['surface'];
                $floor = isset($_POST['flatFloor']) ? (int)$_POST['flatFloor'] : (int)$_POST['floor'];

                $property = new Flat($region, $city, $surface, $floor);
            } elseif ($propertyType === 'house') {
                $region = $_POST['houseRegion'] ?? $_POST['region'];
                if ($region === 'Autre') {
                    $region = $_POST['houseRegionName'] ?? $_POST['regionName'];
                }
                $city = $_POST['houseCity'] ?? $_POST['city'];
                $surface = isset($_POST['houseSurface']) ? (int)$_POST['houseSurface'] : (int)$_POST['surface'];
                $hasPool = isset($_POST['hasPool']) && $_POST['hasPool'] === '1';

                $property = new House($region, $city, $surface, $hasPool);
            } else {
                throw new Exception('Type de bien non reconnu.');
            }

            if (!isset($property)) {
                throw new Exception('Propriété non définie.');
            }

            if ($ownerId) {
                $owner = $this->ownerRepository->findOwnerById($ownerId);
                $owner->addProperty($property);
                $this->ownerRepository->saveProperty($property, $ownerId);
            } else {
                $owner = new Owner($_POST['firstName'], $_POST['lastName']);
                $owner->addProperty($property);
                $this->ownerRepository->saveOwner($owner);
            }

            $totalTax = $this->calculateTotalTax($owner);
            include 'views/result.php';

        } catch (\Exception $e) {
            $_SESSION['error'] = "Erreur : " . $e->getMessage();
            header("Location: index.php");
            exit;
        }
    }

    private function calculateTotalTax(Owner $owner): int
    {
        $total = 0;
        foreach ($owner->getProperties() as $property) {
            $total += $property->calculateTax();
        }
        return $total;
    }
}
