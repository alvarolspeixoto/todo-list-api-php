<?php

namespace Alvaro\TodoPhp\models;

use Alvaro\TodoPhp\config\database\Connection;

abstract class Model {

    protected $table;
    protected $primaryKey;

    public function findAll() {

        $conn = Connection::getConnection();

        $table = $this->table;
        $stmt = $conn->prepare("SELECT * FROM $table");
        $stmt->execute();

        return $stmt->fetchAll(); 
    }

    public function findById(int $id) {

    }

    public function create(array $data) {

    }

    public function update(int $id, array $data) {

    }

}