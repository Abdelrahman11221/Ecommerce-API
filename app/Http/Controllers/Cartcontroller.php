<?php

namespace App\Http\Controllers;

use App\Http\Interfaces\CartInterface;
use Carbon\CarbonInterface;
use Illuminate\Http\Request;

class Cartcontroller extends Controller
{
    public $interface;
    
    public function __construct(CartInterface $interface)
    {
        $this->interface = $interface;
    }

    public function add_cart(Request $request)
    {
        return $this->interface->add_cart($request);
    }

    public function get_cart()
    {
        return $this->interface->get_cart();
    }

    public function delete_from_cart(Request $request)
    {
        return $this->interface->delete_from_cart($request);
    }
}
