<?php

namespace App\Http\Controllers\CrudControllers;

use App\Models\ProductInvoice;
use App\Http\Requests\ProductInvoiceRequest;
use App\Http\Controllers\Controller;

class ProductInvoiceController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $productInvoices = ProductInvoice::latest()->get();

        return response(compact('productInvoices'), 200);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\ProductInvoiceRequest
     * @return \Illuminate\Http\Response
     */
    public function store(ProductInvoiceRequest $request)
    {
        $productInvoices = ProductInvoice::Create($request->all());

        return response(compact('productInvoices'), 200);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\ProductInvoice  $productInvoice
     * @return \Illuminate\Http\Response
     */
    public function show(ProductInvoice  $productInvoice)
    {
        return response(compact('productInvoice'), 200);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\ProductInvoiceRequest
     * @param  \App\Models\ProductInvoice  $productInvoice
     * @return \Illuminate\Http\Response
     */
    public function update(ProductInvoiceRequest $request, ProductInvoice $productInvoice)
    {
        $productInvoice->update($request->all());

        return response(compact('productInvoice'), 200);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\ProductInvoice  $productInvoice
     * @return \Illuminate\Http\Response
     */
    public function destroy(ProductInvoice $productInvoice)
    {
        $productInvoice->delete();

        return response(compact('productInvoice'), 200);
    }
}