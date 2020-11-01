<?php

namespace App\Listeners;

use App\Events\ProductOutOfStock;
use App\Order;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

class CreatePurchaseItemRequest
{
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     *
     * @param  object  $event
     * @return void
     */
    public function handle(ProductOutOfStock $event)
    {
        //
        $order = new Order();
        $order->product_id = $event->product->id;
        $order->save();
    }
}
