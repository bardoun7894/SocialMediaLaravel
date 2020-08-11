<?php

namespace App\Http\Controllers\Api;

  use  App\Http\Controllers\Controller;
  use  App\Http\Requests\LoginRequest;
  use  App\Http\Requests\RegisterRequest;

  use App\User;
  use Illuminate\Foundation\Auth\AuthenticatesUsers;
  use  Illuminate\Http\Request;
  use Illuminate\Support\Facades\Auth;
  use Illuminate\Support\Facades\Hash;

  class AuthController extends Controller
{
    use AuthenticatesUsers;
  public function register(RegisterRequest $request){
      $user =User::Create([
          'name'=>$request->name,
          'email'=>$request->email,
          'password'=> hash::make($request->password)
      ]);
      $token = $user->createToken('access-token');
      return response()->json([
          'id'=>$user ->id,
          'access_token'=>$token->plainTextToken
      ]);

            }
  public  function login(LoginRequest $request){
     if(method_exists($this,'hasTooManyLoginAttempts') && $this->hasTooManyLoginAttempts($request) ){
             $this->fireLockoutEvent($request);
             return $this->sendLockoutResponse($request);
          }
       if($this->attemptLogin($request)){
           if(Auth::attempt($request->only(['email','password']))){
                    $user=User::Where([
                       'email'=>$request->email
                    ])->first();
             $user->tokens()->delete();
             $token=$user->createToken('access_token');
               return response()->json([
                   'id'=>$user->id,
                   'access_token'=>$token->plainTextToken
               ]);
           }else{
         return response(['error'=>' authentication failed'],403);
           }
       }
       $this->incrementLoginAttempts($request);
       return $this->sendFailedLoginResponse($request);
             }
}
