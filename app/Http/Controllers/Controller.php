<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Support\Facades\Redis;
use Illuminate\Support\Facades\Auth;

class Controller extends BaseController
{
    use AuthorizesRequests, ValidatesRequests;

    public function perPageCount()
    {
        return empty(env('PAGE_COUNT'))===false ? env('PAGE_COUNT') : 10;
    }

    public function getPermissions()
    {
        $cachePermissions = Redis::get('PERMISSIONS:' . Auth::user()->id);
        if (isset($cachePermissions)) {
            $rolePermission = json_decode($cachePermissions, false);
        } else {
            $permissions = Auth::user()->permissions;
            $rolePermission = [];
            if (empty($permissions) === false) {
                foreach ($permissions as $permission) {
                    $rolePermission[] = $permission->slug;
                }
            }
        }
        return $rolePermission;
    }
}
