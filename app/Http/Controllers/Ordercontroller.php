<?php

namespace App\Http\Controllers;

use App\Http\Interfaces\OrderInterface;
use App\Models\Cart;
use Illuminate\Http\Request;

class Ordercontroller extends Controller
{
    public $interface;

    public function __construct(OrderInterface $interface)
    {
        $this->interface=$interface;
    }

    public function carts()
    {
        $carts = Cart::where('u_id',auth()->user()->id)->with('product')->get();
        $total_price = $carts->sum(function($items){
            return $items->count * $items->product->price;
        });
        // dd($total_price);
    }

    public function checkout(Request $request)
    {
        return $this->interface->check_out($request);
    }

}
