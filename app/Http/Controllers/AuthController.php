<?php
/**
* @group Authentication
* Authentication Authorization & access token management
*/
namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;

use App\Http\Requests\UserLoginRequest;
use App\Http\Resources\User as UserResource;

class AuthController extends Controller
{
    /**
     * Create a new AuthController instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth:api', ['except' => ['login']]);
    }

    /**
     * user login.
     *
     * @bodyParam email required
     * @bodyParam password required
     * @return  logged in user with access token
     */
    public function login(UserLoginRequest $request)
    {
        if(!$token = Auth::attempt($request->only(['email', 'password']))){
            return abort(401);
        }
        $user = Auth::guard('api')->user();
        return (new UserResource($user))->additional([
            'token' => $token
        ]);
    }

    /**
     * Get the authenticated User.
     *
     * @return \App\Http\Resources\User
     */
    public function user()
    {
    	$user = Auth::guard('api')->user();
    	if($user != null){
        	return new UserResource($user);
    	}else{
    		return abort(401);
    	}
    }

    /**
     * Log the user out (Invalidate the token).
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function logout()
    {
        auth()->logout();

        return response()->json(['message' => 'Successfully logged out']);
    }
}