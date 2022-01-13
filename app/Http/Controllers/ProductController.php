<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use App\Http\Resources\ProductResource;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $products = Product::all();

        return $products->map(function ($product){
            return new ProductResource($product);
        });
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $data = $request->all();
        $product = Product::create($data);

        $product->available = $data['available'];
        $product->save();

        return new Response($product);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $product = Product::findOrFail($id);
        return new ProductResource($product);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $product = Product::findOrFail($id);

        if (!$product) {
            return new Response([
                'result' => 'fail',
                'message' => 'product not found'
            ]);
        }

        $data = $request->all();

        foreach ($data as $key => $value) {
            if ($key === 'price') {
                $product->$key = $value*100;
            } else {
                $product->$key = $value;
            }
        }
        $product->save();

        return new Response(new ProductResource($product));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $result = Product::destroy($id);
        return ['result' => $result ? 'success' : 'fail'];
    }

    public function deleteBySeller($sellerId)
    {
        $result = Product::where('seller_id', $sellerId)->delete();
        return ['result' => $result ? 'success' : 'fail'];
    }
}
