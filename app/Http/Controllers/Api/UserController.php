<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class UserController extends Controller
{
    public function signup(Request $request)
    {
        $validator = validator()->make($request->all(),[
            'name' => 'required',
            'password' => 'required|confirmed',
            'email' => 'required|unique:users',
        ]);

        if ($validator->fails())
        {
            return responsejson(0,$validator->errors()->first(),$validator->errors());
        }
        $request->merge(['password' => bcrypt($request->password)]);
        $user = User::create($request->all());

        $user->api_token = Str::random(60);
        $user->save();
        return responsejson(1,'success',[
            'Token' => $user->api_token,
            'user' => $user
        ]);
    }

    public function login(Request $request)
    {
        $validator = validator()->make($request->all(),[
            'email' => 'required',
            'password' => 'required',
        ]);
        if ($validator->fails())
        {
            return responsejson(0,$validator->errors()->first(),$validator->errors());
        }
        $user = User::where('email',$request->email)->first();
        if ($user)
        {
            if (Hash::check($request->password,$user->password))
            {
                return responsejson(1,'success',[
                    'token' => $user->api_token,
                    'user' => $user
                ]);
            }
            else
            {
                return responsejson(0,'errorpassword');
            }
        }
        else
        {
            return responsejson(0,'error');
        }
    }
}
