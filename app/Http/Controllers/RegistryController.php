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
        $registry = Registry::where('user_id', $id)->get()[0];
        if (is_null($registry)) {
            return $this->sendError('Registry not found.', 404);
        }
        return response()->json($registry, 200);
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
        $registry->name = $input['name'];
        $registry->save();
        return response()->json($registry, 200);
    }
}
