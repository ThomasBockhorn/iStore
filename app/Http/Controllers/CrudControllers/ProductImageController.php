<?php

namespace App\Http\Controllers\CrudControllers;

use App\Models\ProductImage;
use App\Http\Requests\ProductImagesRequest;
use App\Http\Controllers\Controller;

class ProductImageController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $productImages = ProductImage::latest()->get();

        return response(compact('productImages'), 200);
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
     * @param  App\Models\ProductImageRequest $request
     * @return \Illuminate\Http\Response
     */
    public function store(ProductImagesRequest $request)
    {
        $productImages = ProductImage::Create($request->all());

        return response(compact('productImages'), 200);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\ProductImage  $productImage
     * @return \Illuminate\Http\Response
     */
    public function show(ProductImage $productImage)
    {
        return response(compact('productImage'), 200);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\ProductImage  $productImage
     * @return \Illuminate\Http\Response
     */
    public function edit(ProductImage $productImage)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param App\Http\Requests\ProductImagesRequest $request
     * @param  \App\Models\ProductImage  $productImage
     * @return \Illuminate\Http\Response
     */
    public function update(ProductImagesRequest $request, ProductImage $productImage)
    {

        $productImage->update($request->all());

        return response(compact('productImage'), 200);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\ProductImage  $productImage
     * @return \Illuminate\Http\Response
     */
    public function destroy(ProductImage $productImage)
    {
        $productImage->delete();

        return response(compact('productImage'), 200);
    }
}