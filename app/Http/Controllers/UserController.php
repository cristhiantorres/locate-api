<?php

namespace App\Http\Controllers;

use App\User;

use Illuminate\Support\Facades\Hash; 

use Illuminate\Http\Request;

class UserController extends Controller
{
  public function __construct()
  {

  }
  
  public function store(Request $request)
  {
    $user = new User;

    $user->name     = $request->name;
    $user->email    = $request->email;
    $user->password = Hash::make($request->password);

    if ($user->save()) {
      return response()->json(['status' => 'User created'], 201);
    }else{
      return response()->json(['status' => 'Faild'], 404);
    }
  }


  public function authenticate(Request $request)
  {
    $this->validate($request, [
      'email'     =>  'required',
      'password'  =>  'required',
    ]);

    $user = User::where('email', $request->email)->first();

    if (Hash::check($request->password, $user->password)) {
      $api_key = base64_encode(str_random(40));

      User::where('email', $request->email)->update(['api_token' => $api_key]);

     
      return response()->json(['api_key' => $api_key]);
    
    }else{
     
      return response()->json(['status' => 'Fail'],401);
    
    }
  }

  public function logout(Request $request)
  {
    $user = User::where('api_token',$request->api_token)->first();
    
    $user->api_token = NULL;

    if ($user->update()) {
    
      return response()->json(['status' => 'Logout success'], 200);
    
    }else{
    
      return response()->json(['status' => 'Fail'], 401);
    
    }    
  }
}
