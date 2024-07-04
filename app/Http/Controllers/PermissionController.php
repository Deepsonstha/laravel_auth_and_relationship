<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Spatie\Permission\Models\Permission;

class PermissionController extends Controller
{

    public function getPermission(Request $request)
    {
        $permission = Permission::all();
        return responseSuccess($permission, 'Permission list', 200);
    }
    public function createPermission(Request $request)
    {
        $request->validate([
            'name' => "required|string|unique:permissions,name",
        ]);
        $check = Permission::where('name', $request->name)->first();

        if ($check) {
            return responseError('Permission already exist', 400);
        } else {
            $prmission = Permission::create(
                [
                    'name' => $request->name,
                ]
            );

            return responseSuccess($prmission, 'Permission created successfully', 200);
        }

    }

    public function editPermission(Request $request, $id)
    {
        $permission = Permission::find($id)->first();
        if ($permission) {
            $permission->update([
                'name' => $request->name,
            ]);
            return responseSuccess($permission, 'Permission updated successfully', 200);
        } else {
            return responseError('Permission not found', 400);
        }

    }

    public function deletePermission($id)
    {
        $permission = Permission::find($id)->first();
        if ($permission) {
            $permission->delete();
            return responseSuccessMsg('Permission deleted successfully', 200);
        } else {
            return responseError('Permission not found', 400);
        }
    }

}
