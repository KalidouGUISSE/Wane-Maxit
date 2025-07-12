<?php
namespace Src\controller;

use App\Core\App;
use App\Core\Abstract\AbstractController;
use App\Core\Validator\Rules\UserRules;
use Src\service\SecuriteService;

class SecuritieController extends AbstractController {
    private SecuriteService $securiteService;

    public function __construct(){
        $this->securiteService = new SecuriteService();
        parent::__construct();
        $this->layout = '../templates/layout/baseForm.html.php';
    }

    public function connection(){
        require_once "../templates/seConnecter.html.php";
    }

    public function deconnexion(){
        header('Location: /');
    }

    public function creerCompte(){
        $this->renderhtml('client/creercompte.html.php');
    }

    public function creer() {
        $data = $_POST;
        $rules = UserRules::getRules();

        if (!$this->validator->validate($data, $rules)) {
            $this->session->set('errors', $this->validator->getErrors());
            header('Location: /creerCompte');
            exit;
        }
        
        try {
            $password = $data['password'] ?? null;
            $telephone = $data['telephone'] ?? null;
            $nci = $data['nci'] ?? null;
            $nom = $data['nom'] ?? null;
            $prenom = $data['prenom'] ?? null;
            $adresse = $data['adresse'] ?? null;
            $photoRecto = $_FILES['photo_recto'] ?? null;
            $photoVerso = $_FILES['photo_verso'] ?? null;

            $hashedPassword = password_hash($password, PASSWORD_DEFAULT);

            $this->securiteService->creerUtilisateurEtCompte(
                $hashedPassword,$telephone, $nci, $nom, $prenom, $adresse, $photoRecto, $photoVerso
            );
            header('Location: /');
        } catch (\Exception $e) {
            $this->session->set('errors', ['global' => $e->getMessage()]);
        }
    }

    public function show(){}
    public function edit(){}
    public function destroye(){}
    public function store(){}
    public function index(){}

}