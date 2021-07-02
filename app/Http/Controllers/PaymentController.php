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
            Payment::create([
                'name' => $request->name,
                'surname' => $request->surname,
                'number' => $request->number,
                'year' => $request->year,
                'month' => $request->month,
                'cvv' => $request->cvv,
                'user_id' => $id
            ]);

            return response()->json(['message' => 'OK'], 200);
        }
    }

    /**
     * Delete resource.
     *
     * @param  int  $id
     * @param  int  $paymentId
     * @return \Illuminate\Http\JsonResponse|\Illuminate\Http\Response
     */
    public function delete($id, $paymentId)
    {
        if (!is_null($paymentId)) {
            $payment = Payment::find($paymentId);

            if (!is_null($payment)){
                $payment->delete();
                return response()->json(['message' => 'OK'], 200);
            }else{
                return response()->json(['message' => 'Not Found'], 404);
            }
        }
    }
}
