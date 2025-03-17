<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class UserController extends Controller
{
    public function index() {
        return "Greeting from User controller";
    }

    public function find_user($user_id) {
        return "User ID is " . $user_id;
    }
}
