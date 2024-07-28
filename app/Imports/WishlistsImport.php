<?php

namespace App\Imports;

use App\Models\Wishlist;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class WishlistsImport implements ToModel, WithHeadingRow
{
    public function model(array $row)
    {
        return new Wishlist([
            'user_id' => auth()->id(),
            'brand_name' => $row['brand_name'],
            'size' => $row['size'],
            'image' => isset($row['image']) ? $row['image'] : null,
        ]);
    }
}
