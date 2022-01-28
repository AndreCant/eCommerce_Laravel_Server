<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    public function showAll(){
        return response()->json(Category::all(), 200);
    }

    public function showByName($name){
        return response()->json(Category::where('type_name', $name)->get()[0], 200);
    }

    public function create(Request $request){
        $input = $request->all();

        $category['type_name'] = $input['type_name'];
        $category['sub_types'] = $input['sub_types'];

        Category::create($category);

        return response()->json('Ok!', 201);
    }

    public function update(Request $request, $id){
        $input = $request->all();
        $category = Category::find($id);

        $category['type_name'] = $input['type_name'];
        $category['sub_types'] = $input['sub_types'];

        $category->save();

        return response()->json('Ok!', 204);
    }

    public function delete($id){
        $category = Category::find($id);
        if ($category){
            $category->delete();
            return response()->json(null, 204);
        }else{
            return response()->json(null, 404);
        }
    }
}
