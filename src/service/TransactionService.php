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

    // public function getTransaction(){
    //     return $this->transactionRepository->selectAll();
    // }

    public function getTransactions(int $comptId, ?int $limit = null): array {
        return $this->transactionRepository->selectById($comptId, $limit);
    }

//     // TransactionService.php
// public function countTransactions(int $userId): int {
//     return $this->transactionRepository->countByUser($userId);
// }

// public function getTransactions(int $userId, ?int $limit = null, int $offset = 0) {
//     return $this->transactionRepository->selectById($userId, $limit, $offset);
// }
    
}