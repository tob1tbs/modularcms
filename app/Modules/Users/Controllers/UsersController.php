<?php

namespace App\Modules\Users\Controllers;


use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use App\Modules\Users\Models\User;
use App\Modules\Users\Models\UserRole;
use App\Modules\Users\Models\UserPermissionGroup;

use Auth;

class UsersController extends Controller
{

    public function __construct() {
        
    }

    public function actionLoginIndex(Request $Request) {
        if (view()->exists('users.users_login')) {

            $data = [];

            return view('users.users_login', $data);
        } else {
            abort('404');
        }
    }

    public function actionUsersIndex(Request $Request) {
        if (view()->exists('users.users_index')) {

            $data = [];

            return view('users.users_index', $data);
        } else {
            abort('404');
        }
    }

    public function actionUsersAdd() {
        if (view()->exists('users.users_add')) {

            $data = [];

            return view('users.users_add', $data);
        } else {
            abort('404');
        }
    }

    public function actionUsersEdit(Request $Request) {
        if (view()->exists('users.users_edit')) {

            $data = [];

            return view('users.users_edit', $data);
        } else {
            abort('404');
        }
    }

    public function actionUsersRole(Request $Request) {
        if (view()->exists('users.users_role')) {

            $UserRole = new UserRole();
            $UserRoleList = $UserRole::where('deleted_at_int', '!=', 0)->get();

            $UserPermissionGroup = new UserPermissionGroup();
            $UserPermissionGroupList = $UserPermissionGroup::where('deleted_at_int', '!=', 0)->where('active', 1)->get();

            $data = [
                'user_role_list' => $UserRoleList,
                'user_permission_group_list' => $UserPermissionGroupList,
            ];

            return view('users.users_role', $data);
        } else {
            abort('404');
        }
    }

    public function actionUserLogout() {
        Auth::logout();
        return redirect()->route('actionLoginIndex');
    }
}
