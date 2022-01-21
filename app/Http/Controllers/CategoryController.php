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
}
