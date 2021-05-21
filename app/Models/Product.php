<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    protected $guarded = [];

    /**
     * relationship with product images
     */
    public function productImages()
    {
        return $this->hasMany(ProductImage::class);
    }

    /**
     * relationship with product comments
     */
    public function productComments()
    {
        return $this->hasMany(ProductComment::class);
    }

    /**
     * sets up relationship to invoices
     */
    public function invoices()
    {
        return $this->belongsToMany(ProductInvoice::class)->as('items')->withTimestamp();
    }
}