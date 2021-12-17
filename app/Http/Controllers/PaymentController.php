<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Payment;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;

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
        if (!User::find($id))  return response()->json(null, 404);

        return response()->json(Payment::where('user_id', $id)->get(), 200);
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
            if (!User::find($id))  return response()->json(null, 404);

            $validator = Validator::make($request->all(),[
                'name' => 'required',
                'surname' => 'required',
                'number' => 'required',
                'year' => 'required',
                'month' => 'required',
                'cvv' => 'required'
            ]);

            if ($validator->fails()){
                return response()->json(['error' => 'Bad request.', 'fails' => $validator->failed()], 400);
            }

            Payment::create([
                'name' => $request->name,
                'surname' => $request->surname,
                'number' => $request->number,
                'year' => $request->year,
                'month' => $request->month,
                'cvv' => $request->cvv,
                'user_id' => $id
            ]);

            return response()->json(["url" => "http://127.0.0.1:8000/api/rest/user/" . $id . "/payment"], 201);
        }else{
            return response()->json(null, 400);
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
        if (!User::find($id))  return response()->json(null, 404);

        $payment = Payment::find($paymentId);

        if ($payment){
            $payment->delete();
            return response()->json(null, 204);
        }else{
            return response()->json(null, 404);
        }
    }
}
