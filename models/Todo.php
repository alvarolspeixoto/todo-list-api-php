<?php 

namespace Alvaro\TodoPhp\models;

use Alvaro\TodoPhp\config\Connection;

class Todo extends Model {
    
    protected $db;
    protected $table;
    protected $primaryKey;
    protected $fillable;

    public function __construct() {
        $this->db = Connection::getConnection();
        $this->table = 'todo';
        $this->primaryKey = 'id';
        $this->fillable = [
            'title',
            'description',
            // TODO: criar enum de status
            'status',
            'user_id',
        ];
    }

}