<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProductDetailStoreRequest;
use App\Http\Requests\ProductDetailUpdateRequest;
use App\Models\ProductDetail;
use Illuminate\Http\Request;

class ProductDetailController extends Controller
{
    /**
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $productDetails = ProductDetail::all();

        return view('productDetail.index', compact('productDetails'));
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        return view('productDetail.create');
    }

    /**
     * @param \App\Http\Requests\ProductDetailStoreRequest $request
     * @return \Illuminate\Http\Response
     */
    public function store(ProductDetailStoreRequest $request)
    {
        $productDetail = ProductDetail::create($request->validated());

        $request->session()->flash('productDetail.id', $productDetail->id);

        return redirect()->route('productDetail.index');
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\ProductDetail $productDetail
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request, ProductDetail $productDetail)
    {
        return view('productDetail.show', compact('productDetail'));
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\ProductDetail $productDetail
     * @return \Illuminate\Http\Response
     */
    public function edit(Request $request, ProductDetail $productDetail)
    {
        return view('productDetail.edit', compact('productDetail'));
    }

    /**
     * @param \App\Http\Requests\ProductDetailUpdateRequest $request
     * @param \App\Models\ProductDetail $productDetail
     * @return \Illuminate\Http\Response
     */
    public function update(ProductDetailUpdateRequest $request, ProductDetail $productDetail)
    {
        $productDetail->update($request->validated());

        $request->session()->flash('productDetail.id', $productDetail->id);

        return redirect()->route('productDetail.index');
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\ProductDetail $productDetail
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, ProductDetail $productDetail)
    {
        $productDetail->delete();

        return redirect()->route('productDetail.index');
    }
}
