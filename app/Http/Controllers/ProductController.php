<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Storage;
use Symfony\Component\Console\Input\Input;

class ProductController extends Controller
{
    public function showFiltered(Request $request){
        $allParameters = $request->all();

        if(!empty($allParameters)){
            $filtered = [];
            $products = Product::where('gender', $allParameters['gender'])
                                ->where('type', $allParameters['type'])
                                ->where(function ($query) use ($allParameters){
                                    if(!is_null($allParameters['subtype'])){
                                        foreach (json_decode($allParameters['subtype']) as $subtype){
                                            $query->orWhere('sub_type', $subtype);
                                        }
                                    }
                                })
                                ->where(function ($query) use ($allParameters){
                                    if(!is_null($allParameters['size'])){
                                        foreach (json_decode($allParameters['size']) as $size){
                                            $query->orWhere('size_available', 'LIKE', "%{$size}%");
                                        }
                                    }
                                })
                                ->where(function ($query) use ($allParameters){
                                    if(!is_null($allParameters['price'])){
                                        foreach (json_decode($allParameters['price']) as $price){
                                            if ($price == 20){
                                                $query->orWhere(function ($query){
                                                    $query->where('price', '>=', 20)->where('price', '<', 50);
                                                });
                                            }elseif ($price == 50){
                                                $query->orWhere(function ($query){
                                                    $query->where('price', '>=', 50)->where('price', '<', 100);
                                                });
                                            }elseif ($price == 100){
                                                $query->orWhere(function ($query){
                                                    $query->where('price', '>=', 100)->where('price', '<', 150);
                                                });
                                            }elseif ($price == 150){
                                                $query->orWhere(function ($query){
                                                    $query->where('price', '>=', 150);
                                                });
                                            }
                                        }
                                    }
                                })->get();

            if(!is_null($products)){
                foreach ($products as $product) {
                    $lite = [];
                    $lite['id'] = $product->id;
                    $lite['url'] = 'http://127.0.0.1:8000/api/rest/product/' . $product->id;
                    $lite['name'] = $product->name;
                    $lite['price'] = $product->price;

                    if(!is_null($product->images)) {
                        foreach ($product->images as $image) {
                            if ($image->is_primary){
                                //$lite['preview'] = 'http://127.0.0.1:8000/uploads/'$image->path;
                                $lite['preview'] = $image->path;
                                break;
                            }
                        }
                    }
                    array_push($filtered, $lite);
                }
            }
            return response()->json($filtered, 200);
        }else{
            return response()->json(Product::all(), 200);
//            return response()->json(["message" => "Method not allowed."], 405);
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
     * @return \Illuminate\Http\JsonResponse
     */
    public function show($id)
    {
        $product = Product::find($id);
        $prod = $product->jsonSerialize();

        if (is_null($product)) {
            return response()->json(["message" => "Product not found."], 404);
        }else{
            if(!is_null($product->images)) {
                $prod['images'] = [];
                foreach ($product->images as $image) {
                    array_push($prod['images'], [
                        //"url" => 'http://127.0.0.1:8000/uploads/' . $image->path,
                        "url" => $image->path,
                        "is_primary" => $image->is_primary
                    ]);
                }
            }
            return response()->json($prod, 200);
        }
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


    public function showByIds(Request $request){
        $allParameters = $request->all();
        $productIds = json_decode($allParameters['id']);

        if(!is_null($productIds)){
            $products = Product::whereIn('id', $productIds)->get();
            $prodAll = [];

            foreach ($products as $product) {
                $prod = $product->jsonSerialize();
                $prod['previewUrl'] = $product->images[0]->path;
                array_push($prodAll, $prod);
            }

            return response()->json($prodAll, 200);
        }else{
            return response()->json('Id list is empty.', 400);
        }
    }

}
