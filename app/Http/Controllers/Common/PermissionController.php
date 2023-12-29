<?php

namespace App\Http\Controllers\Common;

use App\Http\Controllers\Controller;
use Illuminate\Support\Arr;
use App\Models\Auth\CmsPermission;
use Illuminate\Http\Request;
use Carbon\Carbon;
use Illuminate\Support\Facades\Route;

class PermissionController extends Controller
{
    public function list()
    {
        $permissions = CmsPermission::orderBy('updated_at', 'desc')->paginate(10);
        return view('permissions.list', ['permissions' => $permissions]);
    }

    public function search(Request $request)
    {
        $query = $request->all();
        unset($query['_token']);
        $permissions = CmsPermission::orWhere('name', 'like', '%'.$request->get('q').'%')
                        ->orderBy('updated_at', 'desc')
                        ->paginate(20)
                        ->setPath('')
                        ->appends($query);
        return view('permissions.list', ['permissions' => $permissions])->withQuery(Arr::query($query));    
    }

    public function status($slug, $type)
    {
        $permission = CmsPermission::where('slug', '=', $slug)->firstOrFail();
        if($type == 'active'){
            $permission->is_active = true;
            $permission->updated_at = Carbon::now();
            $permission->save();
            return redirect()->route('cms.permissions.list')->with('success', 'Permission has been activated successfully.');
        } 
        if($type == 'inactive') {
            $permission->is_active = false;
            $permission->updated_at = Carbon::now();
            $permission->save();
            return redirect()->route('cms.permissions.list')->with('success', 'Permission has been disabled successfully.');
        }
        return redirect()->route('cms.permissions.list')->with('error', 'Oops! Permission status change has been failed. Try again later.');
    }

    public function permissionMigration()
    {
        return view('permissions.migration');  
    }

    public function permissionMigrate()
    {
        $routeNames = [];
        foreach (Route::getRoutes()->getRoutes() as $route) {
            $action = $route->getAction();
            if (array_key_exists('as', $action) && strpos($action['as'], 'cms') !== false) {
                $getRoutes = CmsPermission::where('slug', $action['as'])->first();
                if(empty($getRoutes) === true) {
                    $routeNames[] = [
                        'name' => $action['as'],
                        'description' => $action['as'],
                        'slug' => $action['as'],
                        'is_active' => true,
                        'created_at' => Carbon::now(),
                        'updated_at' => Carbon::now()
                    ];
                }
            }
        }
        CmsPermission::insert($routeNames);
        return redirect()->route('cms.permissions.list')->with('success', 'Permission has been migrated successfully.');
    }
}
