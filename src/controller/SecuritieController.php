<?php
namespace Src\controller;
use Src\service\CompteService;
use App\Core\App;
use App\Core\Session;

use Src\service\SecuriteService;

class SecuritieController {
    private SecuriteService $securiteService;

    public function __construct(){
        $this->securiteService = new SecuriteService();
    }

    public function connection(){
        require_once "../templates/client/creercompte.html.php";
    }

    public function creerCompte() {
        $session = Session::getInstance();
    
        $telephone   = $_POST['telephone'] ?? '';
        $nci         = $_POST['nci'] ?? '';
        $nom         = $_POST['nom'] ?? '';
        $prenom      = $_POST['prenom'] ?? '';
        $adresse     = $_POST['adresse'] ?? '';
        $photoRecto  = $_FILES['photo_recto'] ?? null;
        $photoVerso  = $_FILES['photo_verso'] ?? null;
        
        // $validator = $validator->getInstance();
        // $validator = Validator::getInstance();
        $validator = App::getDependencie('core', 'validator');

        // Obtenir toutes les dépendances core :
        // $core = App::getDependencie('core');
        // Obtenir toutes les dépendances :
        // $toutes = App::getDependencie();


        $validator->isEmpty('telephone', $telephone, 'Le numéro de téléphone est requis.');
        $validator->isEmpty('nci', $nci, 'Le numéro de carte d\'identité est requis.');
        $validator->isEmpty('nom', $nom, 'Le nom est requis.');
        $validator->isEmpty('prenom', $prenom, 'Le prénom est requis.');
        $validator->isEmpty('adresse', $adresse, 'L’adresse est requise.');
        if (!$photoRecto || $photoRecto['error'] !== UPLOAD_ERR_OK) {
            $validator->addError('photo_recto', 'La photo recto est requise.');
        }
        if (!$photoVerso || $photoVerso['error'] !== UPLOAD_ERR_OK) {
            $validator->addError('photo_verso', 'La photo verso est requise.');
        }
    
        if (!$validator->isValid()) {
            $session->set('errors', $validator->getErrors());
            var_dump($_SESSION);die;
            header('Location: /');
            exit;
        }
    
        try {
            $this->securiteService->creerUtilisateurEtCompte(
                $telephone, $nci, $nom, $prenom, $adresse, $photoRecto, $photoVerso
            );
            var_dump('Succes');die;
        } catch (\Exception $e) {
            // var_dump('nice');die;
            $session->set('errors', ['global' => $e->getMessage()]);
            // header('Location: /creer-compte');
        }
    }
    
    

}