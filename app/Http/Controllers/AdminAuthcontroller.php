<?php

namespace App\Http\Controllers;

use App\Http\Interfaces\Adm;
use App\Http\Interfaces\AdminAuthInterface;
use Illuminate\Http\Request;

class AdminAuthcontroller extends Controller
{
    public $interface;

    public function __construct(AdminAuthInterface $interface)
    {
        $this->interface = $interface;
    }

    public function register(Request $request)
    {
        return $this->interface->register($request);
    }
    public function login(Request $request)
    {
        return $this->interface->login($request);
    }
    public function logout(Request $request){
        return $this->interface->logout($request);
    }

}
