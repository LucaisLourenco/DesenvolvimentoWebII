<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Permission;

class PermissionController extends Controller
{
    public static function loadPermissions($user_type) {
        
        $access = Array();

        $permissoes = Permission::where('type_id', $user_type)->get();

        foreach($permissoes as $item) {
            $access[$item->regra] = (boolean) $item->permissao;
        }

        session(['user_permissions' => $access]);
    }

    public static function isAutorized($rule) {
        
        $permissoes = session('user_permissions');

        return $permissoes[$rule];
    }
}
