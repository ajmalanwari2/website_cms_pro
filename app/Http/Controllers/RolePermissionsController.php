<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;


class RolePermissionsController extends Controller
{
    // list all role
    public function roleList(Request $request)
    {

        $page_title = __('global.page_title.roles');
        $item = __('rolePermission.role.addRoute');
        $pagination = $request->pagination_searh_name != '' ? $request->pagination_searh_name : 25;

        $permissions = Permission::paginate($pagination);
        if ($request->ajax()) {
            $search = $request->input('search');
            $roles = Role::where('name', 'like', '%' . $request->input('search') . '%')
                ->orderBy('created_at', 'desc')
                ->paginate($pagination);
            return view('settings.rolePermission.role.list', compact('roles', 'permissions', 'search', 'page_title', 'item'));
        } else {
            $search = "";
            $roles = Role::orderBy('created_at', 'desc')->paginate($pagination);
            return view('settings.rolePermission.role.index', compact('roles', 'permissions', 'search', 'page_title', 'item'));
        }
    }
    // open add and edit role modal
    public function roleModal(Request $request)
    {
        $modalId      = $request->input('modalRowID');
        $resourcePath = $request->input('resourcePath'); // e.g. "settings.rolePermission.role"
        $permissions  = Permission::get();
        $roles        = null;

        if ($modalId == 0) {
            // Use concatenation for dynamic view path
            return view($resourcePath . '.add', compact('permissions'));
        } else {
            $roles = Role::find($modalId);
            return view($resourcePath . '.edit', compact('roles', 'permissions'));
        }
    }

