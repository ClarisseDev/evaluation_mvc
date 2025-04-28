<?php
declare(strict_types=1);

require_once __DIR__ . '/DBConnect.php';

abstract class PropertyRepository extends DBConnect
{

    // Supprime un bien 
    public function delete(int $idProperty): void
    {
        $this->getPdo()->prepare("DELETE FROM property WHERE id_property = ?")
                      ->execute([$idProperty]);
    }


    // Trouve les biens d'un propriétaire 
    public function findByOwner(int $idOwner): array
    {
        $stmt = $this->getPdo()->prepare(
            "SELECT * FROM property WHERE id_owner = ?"
        );
        $stmt->execute([$idOwner]);
        return $stmt->fetchAll(\PDO::FETCH_ASSOC);
    }
}
?>