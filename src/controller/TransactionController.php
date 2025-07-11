<?php
namespace Src\controller;
// use Src\service\CompteService;
// use App\Core\App;
use App\Core\Session;
use Src\service\TransactionService;
use App\Core\Abstract\AbstractController;


class TransactionController extends AbstractController{
    private TransactionService $transactionService;

    public function __construct(){
        parent::__construct();
        $this->transactionService = new TransactionService();
    }

    // public function listerTransaction(){
    //     // var_dump('mv');die;
    //     self::show();
    //     // require_once "../templates/listerTransaction.html.php";
    // }

    public function listerTransaction(){
        $transaction = $this->transactionService->getTransaction();
        // var_dump($transaction);die;
        $this->renderhtml('listerTransaction.html.php',[
            'transaction' => $transaction
        ]);
    }
    public function show(){}
    public function edit(){}
    public function destroye(){}
    public function store(){}
    public function index(){}
}