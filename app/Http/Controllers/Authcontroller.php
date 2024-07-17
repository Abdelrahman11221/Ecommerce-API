<?php

namespace App\Http\Controllers;

use App\Http\Interfaces\AuthInterface;
use Illuminate\Http\Request;

class Authcontroller extends Controller
{
    public $interface;

    public function __construct(AuthInterface $interface)
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
    

}
