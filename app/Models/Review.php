<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Review extends Model
{
    protected $primaryKey = 'review_id';
    protected $fillable = ['checkout_id', 'user_id', 'description', 'rating', 'photo'];

    public function checkout()
    {
        return $this->belongsTo(Checkout::class, 'checkout_id');
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}
