<?php

namespace App\Rules;

use App\Models\Cart;
use App\Models\Product;
use Closure;
use Illuminate\Contracts\Validation\Rule;
use Illuminate\Support\Facades\Auth;

class EmailRule implements Rule
{
    public function __construct()
    {
        
    }

    public function passes($attribute, $value)
    {
        $product = Product::where([ ['id', request('p_id') ] , ['stack' , '>=' , $value] ])->first();
        if($product)
        {
            // dd(Auth::user()->id);
            $cart = Cart::where([ ['u_id', Auth::user()->id] , ['p_id' , $product->id]])->first();
            if($cart)
            {
                if($cart->count + $value <= $product->stack)
                {
                    return true;
                }
                else
                {
                    return false;
                }
            }
            return true;
        }
        // dd($product);
    }

    public function message()
    {
        return 'out of stock';
    }
    /**
     * Run the validation rule.
     *
     * @param  \Closure(string): \Illuminate\Translation\PotentiallyTranslatedString  $fail
     */
    // public function validate(string $attribute, mixed $value, Closure $fail): void
    // {
    //     //
    // }


}
