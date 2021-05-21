<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProductComment extends Model
{
    use HasFactory;

    protected $guarded = [];

    /**
     * relationship with Product
     */
    public function product()
    {
        return $this->belongsTo(Product::class);
    }
}