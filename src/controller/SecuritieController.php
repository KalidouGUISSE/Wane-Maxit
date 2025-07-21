<?php
namespace Src\controller;

use App\Core\App;
use App\Core\Abstract\AbstractController;
use App\Core\Validator\Rules\UserRules;
use Src\service\SecuriteService;
use App\Core\Messages\ValidationMessage;
use App\Core\FileUpload;

class SecuritieController extends AbstractController {
    private SecuriteService $securiteService;

    public function __construct(){
        $this->securiteService = new SecuriteService();
        parent::__construct();
        $this->layout = '../templates/layout/baseForm.html.php';
    }

    public function connection(){
        $this->renderhtml('/seConnecter.html.php');
        // require_once "../templates/seConnecter.html.php";
    }

    public function deconnexion() {
        $this->session->destroy(); 
        header('Location: /');
        exit;
    }


    public function creerCompte(){
        $this->renderhtml('client/creercompte.html.php');
    }


    public function creer() {
        $data = $_POST;
        $photoRecto = $_FILES[ValidationMessage::KEY_PHOTO_RECTO->value] ?? null;
        $photoVerso = $_FILES[ValidationMessage::KEY_PHOTO_VERSO->value] ?? null;
    
        // Ajout des fichiers dans les données pour qu’ils soient validés
        $data[ValidationMessage::KEY_PHOTO_RECTO->value] = $photoRecto;
        $data[ValidationMessage::KEY_PHOTO_VERSO->value] = $photoVerso;
    
        $rules = UserRules::getRules();
    
        // Validation
        if (!$this->validator->validate($data, $rules)) {

            $this->session->set('errors', $this->validator->getErrors());
            header('Location: /creerCompte');
            exit;
        }
        
        try {
            $password       = $data[ValidationMessage::KEY_PASSWORD->value];
            $telephone      = $data[ValidationMessage::KEY_TELEPHONE->value];
            $nci            = $data[ValidationMessage::KEY_NCI->value];
            $nom            = $data[ValidationMessage::KEY_NOM->value];
            $prenom         = $data[ValidationMessage::KEY_PRENOM->value];
            $adresse        = $data[ValidationMessage::KEY_ADRESSE->value];
    
            $hashedPassword = password_hash($password, PASSWORD_DEFAULT);
            
            $this->securiteService->creerUtilisateurEtCompte(
                $hashedPassword, $telephone, $nci, $nom, $prenom, $adresse, $photoRecto, $photoVerso
            );
            header('Location: /');
        } catch (\Exception $e) {
            $this->session->set('errors', ['global' => $e->getMessage()]);
            var_dump($this->session->get('errors'));die;
            header('Location: /creerCompte'); // On redirige aussi ici en cas d’erreur backend
        }
    }

    public function debutdepot(){
        $this->renderhtml('layout/popup/depot.html.php');
    }

    public function depot(){
        $data = $_POST;

        // $user = $this->session->get('user');
        // var_dump($user); 
        // die;
        $rules = UserRules::getRulesFor(
            ['telephone','tarif'],
            [UniqueRule::class] 
        );

        if (!$this->validator->validate($data,$rules)) {
            // var_dump('donner invalide');
            header('Location: /listerTransaction');
            // die;
        }


        // var_dump($data);die;
        $tarif = $data['tarif'];
        $telephone = $data['telephone'];
        $compteId = $this->session->get('user')['cid'];;

        $this->securiteService->creerDepot($compteId, $tarif, $telephone);
            header('Location: /listerTransaction');
        // var_dump('ok');
        // var_dump($_POST);
        // die;
    }
    
    public function show(){}
    public function edit(){}
    public function destroye(){}
    public function store(){}
    public function index(){}
}