    // add new role
    function storeRole(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'role' => 'required',
        ], [
            'role.required' => 'Role is required.',
        ]);

        if ($validator->fails()) {
            session()->flash('error', __('global.operation_field'));
            return redirect()->back()->withInput();
        }

        try {
            DB::beginTransaction();

            $newRole = Role::create(['name' => $request->input('role')]);
            $newRole->givePermissionTo([
                $request->input('permission')
            ]);

            DB::commit();

            session()->flash('success', __('global.operation_success'));
            return redirect(route('roles'));
        } catch (\Exception $e) {
            DB::rollback();
            session()->flash('error', __('global.operation_field') . ": " . $e->getMessage());
            return redirect(route('roles'));
        }
    }
    // add new role
    function updateRole(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'role' => 'required',
            'permission' => 'required'
        ], [
            'role.required' => 'Role is required.',
            'permission.required' => 'Permission is required.',
        ]);

        if ($validator->fails()) {
            session()->flash('error', __('global.operation_field'));
            return redirect()->back()->withInput();
        }

        try {
            DB::beginTransaction();
            // dd($request->all());
            $role = Role::find($request->input('role_id'));
            $role->name = $request->input('role');
            $role->save();

            $role->syncPermissions($request->input('permission'));

            DB::commit();

            session()->flash('success', __('global.operation_success'));
            return redirect(route('roles'));
        } catch (\Exception $e) {
            DB::rollback();
            session()->flash('error', __('global.operation_field') . ": " . $e->getMessage());
            return redirect(route('roles'));
        }
    }
    // Delete role
    public function deleteRole(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'roleID' => 'required',
        ], [
            'roleID.required' => 'Role is required.',
        ]);

        if ($validator->fails()) {
            return response()->json(['error' => __('global.operation_field')], 422);
        }

        try {
            DB::beginTransaction();

            $role = Role::find($request->input('roleID'));
            if (!$role) {
                return response()->json(['error' => 'Role not found'], 404);
            }

            // Detach all permissions from the role
            $role->syncPermissions([]);

            // Delete the role
            $role->delete();

            DB::commit();

            return response()->json(['success' => __('global.operation_success')]);
        } catch (\Exception $e) {
            DB::rollback();
            return response()->json(['error' => __('global.operation_field') . ": " . $e->getMessage()], 500);
        }
    }
    // list all permission
    public function permissionList(Request $request)
    {

        $page_title = __('global.page_title.permissions');
        $item = __('rolePermission.permission.addRoute');
        $pagination = $request->pagination_searh_name != '' ? $request->pagination_searh_name : 25;

        $roles = Role::get();

        if ($request->ajax()) {
            $search = $request->input('search');
            $permissions = Permission::where('name', 'like', '%' . $request->input('search') . '%')
                ->orderBy('created_at', 'desc')
                ->paginate($pagination);
            return view('settings/rolePermission.permission.list', compact('roles', 'permissions', 'search', 'page_title', 'item'));
        } else {
            $search = "";
            $search = $request->input('search');
            $permissions = Permission::orderBy('created_at', 'desc')->paginate($pagination);
            return view('settings/rolePermission.permission.index', compact('roles', 'permissions', 'search', 'page_title', 'item'));
        }
    }
    // open add and edit permission modal
    function permissionModal(Request $request)
    {
        $modalId   = $request->input('modalRowID');
        $resourcePath = $request->input('resourcePath');

        $permissions = Permission::get();
        $roles = Role::get();
        if ($modalId == 0) {
            // Use concatenation for dynamic view path
            return view($resourcePath . '.add', compact('roles'));
        } else {
            $permissions = Permission::find($modalId);
            return view($resourcePath . '.edit', compact('roles', 'permissions'));
        }
    }

    // add new permission
    function storePermission(Request $request)
    {
        // Validate the input data
        $validator = Validator::make($request->all(), [
            'permission' => 'required'
        ], [
            'permission.required' => 'Permission is required.',
        ]);

        // If the validation fails, flash an error message and redirect back with the input
        if ($validator->fails()) {
            session()->flash('error', __('global.operation_field'));
            return redirect()->back()->withInput();
        }

        try {
            // Begin a database transaction
            DB::beginTransaction();

            // Create a new permission
            $newPermission = Permission::create(['name' => $request->input('permission')]);

            // If a role is specified, assign the new permission to that role
            $role = $request->input('role');
            if ($role != 0) {
                $role = Role::find($role)->first();
                $role->givePermissionTo($newPermission);
            }

            // Commit the transaction
            DB::commit();

            // Flash a success message and redirect to the permission route
            session()->flash('success', __('global.operation_success'));
            return redirect(route('permission'));
        } catch (\Exception $e) {
            // If an exception occurs, roll back the transaction and flash an error message
            DB::rollback();
            session()->flash('error', __('global.operation_field') . ": " . $e->getMessage());
            return redirect(route('permission'));
        }
    }
    // add new permission
    function updatePermission(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'permissionName' => 'required'
        ], [
            'permissionName.required' => 'Permission is required.',
        ]);

        if ($validator->fails()) {
            return response()->json(['error' => __('global.operation_success')]);
        }

        try {
            DB::beginTransaction();

            $permission = Permission::find($request->input('permissionID'));
            $permission->name = $request->input('permissionName');
            $permission->save();

            DB::commit();
            return response()->json(['success' => __('global.operation_success')]);
        } catch (\Exception $e) {
            DB::rollback();
            return response()->json(['error' => __('global.operation_success')]);
        }
    }
    // Delete permission
    public function deletePermission(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'pid' => 'required',
        ], [
            'pid.required' => 'Role is required.',
        ]);

        if ($validator->fails()) {
            return response()->json(['error' => __('global.operation_field')], 422);
        }

        try {
            DB::beginTransaction();

            $Permission = Permission::find($request->input('pid'));
            if (!$Permission) {
                return response()->json(['error' => 'Permission not found'], 404);
            }

            // Delete the Permission
            $Permission->delete();

            DB::commit();

            return response()->json(['success' => __('global.operation_success')]);
        } catch (\Exception $e) {
            DB::rollback();
            return response()->json(['error' => __('global.operation_field') . ": " . $e->getMessage()], 500);
        }
    }
}
