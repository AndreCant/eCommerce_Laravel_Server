<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Image;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ImageController extends Controller
{
    public function store(Request $request)
    {
        if (!isset($request['product_id']) || !isset($request['is_primary'])) return response()->json(null, 422);

        if (isset($request['path'])) {
            $path = $request['path'];
        }else{
            $file = $request->file('img');
            $path = $file->store('images');
        }

        $image = Image::create([
            "product_id" => $request["product_id"],
            "is_primary" => $request["is_primary"],
            "path" => $path
        ]);
        return response()->json(["url" => $image->path], 201);
    }

    public function delete($id)
    {
        if (!is_null($id)) {
            $image = Image::find($id);

            if (!is_null($image)){
                $path = $image->path;
                $image->delete();
                Storage::delete($path);

                return response()->json(null, 204);
            }else{
                return response()->json(null, 404);
            }
        }
    }
}
