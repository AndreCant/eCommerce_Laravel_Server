<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Registry;
use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\JsonResponse|\Illuminate\Http\Response
     */
    public function show($id)
    {
        $user = User::find($id);
        if ($user) {
            return response()->json($user, 200);
        }else{
            return response()->json(null, 404);
        }
    }

    public function showAll()
    {
        $users = User::all();

        if (!is_null($users)){
            foreach ($users as $user) {
                $user->registry;
            }
        }

        return response()->json($users, 200);
    }

    public function updateRole(Request $request, $id){

        if ($request){
            $fields = $request->all();

            if ($fields){
                $user = User::find($id);

                if ($user){
                    if (isset($fields['role'])) $user->role = $fields['role'];
                    $user->save();
                    return response()->json(null, 204);
                }else{
                    return response()->json(null, 404);
                }
            }else{
                return response()->json(["message" => "Empty payload."], 400);
            }
        }else{
            return response()->json(["message" => "Empty payload."], 400);
        }
    }
}
