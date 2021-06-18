<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;

class PassportAuthController extends Controller
{
    /**
     * Registration Req
     */
    public function register(Request $request)
    {
        $validator = Validator::make($request->all(),[
                'name' => 'required|min:4',
                'email' => 'required|email',
                'password' => 'required|min:8',
                'role' => Rule::in(['', 'admin', 'customer'])
        ]);

        if ($validator->fails()){
            return response()->json(['error' => 'Bad request.', 'fails' => $validator->failed()], 400);
        }

        if (User::where('email', $request->email)->get()->isEmpty()){
            $user = User::create([
                'name' => $request->name,
                'email' => $request->email,
                'password' => bcrypt($request->password),
                'role' => $request->role
            ]);

            $token = $user->createToken('Laravel8PassportAuth')->accessToken;

            return response()->json(['token' => $token], 200);
        }else{
            return response()->json(['error' => 'Email is already registered.'], 409);
        }


    }

    /**
     * Login Req
     */
    public function login(Request $request)
    {
        $data = [
            'email' => $request->email,
            'password' => $request->password
        ];

        if (auth()->attempt($data)) {
            $token = auth()->user()->createToken('Laravel8PassportAuth')->accessToken;
            return response()->json(['token' => $token, 'user_id' => auth()->user()->id], 200);
        } else {
            return response()->json(['error' => 'Unauthorised'], 401);
        }
    }

    public function userInfo()
    {
        $user = auth()->user();

        return response()->json(['user' => $user], 200);

    }
}
