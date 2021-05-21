<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Invoice extends Model
{
    use HasFactory;

    protected $guarded = [];

    /**
     * Relationship with customers
     */
    public function customer()
    {
        return $this->belongsTo(Customer::class);
    }

    /**
     * Sets up relationship with product
     */
    public function product()
    {
        return $this->belongsToMany(ProductInvoice::class)->as('items')->created_at;
    }
}