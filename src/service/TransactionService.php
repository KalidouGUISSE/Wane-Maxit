<?php
namespace Src\service;
use Src\repository\TransactionRepository;
// use Src\repository\CompteRepository;
// use App\Core\Database;

class TransactionService{

    private TransactionRepository $transactionRepository;

    public function __construct(){
        $this->transactionRepository = new TransactionRepository();
    }

    public function getTransaction(){
        return $this->transactionRepository->selectAll();
    }

    public function getTransactionsByUserId(int $userId): array {
        return $this->transactionRepository->selectById($userId);
    }
}