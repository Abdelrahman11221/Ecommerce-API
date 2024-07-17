<?php

namespace App\Rules;

use App\Models\Cart;
use Closure;
use Illuminate\Contracts\Validation\Rule;
use Illuminate\Contracts\Validation\ValidationRule;

class CartStockRule implements Rule
{

    public function __construct()
    {
        
    }

    public function passes($attribute, $value)
    {
        $carts = Cart::where('u_id',auth()->user()->id)->with('product')->get();
        foreach ($carts as $cart)
        {
            if($cart->product->stack < $cart->count)
            {
                return false;
            }
            
            // $total_price = $cart->count * $cart->product->price;
            return true;
        }

    }

    public function message()
    {
        return 'Overload count';
    }


    /**
     * Run the validation rule.
     *
     * @param  \Closure(string): \Illuminate\Translation\PotentiallyTranslatedString  $fail
     */
    public function validate(string $attribute, mixed $value, Closure $fail): void
    {
        //
    }
}
