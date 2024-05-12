<?php

namespace Alvaro\TodoPhp\models;

class User extends Model {

    protected $table;
    protected $primaryKey;

    public function __construct() {
        $this->table = 'user';
        $this->primaryKey = 'id';
    }

}