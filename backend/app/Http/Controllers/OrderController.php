<?php

namespace App\Http\Controllers;

use App\Events\ProductOutOfStock;
use App\Order;
use App\Product;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return Order::with('product')->paginate(50);
    }


    /**
     * Create a new inventory order request for a product
     * @param Request $request
     * @param Product $product

    public function store(Request $request, Product $product)
    {
        return $product;
        event(new ProductOutOfStock($request, $product));
    }
     * */

    /**
     * Display the specified resource
     * @param $id
     * @return \Illuminate\Database\Eloquent\Builder|\Illuminate\Database\Eloquent\Builder[]|\Illuminate\Database\Eloquent\Collection|\Illuminate\Database\Eloquent\Model|null
     */
    public function show($id)
    {
        return Order::with('product')->find($id);
    }


    /**
     * Update the order to complete (Back in stock!)
     * @param Order $order
     * @return boolean
     */
    public function update(Order $order)
    {
        $order->touch();
        $product = Product::find($order->product_id);
        $product->inStock = true;
        return $product->save();
    }
}
