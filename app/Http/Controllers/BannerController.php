<?php

namespace App\Http\Controllers;

use App\Models\Banner;
use Illuminate\Http\Request;

class BannerController extends Controller
{
    public function create(Request $request){
        $input = $request->all();

        if (isset($input['name'])) $banner['name'] = $input['name'];
        if (isset($input['title'])) $banner['title'] = $input['title'];
        if (isset($input['sub_title'])) $banner['sub_title'] = $input['sub_title'];
        if (isset($input['image'])) {
            $path = $request->file('image')->store('images');
            $banner['image'] = 'http://127.0.0.1:8000' . '/uploads/' . $path;
        }

        Banner::create($banner);

        return response()->json('Ok!', 201);
    }

    public function showByName($name){
        $banner = Banner::where('name', $name)->get()[0];
        if ($banner){
            return response()->json([$banner], 200);
        }else{
            return response()->json(null, 404);
        }
    }

    public function showAll(){
        return response()->json(Banner::all(), 200);
    }

    public function delete($id){
        $banner = Banner::find($id);
        if ($banner){
            $banner->delete();
            return response()->json(null, 204);
        }else{
            return response()->json(null, 404);
        }
    }

    public function update(Request $request, $id){
        $input = $request->all();
        $banner = Banner::find($id);

        if (isset($input['name'])) $banner['name'] = $input['name'];
        if (isset($input['title'])) $banner['title'] = $input['title'];
        if (isset($input['sub_title'])) $banner['sub_title'] = $input['sub_title'];
        if (isset($input['image'])) {
            $path = $request->file('image')->store('images');
            $banner['image'] = 'http://127.0.0.1:8000' . '/uploads/' . $path;
        }

        $banner->save();

        return response()->json($banner, 200);
    }
}
