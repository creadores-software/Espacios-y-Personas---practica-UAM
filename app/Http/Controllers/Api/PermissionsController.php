<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class PermissionsController extends Controller
{
    public function createPermissions(){
        $role = Role::create(['name' => 'admin']);
        $permission1 = Permission::create(['name' => 'admin tools']);
        $role->givePermissionTo($permission1);
        $user = User::where("id", 4)->firstOrFail();
        $user->assignRole('admin');
    }

    public function getUserPermissions($id){
        $user = User::where("id", $id)->firstOrFail();
        $roles = $user->getRoleNames();
        return response()->json($roles);
    }
}
