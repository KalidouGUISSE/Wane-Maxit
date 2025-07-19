<?php
namespace Src\service;

use Src\repository\CompteRepository;
use Src\repository\UtilisateurRepository;
use Src\repository\TransactionRepository;

use App\Core\Database;
use App\Core\Validator\contracts\UniqueValueCheckerInterface;
use App\Core\FileUpload;
use App\Core\Sms\TwilioSmsService;
use App\Core\Messages\ValidationMessage;

class SecuriteService implements UniqueValueCheckerInterface {

    private UtilisateurRepository $utilisateurRepository;
    private CompteRepository $compteRepository;
    private TransactionRepository $transactionRepository;
    
    public function __construct(){
        $this->utilisateurRepository = new UtilisateurRepository();
        $this->compteRepository = new CompteRepository();
        $this->transactionRepository = new TransactionRepository();
    }

    // Cette méthode est requise par UniqueValueCheckerInterface
    public function isUnique(string $column, $value): bool {
        return !$this->utilisateurRepository->existsBy($column, $value);
    }

    // Ancien nom (optionnel à garder si utilisé ailleurs)
    public function verifierUnique(string $column, $value): bool {
        return $this->isUnique($column, $value);
    }

    public function creerUtilisateurEtCompte(
        string $password,
        string $telephone,
        string $nci,
        string $nom,
        string $prenom,
        string $adresse,
        ?array $photoRecto,
        ?array $photoVerso
    ): void {
        $pdo = Database::getConnection();
        $fileUploader = new FileUpload();
        try {
            $pdo->beginTransaction();
            // Upload des fichiers
            $photoRectoName = $photoRecto ? $fileUploader->upload($photoRecto, 'recto') : null;
            $photoVersoName = $photoVerso ? $fileUploader->upload($photoVerso, 'verso') : null;
            // var_dump($telephone,$photoRectoName);
            // Insertion utilisateur
            $userId = $this->utilisateurRepository->insert(
                $password, $telephone, $nci, $nom, $prenom, $adresse,
                $photoRectoName, $photoVersoName
            );
            $this->compteRepository->insert($telephone, $userId);

            $pdo->commit();
            $smsService = new TwilioSmsService(
                TWILIO_SID,
                TWILIO_TOKEN,
                TWILIO_FROM
            );
            $smsService->send(
                ValidationMessage::INDICATEUR->value . $telephone,
                ValidationMessage::BONJOUR->value . " $prenom, " . ValidationMessage::COMPT_CREER->value
            );
        } catch (\PDOException $e) {
            $pdo->rollBack();
            throw new \Exception("Erreur lors de la création du compte utilisateur : " . $e->getMessage());
        }
    }

    public function creerDepot($compteId, $tarif, $telephone){
        return $this->transactionRepository->creerDepot($compteId, $tarif, $telephone);
    }

}
