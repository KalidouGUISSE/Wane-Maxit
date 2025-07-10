<?php
namespace App\Core\Abstract;

abstract class AbstractRepository {
    public function selectAll(){}
    // abstract public function insert();
    public function update(){}
    public function delete(){}
    public function selectById(){}
    public function selectBy(array $filter){}
}
