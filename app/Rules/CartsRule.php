<?php

namespace App\Rules;

use App\Models\Cart;
use App\Models\Product;
use Closure;
use Illuminate\Contracts\Validation\Rule;
use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Support\Facades\Auth;

class CartsRule implements Rule
{
    
    public function __construct()
    {
        
    }

    public function passes($attribute, $value)
    {
        // dd(Auth::user()->id);
        return Cart::where([ ['u_id', Auth::user()->id] , ['p_id' , request('p_id')] , ['count' , '>=' , $value]])->exists();
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
