<?php
namespace App\Http\Repositories;

use App\Http\Interfaces\CartInterface;
use App\Http\Traits\Apidesigntrait;
use App\Models\Cart;
use App\Rules\CartsRule;
use App\Rules\EmailRule;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class CartRepository implements CartInterface{
    use Apidesigntrait;
    public function add_cart($request)
    {
        $validate = Validator::make($request->all() , [
            'p_id' => 'required|exists:products,id',
            'count' => ['required' , new EmailRule()]
        ]);

        if ($validate->fails())
        {
            return $this->apiresponse(400 , 'failed to add product' , $validate->errors());
        }

        $cart = Cart::where([ ['u_id', Auth::user()->id] , ['p_id' , $request->p_id]])->first();
        if($cart)
        {
            $cart->update([
                'count' => $cart->count + $request->count
            ]);
        }
        else{
            Cart::create([
                'u_id' => Auth::user()->id,
                'p_id' => $request->p_id,
                'count' => $request->count
            ]);
        }

        return $this->apiresponse(200 , 'cart added successfully');
    }

    public function get_cart()
    {
        $cart = Cart::where('u_id',Auth::user()->id)->with(['product:id,name' , 'user:id,name'])->select('id','u_id','p_id','count')->get();
        return $this->apiresponse(200 , 'Carts data' , null , $cart);
    }

    public function delete_from_cart($request)
    {
        $validate = Validator::make($request->all() , [
            'p_id' => 'required|exists:Carts,p_id',
            'count' => ['required' ,  new CartsRule()]
        ]);
        if ($validate->fails())
        {
            return $this->apiresponse(400 , 'failed to get cart' , $validate->errors());
        }
        $cart = Cart::where([ ['u_id', Auth::user()->id] , ['p_id' , $request->p_id]])->first();
        if($cart->count - $request->count > 0)
        {
            $cart->update([
                'count' => $cart->count - $request->count
            ]);
        }
        else
        {
            Cart::where([ ['u_id', Auth::user()->id] , ['p_id' , $request->p_id]])->delete();
        }

        return $this->apiresponse(200 , 'cart deleted successfully');

    }
}
?>