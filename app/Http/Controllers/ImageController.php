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
        $file = $request->file('img');
        $path = $file->store('images');
//        Storage::get($path);

        $image = Image::create([
            "product_id" => $request["product_id"],
            "is_primary" => $request["is_primary"],
            "path" => $path
        ]);
        return response()->json($image, 200);
    }

    public function delete($id)
    {
        if (!is_null($id)) {
            $image = Image::find($id);

            if (!is_null($image)){
                $path = $image->path;
                $image->delete();
                Storage::delete($path);

                return response()->json(['message' => 'OK'], 200);
            }else{
                return response()->json(['message' => 'Not Found'], 404);
            }
        }
    }
}
