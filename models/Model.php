<?php

namespace Alvaro\TodoPhp\models;

use Exception;

abstract class Model
{

    protected $db;
    protected $table;
    protected $primaryKey;
    protected $fillable;

    public function findAll()
    {
        $table = $this->table;
        $stmt = $this->db->prepare("SELECT * FROM $table");
        $stmt->execute();

        return $stmt->fetchAll();
    }

    public function findById(int $id)
    {
        $table = $this->table;
        $pk = $this->primaryKey;
        $stmt = $this->db->prepare("SELECT * FROM $table
                                WHERE $pk = :id");
        $stmt->execute(['id' => $id]);
        $result = $stmt->fetch();

        return $result;
    }

    public function create(array $data)
    {
        $attributes = array_filter(
            array_keys($data),
            fn ($attr) => in_array($attr, $this->fillable)
        );

        if (count($this->fillable) > count($attributes)) {
            $missingAttributes = array_diff($this->fillable, $attributes);
            $errorMessage = "Os seguintes atributos são requeridos: " . implode(", ", $missingAttributes);
            throw new Exception($errorMessage, 400);
        }

        $table = $this->table;
        $fields = implode(', ', $attributes);

        $bindings = [];

        foreach ($attributes as $attr) {
            $bindings[] = ":$attr";
        }

        $bindings = implode(', ', $bindings);
        $stmt = $this->db->prepare("INSERT INTO $table ($fields)
                                    VALUES ($bindings);");

        foreach ($data as $key => $value) {
            if (in_array($key, $this->fillable)) $stmt->bindValue(":$key", $value);
        }

        return $stmt->execute();
    }

    public function update(int $id, array $data)
    {
    }
}
