<?php

require_once __DIR__ . '/../vendor/autoload.php';
require_once __DIR__ . '/../app/config/env.php';

try {
    $dsn = DB_DRIVER . ":host=" . HOST . ";port=" . PORT . ";dbname=" . DB_NAME;
    $pdo = new PDO($dsn, USER_NAME, PASSWORD);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    echo "🔄 Insertion de fausses données...\n";

    // Profils
    $pdo->exec("
        INSERT INTO profil (libelle) VALUES
        ('admin'), ('client'), ('service commercial')
        ON CONFLICT DO NOTHING;
    ");

    // Utilisateurs
    $stmt = $pdo->prepare("
        INSERT INTO utilisateur (nom, prenom, num_tel, nci, adresse, photo_recto, photo_verso, password, profil_id)
        VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?)
    ");

    $password = password_hash("1234", PASSWORD_DEFAULT);
    $stmt->execute(["Diop", "Aissatou", "778889900", "123456789", "Dakar", "recto.jpg", "verso.jpg", $password, 1]);
    $stmt->execute(["Sow", "Mamadou", "776655443", "987654321", "Thies", "recto2.jpg", "verso2.jpg", $password, 2]);

    // Comptes
    $stmt = $pdo->prepare("
        INSERT INTO compte (numero_du_compte, solde, type_compte, user_id, statut)
        VALUES (?, ?, ?, ?, ?)
    ");
    $stmt->execute(["CPT001", 50000, "principal", 1, "actif"]);
    $stmt->execute(["CPT002", 25000, "secondaire", 2, "actif"]);

    // Transactions
    $stmt = $pdo->prepare("
        INSERT INTO transaction (type_transaction, compte_id, numero_destinataire, tarif)
        VALUES (?, ?, ?, ?)
    ");
    $stmt->execute(["depot", 1, "774556677", 2000]);
    $stmt->execute(["paiement", 2, "778899000", 500]);

    echo "✅ Données insérées avec succès.\n";

} catch (PDOException $e) {
    echo "❌ Erreur lors du seeding : " . $e->getMessage() . "\n";
    exit(1);
}
