<?php

namespace App\Http\Controllers\Common;

use App\Http\Controllers\Controller;
use App\Models\Auth\CmsRole;
use App\Models\Auth\CmsPermission;
use Illuminate\Support\Arr;
use Illuminate\Http\Request;
use App\Http\Requests\AddRoleRequest;
use App\Http\Requests\EditRoleRequest;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Carbon;

class RoleController extends Controller
{
    public function list(CmsRole $cmsRoleModel)
    {
        $roleId = Auth::user()->roles[0]->id;
        if($roleId == 1){
            $roles = $cmsRoleModel->orderBy('updated_at', 'desc')->paginate(10);
        }else{
            $roles = $cmsRoleModel->where('id','!=',1)->orderBy('updated_at', 'desc')->paginate(10);
        }
        return view('roles.list', ['roles' => $roles]);
    }

    public function add(CmsPermission $permissionModel)
    {
        $permissionDatas = $permissionModel->where('is_active', '=', true)
                            ->get()->toArray();
        $groupedData = array();
            foreach($permissionDatas as $value) {
                $slugName = explode('.', $value['name']);
                array_push($groupedData, $slugName[1]);
            }
            $permissions = array();
            $routeName = array_unique($groupedData);
            foreach($routeName as $key => $value) {
                foreach($permissionDatas as $permission) {
                    $slugNames = explode(".", $permission['name']);
                    if($value == $slugNames[1]){
                        $permissions[$value][] = $permission;
                    }
                }
            }
           
        return view('roles.add', ['permissions' => $permissions]);
    }

    public function save(AddRoleRequest $request, CmsRole $cmsRoleModel)
    {
        $role = $cmsRoleModel->create([
            'name' => $request->name,
            'slug' => $request->slug,
            'description' => $request->description,
            'is_active' => true
        ]);
        if(empty($role->id) == false){
            $role->permissions()->attach($request->permissions);
            return redirect()->route('cms.roles.list')->with('success', 'Roles has been created successfully.');
        }
        return redirect()->back()->with('error', 'Roles creation has been failed.');
    }

    public function edit($slug, Request $request, CmsRole $cmsRoleModel, CmsPermission $cmsPermissionModel)
    {
        $role = $cmsRoleModel->where('slug', '=', $slug)->firstOrFail();
        $permissions = $cmsPermissionModel->where('is_active', '=', true)->get();
        $groupedData = array();
        foreach($permissions as $value) {
            $menuName = explode('.', $value['name']);
            array_push($groupedData, $menuName[1]);
        }
        $permissionDatas = array();
        $routeName = array_unique($groupedData);
        foreach($routeName as $key => $value) {
            foreach($permissions as $permission) {
                $slugNames = explode('.', $permission['name']);
                if($value == $slugNames[1]){
                    $permissionDatas[$value][] = $permission;
                }
            }
        }
        $seletedPermissions = $role->permissions->pluck('id')->toArray();
        $seletedGroupNames = $role->permissions->pluck('name')->toArray();
        $selectedGroupedData = array();
        foreach($seletedGroupNames as $value) {
            $menuName = explode('.', $value);
            array_push($selectedGroupedData, $menuName[1]);
        }
        $selectRouterouteName = array_unique($selectedGroupedData);
        return view('roles.edit', [
            'role' => $role, 'permissions' => $permissionDatas, 'seletedPermissions' => $seletedPermissions, 'selectRouterouteName' => $selectRouterouteName
        ]);
    }

    public function update($slug, EditRoleRequest $request, CmsRole $cmsRoleModel)
    {
        $role = $cmsRoleModel->find($request->id);
        $role->name = $request->name;
        $role->description = $request->description;
        $role->slug = $request->slug;
        $role->updated_at = Carbon::now();
        if($role->save()){
            $role->permissions()->sync($request->permissions);
            return redirect()->route('cms.roles.list')->with('success', 'Roles has been updated successfully.');
        }
        return redirect()->back()->with('error', 'Roles updation has been failed.');
    }

    public function delete($slug, Request $request, CmsRole $cmsRoleModel)
    {
        $role = $cmsRoleModel->where('slug', '=', $slug)->firstOrFail();
        if($role->delete()){
            $role->permissions()->detach();
            return redirect()->route('cms.roles.list')->with('success', 'Roles has been deleted successfully.');
        }
        return redirect()->back()->with('error', 'Roles deletion has been failed.');
    }

    public function search(Request $request, CmsRole $cmsRoleModel)
    {
        $query = $request->all();
        unset($query['_token']);
        $roles = $cmsRoleModel->orWhere('name', 'like', '%'.$request->get('q').'%')
                        ->orderBy('updated_at', 'desc')
                        ->paginate(10)
                        ->setPath('')
                        ->appends($query);
        return view('roles.list', ['roles' => $roles])->withQuery(Arr::query($query));    
    }

    public function status($slug, $type, CmsRole $cmsRoleModel)
    {
        $role = $cmsRoleModel->where('slug', '=', $slug)->firstOrFail();
        if($type == 'active'){
            $role->is_active = true;
            $role->updated_at = Carbon::now();
            $role->save();
            return redirect()->route('cms.roles.list')->with('success', 'Role has been activated successfully.');
        }
        if($type == 'inactive'){
            $role->is_active = false;
            $role->updated_at = Carbon::now();
            $role->save();
            return redirect()->route('cms.roles.list')->with('success', 'Permission has been disabled successfully.');
        }
        return redirect()->route('cms.roles.list')->with('error', 'Oops! Permission status change has been failed. Try again later.');
    }
}
