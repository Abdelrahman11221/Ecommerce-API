<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cart extends Model
{
    use HasFactory;
    protected $fillable = ['u_id' , 'p_id' , 'count'];

    public function product()
    {
        return $this->belongsTo(Product::class , 'p_id' , 'id');
    }
    public function user()
    {
        return $this->belongsTo(User::class , 'u_id' , 'id');
    }
}
