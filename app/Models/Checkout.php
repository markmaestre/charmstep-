<?php


namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Checkout extends Model
{
    use HasFactory;

    protected $primaryKey = 'checkout_id';

    protected $fillable = [
        'user_id',
        'cart_id',
        'address',
        'phone_number',
        'payment_method',
        'total_amount',
        'status',
    ];

    public function cartItems()
    {
        return $this->hasMany(Cart::class, 'id', 'id');
    }

    public function reviews()
{
    return $this->hasMany(Review::class, 'checkout_id');
}

}
