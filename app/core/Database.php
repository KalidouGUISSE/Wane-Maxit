<?php
namespace App\Core;

use PDO;
use PDOException;
class Database {
    private static ?PDO $pdo = null;

    public static function getConnection(): PDO {
        if (self::$pdo === null) {
            $host = 'localhost';
            $dbname = 'maxitsa';
            $username = 'kalidou';
            $password = 'kalidou';

            try {
                self::$pdo = new PDO("pgsql:host=$host;dbname=$dbname", $username, $password);
                self::$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            } catch (PDOException $e) {
                die("Erreur de connexion : " . $e->getMessage());
            }
        }
        return self::$pdo;
    }
}