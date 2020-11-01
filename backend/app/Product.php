<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Symfony\Component\HttpFoundation\Response;

class Product extends Model
{
    /**
     * Indicates if the model should be timestamped.
     *
     * @var bool
     */
    public $timestamps = true;

    protected $table = 'products';


    /**
     * @param \Illuminate\Http\Request $request
     * @return Product
     */
    public static function requestToProduct(\Illuminate\Http\Request $request) {
        $product = new Product();
        $product->name = $request->name;
        $product->description = $request->description ? $request->description : null;
        $product->inStock = False;

        return $product;
    }


    public function orders() {
        return $this->hasMany('App\Order');
    }



}
