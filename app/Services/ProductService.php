<?php

namespace App\Services;

use App\Models\Product;

class ProductService
{

    public static function create(array $data): Product
    {
        if (isset($data['image'])){
            unset($data['image']);
        }

        $product = Product::create($data);

        return $product;
    }

}
