<?php
namespace App\Http\Repositories;

use App\Http\Interfaces\CartInterface;
use App\Http\Interfaces\OrderInterface;
use App\Http\Traits\Apidesigntrait;
use App\Models\Cart;
use App\Models\Order;
use App\Models\Order_Item;
use App\Rules\CartsRule;
use App\Rules\CartStockRule;
use App\Rules\EmailRule;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

class OrderRepository implements OrderInterface{
    use Apidesigntrait;
    public function check_out($request)
    {
        $validate = Validator::make($request->header(),[
            'authorization' => new CartStockRule()
        ]);

        if($validate->fails())
        {
            return $this->apiresponse(400 , 'not found' , $validate->errors());
        }
        $carts = Cart::where('u_id',auth()->user()->id)->with('product')->get();
        
        $total_price = $carts->sum(function($items){
            return $items->count * $items->product->price;
        });
        
        DB::transaction(function() use ($total_price , $carts){
            $orders = Order::create([
                'u_id' => auth()->user()->id,
                'total_price' => $total_price
            ]);

            foreach($carts as $cart_item)
            {
                Order_Item::create([
                    'order_id' => $orders->id,
                    'p_id' => $cart_item->p_id,
                    'total_price' => $cart_item->count * $cart_item->product->price,
                    'count' => $cart_item->count,
                    'unit_price' =>  $cart_item->product->price
                ]);
                
                $cart_item->delete();
            }
            return $this->apiresponse(200 , 'Order checked successfully'); 
        });
        //create order in orders table
    }
}
?>