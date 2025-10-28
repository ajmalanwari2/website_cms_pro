<?php

namespace App\Http\Controllers;

use App\Models\Employee;
use App\Models\students\Student;
use App\Models\Teacher;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Spatie\Permission\Models\Role;

class UserController extends Controller
{
    // list all user
    public function index(Request $request)
    {

        $page_title = __('global.page_title.users');
        $item = __('global.user');
        $pagination = $request->pagination_searh_name != '' ? $request->pagination_searh_name : 25;

        $allUsers = User::paginate($pagination);
        $allRole = DB::table('roles')->select('id', 'name')->get();

        if ($request->ajax()) {
            return view('settings/user.list', compact('allUsers', 'allRole', 'page_title', 'item'));
        } else {
            return view('settings/user.index', compact('allUsers', 'allRole', 'page_title', 'item'));
        }
    }

    // view user
    public function view($id)
    {
        $page_title = __('global.page_title.user');
        $item = __('global.page_item.user');
        $lang = app()->getLocale();
        $users = User::where('id', decryption($id))->first();
        $userRoles = User::find(decryption($id))->roles()->pluck('id'); // Assuming $userId is the ID of the user
        $availableRoles = Role::whereNotIn('id', $userRoles)->get();
        return view('settings/user.view', compact('page_title', 'lang', 'availableRoles', 'users', 'page_title', 'item'));
    }

    // add new role to user
    function storeRole(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'role' => 'required|not_in:0',
        ], [
            'role.required' => 'Role is required.',
        ]);

        if ($validator->fails()) {
            session()->flash('error', __('global.operation_field'));
            return redirect()->back();
        }

        try {
            DB::beginTransaction();

            $userId = decryption($request->input('userid'));
            $user = User::find($userId);

            if (!$user) {
                throw new \Exception("User not found.");
            }

            $user->assignRole($request->input('role'));

            DB::commit();

            session()->flash('success', __('global.operation_success'));
            return redirect(route('user.view', ['id' => $request->input('userid')]));
        } catch (\Exception $e) {
            DB::rollback();
            return response()->json(['error' => __('global.operation_failed') . ": " . $e->getMessage()]);
        }
    }

    // remove role from user
    public function deleteUserRole($uid, $rid)
    {
        try {
            DB::beginTransaction();

            $user = User::findOrFail($uid);

            $role = Role::findOrFail($rid);

            $user->removeRole($role->name);
            DB::commit();
            session()->flash('success', __('global.operation_success'));
            return response()->json([
                'success' => __('global.operation_success')
            ]);
        } catch (\Exception $e) {
            DB::rollBack();
            session()->flash('error', __('global.operation_failed'));
            return response()->json([
                'errors' => __('global.operation_failed') . ": " . $e->getMessage()
            ], 500);
        }
    }
}
