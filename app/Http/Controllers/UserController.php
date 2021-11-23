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
        if (is_null($user)) {
            return $this->sendError('User not found.');
        }

        return response()->json($user, 200);
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
}
