<?php
declare(strict_types=1);

require_once __DIR__ . '/DBConnect.php';
require_once __DIR__ . '/../models/Owner.php';
require_once __DIR__ . '/../models/Property.php';
require_once __DIR__ . '/../models/Flat.php';
require_once __DIR__ . '/../models/House.php';


class OwnerRepository extends DBConnect
{
    public function __construct()
    {
        self::$pdo = self::getPdo();
    }

    // Enregistrer un propriétaire dans la BDD
    public function saveOwner(Owner $owner): void
    {
        try {
            $query = self::$pdo->prepare("
                INSERT INTO owners (first_name, last_name) 
                VALUES (:first_name, :last_name)
            ");
    
            $query->execute([
                ':first_name' => $owner->getFirstName(),
                ':last_name' => $owner->getLastName()
            ]);
    
            // Récupère l'ID et met à jour l'objet Owner
            $ownerId = (int)self::$pdo->lastInsertId();
            $owner->setId($ownerId); // Cette ligne est CRUCIALE
            
            foreach ($owner->getProperties() as $property) {
                $this->saveProperty($property, $ownerId);
            }
    
        } catch (\PDOException $e) {
            throw new \Exception("Erreur lors de la sauvegarde du propriétaire: " . $e->getMessage());
        }
    }

    // Enregistrer une propriété dans la BDD
    public function saveProperty(Property $property, int $ownerId): void
    {
        $params = [
            ':owner_id' => $ownerId,
            ':type' => get_class($property),
            ':region' => $property->getRegion(),
            ':city' => $property->getCity(),
            ':surface' => $property->getSurface(),
            ':tax' => $property->calculateTax(),
            ':floor' => null,
            ':has_pool' => false
        ];
    
        if ($property instanceof Flat) {
            $params[':floor'] = $property->getFloor();
        } elseif ($property instanceof House) {
            $params[':has_pool'] = $property->getHasPool();
        }
    
        $query = self::$pdo->prepare("
            INSERT INTO properties 
            (owner_id, type, region, city, surface, tax, floor, has_pool) 
            VALUES 
            (:owner_id, :type, :region, :city, :surface, :tax, :floor, :has_pool)
        ");
    
        $query->execute($params);
    }

    public function findOwnerById(int $id): Owner
    {
        // Conversion explicite
        $id = (int)$id;
        if ($id <= 0) {
            throw new InvalidArgumentException("ID invalide");
        }

        try {
            // Récupère le propriétaire
            $stmt = self::$pdo->prepare("SELECT * FROM owners WHERE id = ?");
            $stmt->execute([$id]);
            $ownerData = $stmt->fetch(PDO::FETCH_ASSOC);

            if (!$ownerData) {
                throw new \Exception("Propriétaire non trouvé");
            }

            $owner = new Owner($ownerData['first_name'], $ownerData['last_name'], (int)$ownerData['id']);

            // Récupère ses propriétés
            $properties = $this->findPropertiesByOwnerId((int)$ownerData['id']);
            foreach ($properties as $property) {
                $owner->addProperty($property);
            }

            return $owner;

        } catch (\PDOException $e) {
            throw new \Exception("Erreur de base de données: " . $e->getMessage());
        }
    }

    public function findPropertiesByOwnerId(int $ownerId): array
    {
        try {
            if ($ownerId <= 0) {
                throw new InvalidArgumentException("L'ID du propriétaire doit être positif");
            }
    
            $stmt = self::$pdo->prepare("SELECT * FROM properties WHERE owner_id = ?");
            $stmt->execute([$ownerId]);
            
            $properties = [];
            while ($propertyData = $stmt->fetch(PDO::FETCH_ASSOC)) {
                if ($propertyData['type'] === 'Flat') { 
                    $property = new Flat(
                        $propertyData['region'],
                        $propertyData['city'],
                        (int)$propertyData['surface'],
                        (int)$propertyData['floor'],
                        (int)$propertyData['id']
                    );
                } else {
                    $property = new House(
                        $propertyData['region'],
                        $propertyData['city'],
                        (int)$propertyData['surface'],
                        (bool)$propertyData['has_pool'],
                        (int)$propertyData['id']
                    );                    
                }
                $properties[] = $property;
            }
            return $properties;
        } catch (\PDOException $e) {
            throw new \Exception("Erreur de récupération des propriétés: " . $e->getMessage());
        }
    }

    public function updateOwner(Owner $owner): void
    {
        try {
            $stmt = self::$pdo->prepare("
                UPDATE owners 
                SET first_name = :first_name, last_name = :last_name
                WHERE id = :id
            ");
            $stmt->execute([
                ':first_name' => $owner->getFirstName(),
                ':last_name' => $owner->getLastName(),
                ':id' => $owner->getId()
            ]);
        } catch (\PDOException $e) {
            throw new \Exception("Erreur de mise à jour du propriétaire: " . $e->getMessage());
        }
    }


}
?>