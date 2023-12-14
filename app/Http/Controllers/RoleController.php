<?php

namespace App\Http\Controllers;

use App\Models\Role;
use Illuminate\Http\Request;

class RoleController extends Controller
{
    //

    public function getRole($id){
        $role = Role::find($id);
        return response()->json($role);
    }
}
