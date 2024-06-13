<?php

namespace Alvaro\TodoPhp\controllers;

use Alvaro\TodoPhp\config\Connection;
use Exception;

abstract class Controller
{

    protected $model;

    public function index()
    {
        try {
            $data = (new $this->model)->findAll();
            $status = 'success';
            $message = $data ? 'Dados retornados com sucesso'
                : 'Não há registros';
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

            echo json_encode($response);
            die;
        }
    }

    public function show(int|null $id)
    {
        try {
            $data = (new $this->model)->findById($id);
            $status = 'success';
            $message = $data ? 'Usuário retornado com sucesso.'
                : 'Usuário inexistente.';
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

            echo json_encode($response);
            die;
        } 
    }

    public function create(array|null $data)
    {

        $model = new $this->model;
        Connection::beginTransaction();

        try {
            $model->create($data);
            Connection::commit();
            http_response_code(201);
            echo json_encode([]);
        } catch (Exception $e) {
            $code = $e->getCode() ?? 400;
            http_response_code($code);
            echo json_encode([
                'error' => $e->getMessage(),
                'isSuccess' => false,
            ]);
        }
        die;
    }

    public function update(int|null $id, array|null $data)
    {
    }

    public function delete(int|null $id)
    {
    }
}
