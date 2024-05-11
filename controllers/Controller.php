<?php

abstract class Controller {

    protected $model;

    protected function index() {}

    protected function show(int|null $id) {}

    protected function create(array|null $data) {}

    protected function update(int|null $id, array|null $data) {}

    protected function delete(int|null $id) {}

}