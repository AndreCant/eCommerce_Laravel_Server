<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Registry;
use Illuminate\Http\Request;

class RegistryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\JsonResponse|\Illuminate\Http\Response
     */
    public function index()
    {
        $registries = Registry::all();
        return response()->json([
            "success" => true,
            "message" => "Registry List",
            "data" => $registries
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function store(Request $request)
    {
        $input = $request->all();
        $registry= Registry::create($input);
        return response()->json([
            "success" => true,
            "message" => "Registry created successfully.",
            "data" => $registry
        ]);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\JsonResponse|\Illuminate\Http\Response
     */
    public function show($id)
    {
        $registry = Registry::find($id);
        if (is_null($registry)) {
            return $this->sendError('Product not found.');
        }
        return response()->json([
            "success" => true,
            "message" => "Product retrieved successfully.",
            "data" => $registry
        ]);
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
        return response()->json([
            "success" => true,
            "message" => "Registry updated successfully.",
            "data" => $registry
        ]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\JsonResponse|\Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $registry = Registry::find($id);
        $registry->delete();
        return response()->json([
            "success" => true,
            "message" => "Registry deleted successfully.",
            "data" => $registry
        ]);
    }
}
