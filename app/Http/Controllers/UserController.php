<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Validation\Rules\Password;

class UserController extends Controller
{
    public  function register(Request $request){
        // validate request
        $request->validate([
            'name' => 'required|string',
            'email' => 'required|email|unique:users',
            'password' => [
                'required',
                Password::min(8)
                    ->uncompromised()
                    ->mixedCase()
                    ->letters()
                    ->numbers()
                    ->symbols()
            ],
            'confirm_password' => 'required|string|same:password',
        ]);

        // create the user
        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password'=> bcrypt($request->password),
            'created_by' => $request->user()->id ?? null,
            'updated_by' => $request->user()->id ?? null,
        ]);

        // check if user was created
        if($user){
            // return with success message
            return response()->json([
                'success' => true,
                'message' => 'User created successfully',
                'data' => $user
            ], 201);
        }else{
            // return with error message
            return response()->json([
                'success' => false,
                'message' => 'User could not be created',
                'data'=> null
            ], 500);
        }
    }
    public function login(Request $request){
        // validate request
        $request->validate([
            'email' => 'required|email',
            'password' => 'required|string'
        ]);

        // check if user exists
        $user = User::where('email', $request->email)->first();
        if(!$user){
            // return with error message
            return response()->json([
                'success' => false,
                'message' => 'Invalid credentials',
                'data' => null
            ], 404);
        }

        // check if password is correct
        if(!password_verify($request->password, $user->password)){
            // return with error message
            return response()->json([
                'success' => false,
                'message' => 'Invalid credentials',
                'data' => null
            ], 404);
        }else{
            // generate token
            $token = $user->createToken('auth_token')->plainTextToken;

            // return with success message
            return response()->json([
                'success' => true,
                'message' => 'User logged in successfully',
                'data' => [
                    'user' => $user,
                    'token' => $token
                ]
            ], 200);
        }
    }

    public function logout(Request $request){
        // check if user is logged in
        if($request->user()){
            // delete user token
            $request->user()->currentAccessToken()->delete();

            // return with success message
            return response()->json([
                'success' => true,
                'message' => 'User logged out successfully',
                'data' => null
            ], 200);
        }else{
            // return with error message
            return response()->json([
                'success' => false,
                'message' => 'No user logged in',
                'data' => null
            ], 404);
        }
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        $user = User::all();

        return response()->json([
            'success' => true,
            'message' => 'User retrieved successfully',
            'data' => $user
        ], 200);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        // get the user
        $user = User::find($id);

        // check if user exists
        if(!$user){
            // return with error message
            return response()->json([
                'success' => false,
                'message' => 'User not found',
                'data' => null
            ], 404);
        }else{
            // return with success message
            return response()->json([
                'success' => true,
                'message' => 'User retrieved successfully',
                'data' => $user
            ], 200);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        // delete the given user
        // check if user exists
        $user = User::find($id);
        if(!$user) {
            // return with error message
            return response()->json([
                'success' => false,
                'message' => 'User not found',
                'data' => null
            ], 404);
        }

        // check if user has any website subscription
        if($user->subscriptions()->whereDate('end_date' > now())->count() > 0){
            // return with error message
            return response()->json([
                'success' => false,
                'message' => 'User has website subscriptions',
                'data' => null
            ], 400);
        }
        // delete the user
        if($user->delete()){
            // return with success message
            return response()->json([
                'success' => true,
                'message' => 'User deleted successfully',
                'data' => null
            ], 200);
        }else{
            // return with error message
            return response()->json([
                'success' => false,
                'message' => 'User could not be deleted',
                'data' => null
            ], 500);
        }
    }
}
