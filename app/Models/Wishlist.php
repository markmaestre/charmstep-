<?php



namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Wishlist extends Model
{
    use HasFactory;

    protected $primaryKey = 'wishlist_id';

    protected $fillable = [
        'user_id',
        'brand_name',
        'size',
        'image',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
