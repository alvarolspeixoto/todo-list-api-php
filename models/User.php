<?php

namespace Alvaro\TodoPhp\models;

use Alvaro\TodoPhp\config\Connection;

class User extends Model {

    protected $db;
    protected $table;
    protected $primaryKey;
    protected $fillable;

    public function __construct() {
        $this->db = Connection::getConnection();
        $this->table = 'user';
        $this->primaryKey = 'id';
        $this->fillable = [
            'username',
            'email',
            'password'
        ];
    }

    public function findByUsername(string $username)
    {
        $table = $this->table;
        $stmt = $this->db->prepare("SELECT * FROM $table
                                WHERE username = :username");
        $stmt->execute(['username' => $username]);
        $result = $stmt->fetch();

        return $result;
    }

    // criar uma função geral na model base que faça o papel de buscar por qualquer chave única
    // findByKey($key, $value)
    public function findByEmail(string $email)
    {

        $table = $this->table;
        $stmt = $this->db->prepare("SELECT * FROM $table
                                WHERE email = :email");
        $stmt->execute(['email' => $email]);
        $result = $stmt->fetch();

        return $result;
    }
}