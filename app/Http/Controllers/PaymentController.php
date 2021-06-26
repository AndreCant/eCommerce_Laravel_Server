<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Payment;
use Illuminate\Http\Request;

class PaymentController extends Controller
{
    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\JsonResponse|\Illuminate\Http\Response
     */
    public function showAll($id)
    {
        $payments = Payment::where('user_id', $id)->get();
        if (is_null($payments)) {
            return $this->sendError('Payments not found.', 404);
        }
        return response()->json($payments, 200);
    }

    /**
     * Create resource.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\JsonResponse|\Illuminate\Http\Response
     */
    public function create(Request $request, $id)
    {
        if (!is_null($request)) {
            $user = Payment::create([
                'name' => $request->name,
                'surname' => $request->surname,
                'number' => $request->number,
                'expiration' => $request->expiration,
                'cvc' => $request->cvc,
                'user_id' => $id
            ]);

            return response()->json(['message' => 'OK'], 200);
        }

    }
}
