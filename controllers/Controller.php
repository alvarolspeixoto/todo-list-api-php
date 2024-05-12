<?php

namespace Alvaro\TodoPhp\controllers;

abstract class Controller
{

    protected $model;

    public function index()
    {
        $data = (new $this->model)->findAll();
        
        $message = $data ? 'Usuários retornados com sucesso.'
                         : 'Não há usuários cadastrados';
        

        $response = [
            'status' => 'success',
            'data' => $data,
            'message' => $message,
            'isSuccess' => true
        ];

        http_response_code(200);
        echo json_encode($response);
    }

    public function show(int|null $id)
    {
    }

    public function create(array|null $data)
    {
    }

    public function update(int|null $id, array|null $data)
    {
    }

    public function delete(int|null $id)
    {
    }
}
