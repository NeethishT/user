<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redis;
use Vinkla\Hashids\Facades\Hashids;

if (!function_exists('encodeId')) {
    function encodeId($id): string
    {
        return Hashids::encode($id);
    }
}

if (!function_exists('decodeId')) {

    function decodeId($id): array
    {
        return Hashids::decode($id);
    }
}

function getPermissions()
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