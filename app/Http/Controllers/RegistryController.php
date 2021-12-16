<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Registry;
use Illuminate\Http\Request;

class RegistryController extends Controller
{
    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\JsonResponse|\Illuminate\Http\Response
     */
    public function show($id)
    {
        $registry = Registry::where('user_id', $id)->get();

        if (sizeof($registry)) {
            return response()->json($registry[0], 200);
        }else{
            return response()->json(null, 404);
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\JsonResponse|\Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $input = $request->all();
        $registry = Registry::find($id);

        if ($registry){
            if (isset($input['name'])) $registry->name = $input['name'];;
            if (isset($input['surname'])) $registry->surname = $input['surname'];;
            if (isset($input['street'])) $registry->street = $input['street'];;
            if (isset($input['city'])) $registry->city = $input['city'];;
            if (isset($input['county'])) $registry->county = $input['county'];;
            if (isset($input['postal_code'])) $registry->postal_code = $input['postal_code'];;
            if (isset($input['state'])) $registry->state = $input['state'];
            if (isset($input['phone'])) $registry->phone = $input['phone'];
            $registry->save();
            return response()->json(null, 204);
        }else{
            return response()->json(null, 404);
        }
    }
}
