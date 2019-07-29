<?php

namespace App\Http\Controllers;

use App\Http\Resources\RoleResource;
use App\Http\Resources\UserResource;
use App\Notifications\VerifyMail;
use App\User;
use Carbon\Carbon;
use Illuminate\Auth\Events\Verified;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    protected function appUrl()
    {
        return config('app.web_url');
    }

    public function __construct()
    {
        $this->middleware('signed')->only('verify');
        $this->middleware('throttle:6,1')->only('verify', 'resend');
    }

    /**
     *
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     *
     */
    public function login(Request $request)
    {
        $request->validate([
            'email' => 'required|string|email',
            'password' => 'required|string',
            'remember_me' => 'nullable|boolean' // TODO: remember me feature
        ]);

        if(!User::where('email', $request->email)->first()) {
            return response()->json([
                'error' => 'These credentials do not match our records.'
            ], 401);
        }

        if(!User::where('email', $request->email)->first()->hasVerifiedEmail()) {
            return response()->json([
                'error' => 'Email Anda belum diverifikasi.'
            ], 401);
        }


        $credentials = request(['email', 'password']);

        if(!Auth::attempt($credentials)) {
            return response()->json([
                'error' => 'These credentials do not match our records.'
            ], 401);
        }

        $user = $request->user();
        $tokenResult = $user->createToken('Personal Access Token');
        $token = $tokenResult->token;
        $token->save();

        return response()->json([
            'access_token' => $tokenResult->accessToken,
            'expires_at' => Carbon::parse($tokenResult->token->expires_at)->toDateTimeString(),
            'user' => new UserResource($user),
            'roles' => RoleResource::collection($user->roles)
        ]);
    }

    /**
     * Logout user (Revoke the token)
     *
     * @return \Illuminate\Http\JsonResponse
     *
     */
    public function logout(Request $request)
    {
        $request->user()->token()->revoke();

        return response()->json([
            'message' => 'Successfully logged out'
        ]);
    }

    public function register(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email',
            'password' => 'required|string|confirmed',
            'password_confirmation' => 'required|string'
        ]);

        if(User::where('email', $request->email)->first()) {
            return response()->json([
                'message' => 'Email telah terdaftar.'
            ], 401);
        }

        else {
            $user = User::create([
                'name' => $request->name,
                'email' => $request->email,
                'password' => Hash::make($request->password),
                'role_id' => 1
            ]);
            $user->roles()->save(\App\Role::where('id', 1)->first());

            $user->notify(new VerifyMail());

            return response()->json([
                'message' => 'Akun berhasil dibuat.',
                'id' => $user->id
            ]);
        }
    }

    public function verify(Request $request)
    {
        $id = $request->route('id');
        $user = User::findOrFail($id);

        if ($user->hasVerifiedEmail()) {
            return redirect($this->appUrl());
        }

        if ($user->markEmailAsVerified()) {
            event(new Verified($request->user()));
        }
        return redirect($this->appUrl().'/login?verified=1');
    }

    public function resend(Request $request, $id)
    {
        $user = User::findOrFail($id);

        if ($user->hasVerifiedEmail()) {
            return response()->json([
                'message' => 'Email sudah diverifikasi.'
            ], 401);
        }

        $user->notify(new VerifyMail());

        return response()->json(["message" => "ok"]);
    }

    public function getUser(Request $request)
    {
        $user = $request->user();

        return response()->json([
            'user' => new UserResource($user),
            'roles' => RoleResource::collection($user->roles)
        ]);
    }
}
