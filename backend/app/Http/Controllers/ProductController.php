<?php

namespace App\Http\Controllers;

use App\Events\ProductOutOfStock;
use App\Http\Request\UpdateProductOutOfStock;
use App\Product;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class ProductController extends Controller
{

    /**
     * Fetching Products
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return \App\Product::paginate(50);
    }


    /**
     * Store a newly created product in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validator = \Validator::make($request->all(), [
            'name' => 'required|unique:products|max:255',
        ]);

        if ($validator->fails()) {
          return response($validator->errors(), Response::HTTP_UNPROCESSABLE_ENTITY);
        }

        $product = Product::requestToProduct($request);

        if($product->save()) {
            event(new ProductOutOfStock($request, $product));
            return response($product, Response::HTTP_CREATED);
        }

        return response('',Response::HTTP_UNPROCESSABLE_ENTITY);
    }

    /**
     * Fetching a product
     * @param Product $product
     * @return Product
     */
    public function show(Product $product)
    {
       return ['product'=>$product,'orders'=>$product->orders()->get()];
    }

    /**
     * Mark item as out of stock
     * @param Request $request
     * @param Product $product
     * @return Product|\Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\Routing\ResponseFactory|\Illuminate\Http\Response
     */
    public function update(Request $request, Product $product)
    {
        if ($product->inStock === false) {
            return response('', Response::HTTP_UNPROCESSABLE_ENTITY);
        }

        $product->inStock = false;

        if(!$product->save()) {
            return response('',Response::HTTP_UNPROCESSABLE_ENTITY);
        }

        event(new ProductOutOfStock($request, $product));
        return $product;
    }
}
