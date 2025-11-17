<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProfileRequest;
use App\Http\Resources\profileresource;
use Illuminate\Support\Facades\Auth;
use App\Models\Profile;
use Illuminate\Http\Request;

class ProfileController extends Controller
{
    public function add_Profile(ProfileRequest $request)
    {
        $user=Auth::user();
        $user_id=$user->id;
        $profile_check=Profile::where('user_id',$user_id)->exists();
        if(!$profile_check){
        $validate_infrmation=$request->validated();
        $validate_infrmation['user_id']=$user_id;
        if($request->hasFile('image')){
            $path=$request->file('image')->store('my photos','public');
            $validate_infrmation['image']=$path;
        if($user->role=='مستخدم'){
            $validate_infrmation['years_experiense']= 0;
            $validate_infrmation['bio']= 'null';
        }
            $profile_information=Profile::create($validate_infrmation);
            $profile_with_user=Profile::with('User')->where('user_id',$user_id)->firstOrfail();
            $profile= new profileresource($profile_with_user);
            return response()->json([
            'message' => 'your profile created succesfuly',  
            'your profile information'=>  $profile  ,  
            ],200);
            }}
        else
            $profile_with_user=Profile::with('User')->where('user_id',$user_id)->firstOrfail();
            $profile= new profileresource($profile_with_user);
            return response()->json([
            'message' => 'your profile created already',
            'your profile:'=>$profile],
            409);        
}}
