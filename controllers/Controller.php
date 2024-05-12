<?php

namespace Alvaro\TodoPhp\controllers;

abstract class Controller
{

    protected $model;

    public function index()
    {
        try {
            $data = (new $this->model)->findAll();
            $status = 'success';
            $message = $data ? 'Usuários retornados com sucesso.'
                : 'Não há usuários cadastrados';
            $isSuccess = true;
            
            $responseCode = 200;
        } catch (\Exception $e) {
            $data = [];
            $status = 'error';
            $message = $e->getMessage();
            $responseCode = 404;
            $isSuccess = false;
        } finally {
            http_response_code($responseCode);
            $response = [
                'status' => $status,
                'data' => $data,
                'message' => $message,
                'isSuccess' => $isSuccess
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
