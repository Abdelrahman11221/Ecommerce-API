<?php

namespace App\Http\Controllers;

use App\Http\Interfaces\ProductInterface;
use Illuminate\Http\Request;

class Productcontroller extends Controller
{
    public $interface;
    public function __construct(ProductInterface $interface)
    {
        $this->interface = $interface;
    }

    public function add_product(Request $request)
    {
        return $this->interface->add_product($request);
    }

    public function get_product()
    {
        return $this->interface->get_product();
    }

    public function find_product(Request $request){
        return $this->interface->find_product($request);
    }

    public function update_product(Request $request , $id)
    {
        return $this->interface->update_product($request , $id);
    }

    public function delete_product(Request $request){
        return $this->interface->delete_product($request);
    }
}
