<?php
namespace Src\controller;
use App\Core\Session;
use Src\service\TransactionService;
use App\Core\Abstract\AbstractController;

use App\Core\Validator\Rules\RequiredRule;
use App\Core\Validator\Rules\SenegalPhoneRule;
use App\Core\App;

use App\Core\Validator\Rules\UserRules;

class TransactionController extends AbstractController{
    private TransactionService $transactionService;

    public function __construct(){
        parent::__construct();
        $this->transactionService = new TransactionService();
    }
    public function listerTransaction() {
        $data = $_POST;
        $validator = $this->validator;
        $session = $this->session;
        $rules = UserRules::getRulesFor(['telephone', 'password']);
    
        if (!$validator->validate($data, $rules)) {
            $session->set('errors', $validator->getErrors());
            header('Location: /');
            exit;
        }
    
        // Vérifier les identifiants
        $user = $this->transactionService->verifierConnexion($data['telephone'], $data['password']);
    
        if (!$user) {
            $validator->addError('telephone', "Identifiants invalides.");
            $session->set('errors', $validator->getErrors());
            header('Location: /');
            exit;
        }
    
        // ✅ Enregistrer l'utilisateur dans la session
        $session->set('user', $user);
    
        // Charger les transactions (exemple)
        $transaction = $this->transactionService->getTransaction();
    
        $this->renderhtml('listerTransaction.html.php', [
            'transaction' => $transaction
        ]);
    }
    

    // public function listerTransaction(){
    //     $data = $_POST;
    //     $rules = UserRules::getRulesFor(['telephone', 'password']);
    //     $validator = $this->validator;
    //     $session = $this->session;
        
    //     if (!$validator->validate($data, $rules)) {
    //         $session->set('errors', $validator->getErrors());
    //         header('Location: /');
    //         exit;
    //     }

    //     if (!$this->transactionService->verifierConnexion($data['telephone'], $data['password'])) {
    //         $validator->addError('telephone', "Identifiants invalides.");
    //         $session->set('errors', $validator->getErrors());
    //         header('Location: /');
    //         exit;
    //     }

    //     $transaction = $this->transactionService->getTransaction();
    //     $this->renderhtml('listerTransaction.html.php', ['transaction' => $transaction]);

    //     // $data = $_POST;
    
    //     // // Récupération du validateur et de la session depuis AbstractController
    //     // $validator = $this->validator;
    //     // $session = $this->session;
    
    //     // // Définir les règles de validation
    //     // // $rules = [
    //     // //     'telephone' => [
    //     // //         new RequiredRule("Le numéro est requis."),
    //     // //         new SenegalPhoneRule("Numéro invalide."),
    //     // //     ],
    //     // //     'password' => [
    //     // //         new RequiredRule("Le mot de passe est requis.")
    //     // //     ],
    //     // // ];

    //     // $rules = UserRules::getRulesFor(['telephone', 'password']);
    
    //     // // Exécuter la validation
    //     // if (!$validator->validate($data, $rules)) {

    //     //     $session->set('errors', $validator->getErrors());
    //     //     // var_dump($validator->getErrors());
    //     //     var_dump($session->get('errors'));die;
    //     //     header('Location: /'); // redirige vers une page d'erreur ou formulaire
    //     //     exit;
    //     // }
    
    //     // // Si validation réussie, traiter la transaction
    //     // $transaction = $this->transactionService->getTransaction();
    
    //     // $this->renderhtml('listerTransaction.html.php', [
    //     //     'transaction' => $transaction
    //     // ]);
    // }
    

    // public function listerTransaction(){
    //     var_dump($_POST);die;
    //     $transaction = $this->transactionService->getTransaction();
    //     $this->renderhtml('listerTransaction.html.php',[
    //         'transaction' => $transaction
    //     ]);
    // }

    public function show(){}
    public function edit(){}
    public function destroye(){}
    public function store(){}
    public function index(){}
}