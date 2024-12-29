<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Tymon\JWTAuth\Facades\JWTAuth;
use Tymon\JWTAuth\Exceptions\JWTException;

class AuthController extends Controller
{
     // User registration
     public function register(Request $request)
     {
         $validator = Validator::make($request->all(), [
            'first_name' => 'required|string|max:255',
            'last_name' => 'required|string|max:255',
            'location' => 'required|string|max:255',
            'image' => 'required|image|mimes:jpeg,png,jpg,svg',
            'phone' => 'required|string|max:12|unique:users,phone',
            'password' => 'required|string|min:6|confirmed',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'error' => true,
                'messages' => $validator->errors()->all(),
            ], 400);
        }

         $user = User::create($request->all());

         $token = JWTAuth::fromUser($user);

         return response()->json(compact('user','token'), 201);
     }

     // User login
     public function login(Request $request)
     {
         $credentials = $request->only('phone', 'password');

         try {
             if (! $token = JWTAuth::attempt($credentials)) {
                 return response()->json(['error' => 'Invalid credentials'], 401);
             }

             // Get the authenticated user.
             $user = auth()->user();

             // (optional) Attach the role to the token.
             $token = JWTAuth::claims(['role' => $user->role])->fromUser($user);

             return response()->json(compact('token'));
         } catch (JWTException $e) {
             return response()->json(['error' => 'Could not create token'], 500);
         }
     }

     // Get authenticated user
     public function getUser()
     {
         try {
             if (! $user = JWTAuth::parseToken()->authenticate()) {
                 return response()->json(['error' => 'User not found'], 404);
             }
         } catch (JWTException $e) {
             return response()->json(['error' => 'Invalid token'], 400);
         }

         return response()->json(compact('user'));
     }

     // User logout
     public function logout()
     {
         JWTAuth::invalidate(JWTAuth::getToken());

         return response()->json(['message' => 'Successfully logged out']);
     }
}
