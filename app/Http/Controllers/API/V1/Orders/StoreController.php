<?php

namespace App\Http\Controllers\API\V1\Orders;

use App\Http\Controllers\Controller;
use App\Http\Resources\API\V1\OrderResource;
use Illuminate\Http\Request;
use App\Http\Requests\API\V1\StoreOrderRequest;
use App\Models\Order;
use App\Models\Basket;

class StoreController extends Controller
{
    /**
    * Store given order information.
    */
    public function __invoke(StoreOrderRequest $request)
    {
        $validated = $request->validated();

        try {
            $order = Order::create([
                'first_name' => $validated['first_name'],
                'last_name' => $validated['last_name'],
                'address' => $validated['address'],
            ]);

            foreach ($validated['basket'] as $item) {
                $order->basket()->save(
                    new Basket([
                        'name' => $item['name'],
                        'type' => $item['type'],
                        'price' => $item['price']
                    ])
                );
            }

            return new OrderResource($order);
        } catch (\Throwable $th) {
            return response()->json(
                ['error' => 'Something went wrong!'], 
                500
            );
        }
    }
}
