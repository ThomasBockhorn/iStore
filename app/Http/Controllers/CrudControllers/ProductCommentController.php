<?php

namespace App\Http\Controllers\CrudControllers;

use App\Models\ProductComment;
use App\Http\Requests\ProductCommentRequest;
use App\Http\Controllers\Controller;

class ProductCommentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $productComments = ProductComment::latest()->get();

        return response(compact('productComments'), 200);
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
     * @param  \Illuminate\Http\ProductCommentRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(ProductCommentRequest $request)
    {
        $productComments = ProductComment::Create($request->all());

        return response(compact('productComments'), 200);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\ProductComment  $productComment
     * @return \Illuminate\Http\Response
     */
    public function show(ProductComment $productComment)
    {
        return response(compact('productComment'), 200);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\ProductComment  $productComment
     * @return \Illuminate\Http\Response
     */
    public function edit(ProductComment $productComment)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\ProductComment  $productComment
     * @return \Illuminate\Http\Response
     */
    public function update(ProductCommentRequest $request, ProductComment $productComment)
    {
        $productComment->update($request->all());

        return response(compact('productComment'), 200);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\ProductComment  $productComment
     * @return \Illuminate\Http\Response
     */
    public function destroy(ProductComment $productComment)
    {
        $productComment->delete();

        return response(compact('productComment'), 200);
    }
}