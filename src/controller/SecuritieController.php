<?php
namespace Src\controller;
use Src\service\CompteService;
use App\Core\App;
use App\Core\Session;
use App\Core\Abstract\AbstractController;

use Src\service\SecuriteService;

class SecuritieController extends AbstractController {
    private SecuriteService $securiteService;

    public function __construct(){
        $this->securiteService = new SecuriteService();
        parent::__construct();
        $this->layout = '../templates/layout/baseForm.html.php';
    }




    public function show(){}
    public function edit(){}
    public function destroye(){}
    public function store(){}
    public function index(){}

    public function connection(){
        require_once "../templates/seConnecter.html.php";
    }

    public function deconnexion(){
        header('Location: /');
    }

    public function creerCompte(){
        $this->renderhtml('client/creercompte.html.php');

        // require_once "../templates/client/creercompte.html.php";
    }

    public function creer() {
        $session = Session::getInstance();
    
        $telephone   = $_POST['telephone'] ?? '';
        $nci         = $_POST['nci'] ?? '';
        $nom         = $_POST['nom'] ?? '';
        $prenom      = $_POST['prenom'] ?? '';
        $adresse     = $_POST['adresse'] ?? '';
        $photoRecto  = $_FILES['photo_recto'] ?? null;
        $photoVerso  = $_FILES['photo_verso'] ?? null;
        
        $password = $_POST['password'];
        $password_confirmation = $_POST['password_confirmation'];

        $validator = App::getDependencie('core', 'validator');
        
        if ($password !== $password_confirmation) {
            $validator->addError('password_confirmation','Les mots de passe ne correspondent pas');
        }

        $validator->isEmpty('telephone', $telephone, 'Le numéro de téléphone est requis.');
        $validator->isEmpty('nci', $nci, 'Le numéro de carte d\'identité est requis.');
        $validator->isEmpty('nom', $nom, 'Le nom est requis.');
        $validator->isEmpty('prenom', $prenom, 'Le prénom est requis.');
        $validator->isEmpty('adresse', $adresse, 'L’adresse est requise.');
        $validator->isEmpty('password', $adresse, 'Le password est requise.');
        // $validator->isEmpty('password_confirmation', $adresse, 'Les mots de passe ne correspondent pas');

        if (!$photoRecto || $photoRecto['error'] !== UPLOAD_ERR_OK) {
            $validator->addError('photo_recto', 'La photo recto est requise.');
        }
        if (!$photoVerso || $photoVerso['error'] !== UPLOAD_ERR_OK) {
            $validator->addError('photo_verso', 'La photo verso est requise.');
        }
    
        if (!$validator->isValid()) {
            $session->set('errors', $validator->getErrors());
            var_dump($validator->getErrors());die;
            header('Location: /creerCompte');
            exit;
        }
    
        try {
            $this->securiteService->creerUtilisateurEtCompte(
                $password,$telephone, $nci, $nom, $prenom, $adresse, $photoRecto, $photoVerso
            );
            header('Location: /');
            // $this->renderhtml('creerpassword.html.php');
        } catch (\Exception $e) {
            $session->set('errors', ['global' => $e->getMessage()]);
        }
    }
    
    

}