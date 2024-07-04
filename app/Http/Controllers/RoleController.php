<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;

class RoleController extends Controller
{

    public function getrole(Request $request)
    {
        $role = Role::all();
        return responseSuccess($role, 'role list', 200);
    }
    public function createrole(Request $request)
    {
        $request->validate([
            'name' => "required|string|unique:roles,name",
        ]);
        $check = Role::where('name', $request->name)->first();

        if ($check) {
            return responseError('role already exist', 400);
        } else {
            $prmission = Role::create(
                [
                    'name' => $request->name,
                ]
            );

            return responseSuccess($prmission, 'role created successfully', 200);
        }

    }

    public function editrole(Request $request, $id)
    {
        $role = Role::find($id);
        if ($role) {
            $role->update([
                'name' => $request->name,
            ]);
            return responseSuccess($role, 'role updated successfully', 200);
        } else {
            return responseError('role not found', 400);
        }

    }

    public function deleterole($id)
    {
        $role = Role::find($id);
        if ($role) {
            $role->delete();
            return responseSuccessMsg('role deleted successfully', 200);
        } else {
            return responseError('role not found', 400);
        }
    }

}
