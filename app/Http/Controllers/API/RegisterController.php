<?php


namespace App\Http\Controllers\API;
use Illuminate\Http\Request;
use App\Http\Controllers\API\BaseController as BaseController;
use App\User;
use  Validator ;

use Illuminate\Support\Facades\Auth;  //added


class RegisterController extends BaseController  
{

 

public function register(Request $request)
{
    # code...
   
    $validator =    Validator::make($request->all(), [
    'name'=> 'required|string|max:255',
    'email'=> 'required|email|max:255|unique:users|string',
    'password'=> 'required|min:8|string',
    'c_password'=> 'required|same:password',
    ] );




    if ($validator -> fails()) {
        # code...
        return $this->sendError('error validation', $validator->errors());
    }

    $input = $request->all();
    $input['password'] = bcrypt($input['password']);
    $user = User::create($input);
    $success['token'] = $user->createToken('MyApp')->accessToken;
    $success['name'] = $user->name;

    return $this->sendResponse($success , 'User created succesfully');
    
}

public function login(Request $request)
{
    $credentials = [
        'email' => $request->email,
        'password' => $request->password
    ];

    if (auth()->attempt($credentials)) {
        $token = auth()->user()->createToken('MySecret')->accessToken;
        return response()->json(['token' => $token], 200);
    } else {
        return response()->json(['error' => 'UnAuthorised'], 401);
    }
}

    
}