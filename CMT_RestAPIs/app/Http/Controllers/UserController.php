<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
//use JWTAuth;
use Tymon\JWTAuth\Facades\JWTAuth;
use Tymon\JWTAuth\Facades\JWTFactory;
use Tymon\JWTAuth\Exceptions\JWTException;
use Tymon\JWTAuth\Contracts\JWTSubject;
use Tymon\JWTAuth\PayloadFactory;
use Tymon\JWTAuth\JWTManager as JWT;

class UserController extends Controller
{
    //
    public function register(Request $request)
    {
        $validator = Validator::make($request->json()->all() , [
            'firstName' => 'required|string|max:255',
            'middleName' => 'required|string|max:255',
            'lastName' => 'required|string|max:255',
            'birthDate' => 'required|string|max:15',
            'gender' => 'required|string|max:15',
            'email' => 'required|string|email|max:255|unique:users',
            'phone' => 'required|string|max:20',            
            'password' => 'required|string|min:6', 
            'roleType' => 'required|string|max:255',
            'country' => 'required|string|max:255',
            'province' => 'required|string|max:255',
            'city' => 'required|string|max:255',
            'postal' => 'required|string|max:255'
        ]);

        if($validator->fails()){
                return response()->json($validator->errors()->toJson(), 400);
        }

        $user = User::create([
            'firstName' => $request->json()->get('firstName'),
            'middleName' => $request->json()->get('middleName'),
            'lastName' => $request->json()->get('lastName'),
            'birthDate' => $request->json()->get('birthDate'),
            'gender' => $request->json()->get('gender'),
            'email' => $request->json()->get('email'),
            'phone' => $request->json()->get('phone'),
            'password' => Hash::make($request->json()->get('password')),
            'roleType' => $request->json()->get('roleType'),
            'country' => $request->json()->get('country'),
            'province' => $request->json()->get('province'),
            'city' => $request->json()->get('city'),
            'postal' => $request->json()->get('postal'),
        ]);

        $token = JWTAuth::fromUser($user);

        $test2 = test2::create([
            'firstName' => $request->json()->get('firstName'),
            'middleName' => $request->json()->get('middleName'),
            'lastName' => $request->json()->get('lastName'),
        ]);
        
        return response()->json(compact('user','token'),201);
    }


    
    public function login(Request $request)
    {
        $credentials = $request->json()->all();

        try {
            if (! $token = JWTAuth::attempt($credentials)) {
                return response()->json(['error' => 'invalid_credentials'], 400);
            }
        } catch (JWTException $e) {
            return response()->json(['error' => 'could_not_create_token'], 500);
        }

        return response()->json( compact('token') );
    }

    

    public function getAuthenticatedUser()
    {
        try {
            if (! $user = JWTAuth::parseToken()->authenticate()) {
                return response()->json(['user_not_found'], 404);
            }
        } catch (Tymon\JWTAuth\Exceptions\TokenExpiredException $e) {
            return response()->json(['token_expired'], $e->getStatusCode());
        } catch (Tymon\JWTAuth\Exceptions\TokenInvalidException $e) {
            return response()->json(['token_invalid'], $e->getStatusCode());
        } catch (Tymon\JWTAuth\Exceptions\JWTException $e) {
            return response()->json(['token_absent'], $e->getStatusCode());
        }
        return response()->json(compact('user'));
    }
    

    public function checkemail(Request $request)
    {
        $email = $request->get('email');
        $emailcheck = User::where('email',$email)->count();               
        if($emailcheck > 0)
        {        
            return response()->json(['False'], 400);
        }
        else
        {
            return response()->json(['True'], 400);
        }       
    
    }
}
