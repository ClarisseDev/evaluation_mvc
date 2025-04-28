<?php
declare(strict_types=1);

class DBConnect
{
    protected static $pdo = null;

    // Constructeur privé pour empêcher la création d'instances de cette classe
    protected function __construct() {}

    // Méthode statique pour obtenir la connexion PDO
    public static function getPdo(): PDO
    {
        if (self::$pdo === null) {
            $dsn = "mysql:host=localhost;dbname=taxe_fonciere;charset=utf8mb4";
            $username = "root";
            $password = "";

            try {
                self::$pdo = new PDO($dsn, $username, $password);
                self::$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            } catch (PDOException $e) {
                die("Erreur de connexion : " . $e->getMessage());
            }
        }
        return self::$pdo;
    }
}
?>
