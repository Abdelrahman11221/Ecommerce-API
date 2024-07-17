<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;
    protected $fillable = ['name' , 'price' , 'stack'];
    
    // public static function Rule()
    // {
    //     return [
    //         'name'=>'required|min:3',
    //         'price'=>'required|numeric',
    //         'stack'=>'required|numeric'
    //     ];
    // }
    
    public function cart()
    {
        // return $this->hasMany()
    }
}
