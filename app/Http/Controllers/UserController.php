<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{

    public function getSingleUserWithRoles($id)
    {
        $user = User::find($id);
        if ($user) {
            $data = [
                'user' => $user,
                'roles' => $user->roles()->pluck('name'),
            ];
            return responseSuccess(
                [
                    'user' => $data,
                    // 'roles' => $user->roles()->pluck('name'),
                ],

                'User retrieved successfully'

            );

        } else {
            return responseError('User not found', 404);
        }

    }

    public function checkfuntion()
    {
        /** @var User $user */
        $user = User::find(1);
        // $user = new User;

        if ($user) {
            // $roles = $user->roles()->pluck('name');
            $roles = $user->getRoleNames();

            return responseSuccess($roles, 'User retrieved successfully', 200);
        } else {

        }

    }

    public function createUser(Request $request)
    {
        $request->validate([
            'name' => 'required|string',
            'email' => 'required|string|email|unique:users,email',
            'password' => 'required|string', // corrected validation rule for password
            'roles' => 'required|array', // corrected validation rule for roles
        ]);

        $user = User::create([
            "name" => $request->name,
            "email" => $request->email,
            "password" => Hash::make($request->password),
        ]);

        $user->syncRoles($request->roles); // corrected variable name to match validation rule

        $userRoles = $user->roles()->pluck('name');

        // Prepare the response data
        $responseData = [
            'user' => $user,
            'roles' => $userRoles,
            'message' => 'User created successfully',
        ];

        return responseSuccess($responseData, 'user created successfully', 200);
    }

}
