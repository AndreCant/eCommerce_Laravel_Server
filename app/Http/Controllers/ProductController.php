<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Product;
use Illuminate\Http\Request;
use Symfony\Component\Console\Input\Input;

class ProductController extends Controller
{
    public function showFiltered(Request $request){
        $allParameters = $request->all();

        if(!is_null($allParameters)){
            $products = Product::where($allParameters)->get();
            $filtered = [];

            if(!is_null($products)){
                foreach ($products as $product) {
                    $lite = [];
                    $lite['id'] = $product->id;
                    $lite['url'] = 'http://127.0.0.1:8000/api/rest/product/' . $product->id;
                    $lite['name'] = $product->name;
                    $lite['price'] = $product->price;

                    array_push($filtered, $lite);
                }
            }
            return response()->json($filtered, 200);
        }else{
            return response()->json(["message" => "Method not allowed."], 405);
        }
    }

    public function store(Request $request)
    {
        $input = $request->all();
        $product = Product::create($input);
        return response()->json($product, 200);
    }
    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $product = Product::find($id);
        if (is_null($product)) {
            return response()->json(["message" => "Product not found."], 200);
        }
        return response()->json($product, 200);
    }
    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Product $product)
    {
//        $input = $request->all();
//        $product->name = $input['name'];
//        $product->detail = $input['detail'];
//        $product->save();
//        return response()->json([
//            "success" => true,
//            "message" => "Product updated successfully.",
//            "data" => $product
//        ]);
    }
    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Product $product)
    {
        $product->delete();
        return response()->json(["message" => "OK"], 200);
    }

}
