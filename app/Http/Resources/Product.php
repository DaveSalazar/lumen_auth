<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\Resource;

class Product extends Resource
{
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'product_name' => $this->product_name,
            'product_description' => $this->product_description
        ];
    }

    public function with($request){
        return [
            'version' => '1.0.0'
        ];
    }
}