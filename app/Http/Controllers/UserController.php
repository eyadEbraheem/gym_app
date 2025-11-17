<?php

namespace App\Http\Controllers;
use App\Models\User;
use App\Http\Requests\UserRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
class UserController extends Controller
{
    public function register(UserRequest $request)
    {
        $request->validated();
        $register_info=User::create(        
            [
                'name'=>$request->name,
                'role'=>$request->role,
                'email'=>$request->email,
                'password'=>Hash::make($request->password),
            ]);
        return response()->json([
            'message'=>'your account created succefuly',
            'account information'=>$register_info],
            200
        );

    }
    public function login(Request $request)
    {
        $request->validate([
            'email'=>'required|string|email|max:255',
            'password'=>'required|string|min:8',
        ]
        );
        if(!Auth::attempt(['email'=> $request->email , 'password'=>$request->password]))
        {
        return response()->json([
        'message'=>'البريد الالكتروني او كلمة السر غير صحيحة'],
        401);
        }
        $user=User::where('email',$request->email)->firstOrFail();
        $token=$user->createToken('auth_token')->plainTextToken;
        return response()->json([
        'تم تسجيل الدخول بنجاح',
        'user'=>$user,
        'token'=>$token],
        200);
    }
};
