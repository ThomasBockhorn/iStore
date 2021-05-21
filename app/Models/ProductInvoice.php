<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProductInvoice extends Model
{
    use HasFactory;

    protected $guarded = [];

    /**
     * Sets up relationship with Invoice
     */
    public function Invoice()
    {
        return $this->belongsToMany(Invoice::class)->as('items')->created_at;
    }

    /**
     * Sets up relationship with Product
     */
    public function Product()
    {
        return $this->belongsToMany(Product::class)->as('items')->created_at;
    }
}