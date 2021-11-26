<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Image;
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
        if ($input){
            $image = [];
            if (isset($input['previewUrl'])) {
                $image['path'] = $input['previewUrl'];
                unset($input['previewUrl']);
            }

            $product = Product::create($input);

            if (isset($image['path'])) {
                $image['product_id'] = $product->id;
                $image['is_primary'] = true;
                Image::create($image);
            }
            return response()->json(["url" => "http://127.0.0.1:8000/api/rest/product/" . $product->id], 201);
        }else{
            return response()->json(["message" => "Empty payload!"], 400);
        }
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

        if ($product){
            $prod = $product->jsonSerialize();

            if(!is_null($product->images)) {
                $prod['images'] = [];
                foreach ($product->images as $image) {
                    array_push($prod['images'], [
                        "url" => $image->path,
                        "is_primary" => $image->is_primary
                    ]);
                }
            }
            return response()->json($prod, 200);
        }else{
            return response()->json(null, 404);
        }
    }
    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        if ($request){
            $input = $request->all();
            $product = Product::find($id);

            if ($product){
                if (isset($input['name'])) $product->name = $input['name'];
                if (isset($input['short_description'])) $product->short_description = $input['short_description'];
                if (isset($input['description'])) $product->description = $input['description'];
                if (isset($input['price'])) $product->price = $input['price'];
                if (isset($input['gender'])) $product->gender = $input['gender'];
                if (isset($input['type'])) $product->type = $input['type'];
                if (isset($input['sub_type'])) $product->sub_type = $input['sub_type'];
                if (isset($input['size_available'])) $product->size_available = $input['size_available'];
                if (isset($input['color'])) $product->color = $input['color'];
                if (isset($input['material'])) $product->material = $input['material'];
                if (isset($input['collection'])) $product->collection = $input['collection'];
                $product->save();
                return response()->json(null, 204);
            }else{
                return response()->json(null, 404);
            }
        }else{
            return response()->json(["message" => "Empty payload!"], 400);
        }
    }
    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function delete($id)
    {
        $product = Product::find($id);
        if ($product){
            $product->delete();
            return response()->json(null, 204);
        }else{
            return response()->json(null, 404);
        }
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
