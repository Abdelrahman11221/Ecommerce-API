<?php 
namespace App\Http\Interfaces;

use App\Http\Requests\RegisterRequest;

interface AuthInterface{

    public function register($request);
    public function login($request);
    

}

?>