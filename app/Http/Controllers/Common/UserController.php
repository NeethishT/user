<?php

namespace App\Http\Controllers\Common;

use App\Http\Controllers\Controller;
use App\Http\Requests\AddUserRequest;
use App\Http\Requests\EditUserRequest;
use Illuminate\Http\Request;
use App\Models\Auth\CmsUser;
use App\Models\Auth\CmsRole;
use App\Models\Auth\CmsUserLogin;
use Illuminate\Support\Facades\Auth;
use App\Models\Auth\CmsUserRole;
use App\Utils\CommonUtils;
use Illuminate\Support\Arr;

class UserController extends Controller
{
    use CommonUtils;
    public function list(Request $request)
    {
        $roleId = Auth::user()->roles[0]->id;
        if($roleId == 1){
            $users      = CmsUser::with(['roles'])->orderBy('updated_at', 'desc')->paginate($this->perPageCount());
        } else {
            $cmsUserIds = CmsUserRole::where('cms_role_id','!=',1)->get('cms_user_id');
            $users      = CmsUser::with(['roles' => function($query){
                            $query->where('cms_role_id', '!=', 1);
                        }])->whereIn('id',$cmsUserIds)->orderBy('updated_at', 'desc')->paginate($this->perPageCount());
        }
        return view('users.list', compact('users'));
    }

    public function add(Request $request, CmsRole $cmsRoleModel)
    {
        $roleId = Auth::user()->roles[0]->id;
        if($roleId == 1){
            $roles = $cmsRoleModel->where('is_active', '=', true)->get();
        }else{
            $roles = $cmsRoleModel->where('is_active', '=', true)->where('id','!=',1)->get();
        }
        return view('users.add', ['roles' => $roles]);
    }

    public function save(AddUserRequest $request, CmsUser $cmsUserModel)
    {
        $user = $cmsUserModel->create([
            'name' => $request->name,
            'username' => $request->username,
            'email' => $request->email,
            'password' => bcrypt($request->password),
            'is_active' => true,
            'token' => $this->generateUUID()
        ]);
        if(empty($user->id) === false){
            $user->roles()->attach($request->roles);
            return redirect()->route('cms.users.list')->with('success', 'User has been created successfully.');
        }

        return redirect()->back()->with('error', 'User creation has been failed.');
    }

    public function edit($token)
    {
        $user = CmsUser::where('token', '=', $token)->firstOrFail();
        $selectedRoles = $user->roles()->pluck('cms_role_id')->toArray();
        $roleId = Auth::user()->roles[0]->id;
        if($roleId == 1){
            $roles = CmsRole::where('is_active', '=', true)->get();
        }else{
            $roles = CmsRole::where('is_active', '=', true)->where('id','!=',1)->get();
        }
        return view('users.edit', ['user' => $user, 'selectedRoles' => $selectedRoles, 'roles' => $roles]);
    }

    public function update($token, EditUserRequest $request)
    {
        $user = CmsUser::find($request->id);
        $user->name = $request->name;
        $user->username = $request->username;
        $user->email = $request->email;
        $user->password = bcrypt($request->password);
        if($user->save()){
            $user->roles()->sync($request->roles);
            return redirect()->route('cms.users.list')->with('success', 'User has been updated successfully.');
        }
        return redirect()->back()->with('error', 'User updation has been failed.');
    }

    public function delete($token, Request $request)
    {

    }

    public function search(Request $request)
    {
        $query = $request->all();
        unset($query['_token']);
        $users = CmsUser::orWhere('name', 'like', '%'.$request->get('q').'%')
                        ->orderBy('updated_at', 'desc')
                        ->paginate(10)
                        ->setPath('')
                        ->appends($query);

        return view('users.list', ['users' => $users])->withQuery(Arr::query($query));
    }

    public function status($token, $type, Request $request)
    {
        $user = CmsUser::where('token', '=', $token)->firstOrFail();
        if($type == 'active'){
            $user->is_active = true;
            $user->save();
            return redirect()->route('cms.users.list')->with('success', 'User has been activated successfully.');
        }
        if($type == 'inactive'){
            $user->is_active = false;
            $user->save();
            return redirect()->route('cms.users.list')->with('success', 'User has been disabled successfully.');
        }
        return redirect()->route('cms.users.list')->with('error', 'Oops! User status change has been failed. Try again later.');
    }

    public function loginLogs($token)
    {
        $user = CmsUser::where('token', '=', $token)->firstOrFail();
        $userLogins = CmsUserLogin::where('cms_user_id', '=', $user->id)->orderBy('updated_at', 'desc')->paginate(20);
        return view('users.logins', ['user' => $user, 'userLogins' => $userLogins]);
    }
    
}