<?php

namespace Alvaro\TodoPhp\controllers;

use Alvaro\TodoPhp\models\Todo;

class TodoController extends Controller {

    public function __construct() {
        $this->model = Todo::class;
    }
}