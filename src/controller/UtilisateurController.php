<?php
namespace Src\controller;
// use Src\service\TransactionService;
use App\Core\Abstract\AbstractController;

// use App\Core\Validator\Rules\RequiredRule;
// use App\Core\Validator\Rules\SenegalPhoneRule;
// use App\Core\App;

use App\Core\Validator\Rules\UserRules;
use Src\service\UtilisateurService;

class UtilisateurController extends AbstractController {
    private UtilisateurService $utilisateurService;
    // private TransactionService $transactionService;

    public function __construct(){
        parent::__construct();
        $this->utilisateurService = new UtilisateurService();
        // $this->transactionService = new TransactionService();
    }

    public function seConnecter() {
        $data = $_POST;
        $validator = $this->validator;
        $session = $this->session;
        $rules = UserRules::getRulesFor(
            ['telephone', 'password'],
            [\App\Core\Validator\Rules\UniqueRule::class] // exclure cette règle
        );
    
        if (!$validator->validate($data, $rules)) {
            $session->set('errors', $validator->getErrors());
            header('Location: /');
            exit;
        }
    
        // Vérifier les identifiants
        $user = $this->utilisateurService->verifierConnexion($data['telephone'], $data['password']);
        // var_dump( $user );die;
        if (!$user) {
            $validator->addError('telephone', "Verifier les donnees entre.");
            $validator->addError('password', "Verifier les donnees entre.");
            $session->set('errors', $validator->getErrors());
            header('Location: /');
            exit;
        }

        $session->set('user', $user);
        header('Location: /listerTransaction');
    }



    public function show(){}
    public function edit(){}
    public function destroye(){}
    public function store(){}
    public function index(){}
}