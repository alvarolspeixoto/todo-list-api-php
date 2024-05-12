<?php

namespace Alvaro\TodoPhp\controllers;

use Alvaro\TodoPhp\models\User;

class UserController extends Controller {

    public function __construct() {
        $this->model = User::class;
    }
}