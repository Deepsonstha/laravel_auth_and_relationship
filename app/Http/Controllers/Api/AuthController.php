<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\LoginRequest;
use App\Http\Requests\RegisterRequest;
use App\Http\Resources\AuthResource;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class AuthController extends Controller
{
    //! get all user

    public function getAllUser()
    {
        $users = User::all();
        return AuthResource::collection($users);
    }
    //! register
    public function register(RegisterRequest $request)
    {
        DB::beginTransaction();
        try {

            $user = User::create($request->validated());
            DB::commit();
            return responseSuccessMsg("Successfully Registered", 200);

        } catch (\Exception $th) {
            log($th->getMessage());
            DB::rollBack();
            return responseError($th->getMessage(), 400);

        }

    }

    //! login
    public function login(LoginRequest $request)
    {

        // $userOnly = $request->only('email', 'password');
        // if (auth()->attempt($userOnly)) {
        //     $user = auth()->user();
        //     $token = $user->createToken('Token Name')->accessToken;

        //     $data = [
        //         'user' => $user,
        //         'token' => $token,
        //     ];
        //     return responseSuccess(
        //         $data, "Successfully logging in", 200
        //     );
        // } else {
        //     return responseError("Invalid Credentials", 400);
        // }

        DB::beginTransaction();

        if (!User::where('email', $request->email)->exists()) {
            return responseError("Email not found", 400);
        }
        try {
            $userOnly = $request->only('email', 'password');
            if (auth()->attempt($userOnly)) {
                $user = auth()->user();
                $token = $user->createToken('Token Name')->accessToken;

                $data = [
                    'user' => $user,
                    'token' => $token,
                ];
                DB::commit();
                return responseSuccess(
                    $data, "Successfully logging in", 200
                );

            } else {
                return responseError("Invalid Credentials", 400);

            }

        } catch (\Exception $e) {
            DB::rollBack();
            return responseError($e->getMessage(), 500);
        }

    }

    public function getProfile()
    {
        $user = Auth()->user();
        if (!$user) {
            return responseError("User not found", 400);
        }
        return response()->json([
            'data' => $user,
            'message' => "Successfully get user",
        ]);
    }

    public function logout()
    {
        $user = auth()->user()->token()->revoke();
        return responseSuccessMsg("Successfully logged out", 200);
    }
}
