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
    public function listerTransaction(){
        // var_dump($this->session->get('user'));die;
        $comptId = $this->session->get('user')['cid'];
        $limit = isset($_POST['voirPlus']) ? null : 10;
        $transactions = $this->transactionService->getTransactions($comptId, $limit);
        
        // var_dump(isset($_POST['voirPlus']));die;

        $this->renderhtml('listerTransaction.html.php', [
            'transaction' => $transactions
        ]);
    }
    
    public function show(){}
    public function edit(){}
    public function destroye(){}
    public function store(){}
    public function index(){}

    // public function listerTransaction() {
    //     $userId = $this->session->get('user')['id'];
    //     $page = isset($_GET['page']) ? (int)$_GET['page'] : 1;
    //     $limit = 5; // Nombre d'éléments par page
    //     $offset = ($page - 1) * $limit;

    //     $transactions = $this->transactionService->getTransactions($userId, $limit, $offset);
    //     $total = $this->transactionService->countTransactions($userId);
    //     $totalPages = ceil($total / $limit);

    //     $this->renderhtml('listerTransaction.html.php', [
    //         'transaction' => $transactions,
    //         'page' => $page,
    //         'totalPages' => $totalPages
    //     ]);
    // }

}