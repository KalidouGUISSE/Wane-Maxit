<?php
require_once __DIR__ . '/../vendor/autoload.php';
require_once __DIR__ . '/../app/config/env.php'; 

// $user = 'postgres';
// $password = 'guisse'; 
$host = HOST;
$user = USER_NAME;
$password = PASSWORD; 
$dbname = DB_NAME;

try {
    // Connexion au serveur (pas à la base )
    $pdo = new PDO("pgsql:host=$host", $user, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    // Créer la base de données
    $pdo->exec("DROP DATABASE IF EXISTS $dbname");
    $pdo->exec("CREATE DATABASE $dbname");
    echo "✔ Base de données '$dbname' créée.\n";

    // Se reconnecter à la base de données créée
    $pdo = new PDO("pgsql:host=$host;dbname=$dbname", $user, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    // Toutes les requêtes SQL de migration
    $sql = <<<SQL

        -- 1. ENUM
        DO \$\$
        BEGIN
            IF NOT EXISTS (SELECT 1 FROM pg_type WHERE typname = 'type_de_compte') THEN
                CREATE TYPE type_de_compte AS ENUM ('principal', 'secondaire');
            END IF;

            IF NOT EXISTS (SELECT 1 FROM pg_type WHERE typname = 'type_transaction') THEN
                CREATE TYPE type_transaction AS ENUM ('depot', 'retrait', 'paiement');
            END IF;
        END
        \$\$;

        -- 2. Table profil
        CREATE TABLE IF NOT EXISTS profil (
            id SERIAL PRIMARY KEY,
            libelle VARCHAR(100) NOT NULL UNIQUE
        );

        INSERT INTO profil (libelle)
        VALUES 
            ('client'),
            ('service commercial')
        ON CONFLICT DO NOTHING;

        -- 3. Table utilisateur
        CREATE TABLE IF NOT EXISTS utilisateur (
            id SERIAL PRIMARY KEY,
            nom VARCHAR(100) NOT NULL,
            prenom VARCHAR(100) NOT NULL,
            num_tel VARCHAR(20),
            nci VARCHAR(50) NOT NULL UNIQUE,
            adresse TEXT,
            password VARCHAR(150),
            photo_recto TEXT,
            photo_verso TEXT,
            profil_id INTEGER REFERENCES profil(id) ON DELETE SET NULL
        );

        -- 4. Table compte
        CREATE TABLE IF NOT EXISTS compte (
            id SERIAL PRIMARY KEY,
            numero_du_compte VARCHAR(30) NOT NULL UNIQUE,
            solde NUMERIC(15,2) NOT NULL DEFAULT 0 CHECK (solde >= 0),
            type_compte type_de_compte NOT NULL,
            user_id INTEGER NOT NULL REFERENCES utilisateur(id) ON DELETE CASCADE,
            statut VARCHAR(10) NOT NULL DEFAULT 'inactif' CHECK (statut IN ('actif', 'inactif'))
        );

        -- 5. Table transaction
        CREATE TABLE IF NOT EXISTS transaction (
            id SERIAL PRIMARY KEY,
            date TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
            type_transaction type_transaction NOT NULL,
            compte_id INTEGER NOT NULL REFERENCES compte(id) ON DELETE CASCADE,
            numero_destinataire VARCHAR(15),
            tarif NUMERIC(10, 2)
        );

    SQL;

    // Exécution
    $pdo->exec($sql);
    echo "✔ Tables et types créés avec succès.\n";

} catch (PDOException $e) {
    echo "❌ Erreur : " . $e->getMessage() . "\n";
    exit(1);
}
