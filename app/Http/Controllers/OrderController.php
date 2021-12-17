<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\OrderLineItem;
use App\Models\Product;
use App\Models\User;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\JsonResponse|\Illuminate\Http\Response
     */
    public function showByUser($id)
    {
        if (is_null($id)) {
            return response()->json(null, 400);
        }else{
            if (!User::find($id))  return response()->json(null, 404);

            $response = [];
            $orders = Order::where('user_id', $id)->get();

            if(!is_null($orders)) {
                foreach ($orders as $order) {
                    $ordWithItems['id'] = $order->id;
                    $ordWithItems['code'] = $order->code;
                    $ordWithItems['status'] = $order->status;
                    $ordWithItems['payment_id'] = $order->payment_id;
                    $ordWithItems['user_id'] = $order->user_id;
                    $ordWithItems['items'] = $order->items;
                    array_push($response, $ordWithItems);
                }
            }

            return response()->json($response, 200);
        }
    }

    public function create(Request $request, $id)
    {
        if (is_null($request)) return response()->json(null, 422);
        if (!User::find($id))  return response()->json(null, 404);

        $input = $request->all();

        if (!$input) return response()->json(null, 422);
        if (!isset($input['items']) || is_null($input['items'])) return response()->json(null, 422);
        if (!isset($input['payment_id']) || is_null($input['payment_id'])) return response()->json(null, 422);
        if (is_null($id)) return response()->json(null, 422);

        $order['payment_id'] = $input['payment_id'];
        $order['user_id'] = (int) $id;
        $order['status'] = 'In Progress';
        $order['code'] = 'MWT-' . rand(1000,9999);

        $order = Order::create($order);
        $items = [];

        foreach ($input['items'] as $oli) {
            $oli['order_id'] = $order->id;
            $oli['code'] = 'OLI-' . rand(1000,9999);
            $oli = OrderLineItem::create($oli);
            array_push($items, $oli);
        }

        $order['items'] = $items;
        return response()->json(["url" => "http://127.0.0.1:8000/api/rest/user/" . $id . "/orders"], 201);
    }

    public function showAll(){
        $response = [];
        $orders = Order::all();

        if(!is_null($orders)) {
            foreach ($orders as $order) {
                $ordWithItems['id'] = $order->id;
                $ordWithItems['code'] = $order->code;
                $ordWithItems['status'] = $order->status;
                $ordWithItems['payment_id'] = $order->payment_id;
                $ordWithItems['user_id'] = $order->user_id;
                $ordWithItems['items'] = $order->items;
                array_push($response, $ordWithItems);
            }
        }

        return response()->json($response, 200);
    }
}
