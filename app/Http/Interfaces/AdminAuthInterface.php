<?php
namespace App\Http\Interfaces;

use App\Http\Requests\RegisterRequest;

interface AdminAuthInterface{

    public function register($request);
    public function login($request);
    public function logout($request);


}

?>
