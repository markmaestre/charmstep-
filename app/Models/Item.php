<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\Searchable\Searchable;
use Spatie\Searchable\SearchResult;

class Item extends Model implements Searchable
{
    use HasFactory;

    protected $primaryKey = 'item_id';

    protected $fillable = [
        'product_name', 'description', 'quantity', 'size', 'price', 'image'
    ];

    public function getSearchResult(): SearchResult
    {
        $url = route('items.show', $this->item_id); // Adjust this route as necessary

        return new SearchResult(
            $this,
            $this->product_name,
            $url
        );
    }
}
