<?php
namespace App\Core\Abstract;

abstract class AbstractRepository {
    public function selectAll(){}
    public function selectBy(array $filter){}
    // abstract public function insert();
    public function update(){}
    public function delete(){}
    abstract public function selectById(int $userId);
}
