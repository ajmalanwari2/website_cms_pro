<?php

namespace App\Http\Controllers;

use App\Models\Employee;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;
use Spatie\Permission\Models\Role;

class EmployeeController extends Controller
{
    public function index(Request $request)
    {
        $page_title = __('global.page_title.employees');
        $item = __('global.page_item.employees');
        $searchInput = $request->search_term;
        $status = $request->status_search;
        $pagination = $request->pagination ? $request->pagination : 25;

        $page_title = __('global.page_title.employees');
        $item = __('global.page_item.employee');

        $allEmployees = Employee::when(!empty($searchInput), function ($q) use ($searchInput) {
            $q->where('name', 'LIKE', '%' . $searchInput . '%')
                ->orWhere('father_name', 'LIKE', '%' . $searchInput . '%')
                ->orWhere('last_name', 'LIKE', '%' . $searchInput . '%')
                ->orWhere('id_number', 'LIKE', '%' . $searchInput . '%')
                ->orWhere('designation', 'LIKE', '%' . $searchInput . '%')
                ->orWhere('phone', 'LIKE', '%' . $searchInput . '%')
                ->orWhere('email', 'LIKE', '%' . $searchInput . '%')
                ->orWhere('salary', 'LIKE', '%' . $searchInput . '%');
        })
            ->when(!empty($status), function ($q) use ($status) {
                $q->where('status', $status);
            })
            ->orderBy('created_at', 'desc')
            ->paginate($pagination);

        if ($request->ajax()) {
            return view('employee.list', compact('allEmployees', 'page_title', 'item'))->render();
        } else {
            return view('employee.index', compact('allEmployees', 'page_title', 'item'))->render();
        }
    }

    public function employeeModal(Request $request)
    {
        $modalId      = $request->input('modalRowID');
        $resourcePath = $request->input('resourcePath');
        $employee =  Employee::find($modalId);
        $designations = config('list.employee_designation');
        if ($modalId == 0) {
            // Use concatenation for dynamic view path
            return view($resourcePath . '.add', compact('designations'));
        } else {
            return view($resourcePath . '.edit', compact('employee', 'designations'));
        }
    }

    public function store(Request $request)
    {
        //
        $prefix = 'ID';
        $employee_name = $request->r_employee_first_name;
        $employee_father_name = $request->employee_father_name;
        $employee_last_name = $request->r_employee_last_name;
        $employee_email = $request->employee_email;
        $employee_phone = $request->employee_phone;
        $employee_designation = $request->r_employee_designation ? $request->r_employee_designation : null;
        $employee_salary = $request->employee_salary;
        $employee_status = $request->r_add_employee_statuss;

        $latestID = Employee::withTrashed()->max('id_number');

        if ($latestID != '') {
            $latestIdNumber = $latestID;
            $latestNumber = intval(substr($latestIdNumber, -4));
            $nextNumber = $latestNumber + 1;
        } else {
            $nextNumber = 0001;
        }
        $employee_id_number = $prefix . str_pad($nextNumber, 4, '0', STR_PAD_LEFT);

        $fileName = null;

        $file = $request->file('image');
        if ($file) {
            $fileName = time() . '_' . $file->getClientOriginalName();

            // Use DIRECTORY_SEPARATOR for Windows/Linux compatibility
            $relativeFolder = 'public' . DIRECTORY_SEPARATOR . 'attachment' . DIRECTORY_SEPARATOR . 'employee' . DIRECTORY_SEPARATOR . 'image';
            $fullFolder = storage_path('app' . DIRECTORY_SEPARATOR . $relativeFolder);

            // Create directory if it doesn't exist
            if (!is_dir($fullFolder)) {
                mkdir($fullFolder, 0775, true); // recursive = true
            }

            try {
                $file->move($fullFolder, $fileName);
            } catch (\Exception $e) {
                return response()->json([
                    'status' => 'error',
                    'message' => 'File upload failed: ' . $e->getMessage()
                ], 422);
            }
        } else {
            Log::warning('No file uploaded.');
        }

        // Check duplicate
        $checkForDuplicate = Employee::where('name', $employee_name)
            ->where('email', $employee_email)
            ->first();

        if ($checkForDuplicate) {
            return response()->json([
                "status" => "error",
                "message" => __('global.duplicate_not_allowed')
            ]);
        }

        DB::beginTransaction();
        try {

            $newUserData = array(
                'name' => $employee_name . $employee_last_name,
                'email' => $employee_email,
                'status' => 'active',
                'type' => $employee_designation,
                'photo' => $fileName,
                'password' => Hash::make('123456'),
                'lang' => 'en',
                'created_by' => Auth::user()->id,
                'created_at' => Carbon::now()
            );

            $insertUser = User::create($newUserData);

            if ($insertUser) {

                $userRole = Role::findByName(ucfirst($employee_designation));

                $insertUser->assignRole($userRole);

                $data = [
                    'name' => $employee_name,
                    'father_name' => $employee_father_name,
                    'last_name' => $employee_last_name,
                    'id_number' => $employee_id_number,
                    'email' => $employee_email,
                    'phone' => $employee_phone,
                    'designation' => $employee_designation,
                    'salary' => $employee_salary,
                    'status' => $employee_status,
                    'account_user_id' => $insertUser->id,
                    'image' => $fileName,
                    'created_by' => Auth::user()->id,
                    'created_at' => Carbon::now()
                ];

                Employee::create($data);
                DB::commit();

                return response()->json(['status' => 'success', 'message' => __('global.operation_succeed')]);
            }
        } catch (\Exception $e) {
            DB::rollback();
            return response()->json([
                "status" => "error",
                "message" => "Exception in Driver Create: " . $e->getMessage()
            ], 422);
        }
    }

    //view employee information
    public function view(Request $request, $enid)
    {
        $id = decryption($enid);

        $page_title = __('global.page_title.view_employee');
        $item = __('global.page_item.view_employee');

        $lang = app()->getLocale();

        $managers = Employee::orderBy('created_at', 'desc')->where('id', '!=', $id)->get();

        $employee = Employee::with('user', 'department')
            ->where('id', $id)
            ->first();

        if ($employee != '') {
            return view('setting.employee.view', compact('employee', 'managers', 'lang', 'page_title', 'item'));
        } else {
            return "Not Found";
        }
    }

    public function enableDisableEmployee(Request $request)
    {
        $employeeId = $request->id;
        $employeeStatus = $request->status;

        $checkEmployeeExist = Employee::where("id", $employeeId)->first();
        $updateStatus = $employeeStatus == 'active' ? 'inactive' : 'active';

        if ($checkEmployeeExist != '') {
            $checkEmployeeExist->where('id', $employeeId)->where('status', $employeeStatus)
                ->update(
                    [
                        'status' => $updateStatus,
                        'updated_by' => Auth::user()->id,
                        'updated_at' => Carbon::now()
                    ]
                );
            if ($checkEmployeeExist) {
                $updateDriverUser = User::find($checkEmployeeExist->account_user_id);
                $updateDriverUser->update([
                    'status' => $updateStatus,
                    'updated_at' => Carbon::now()
                ]);
                return response()->json(['status' => 'success', 'message' => __('global.operation_succeed'), 'updateStatus' => $updateStatus]);
            } else {
                return response()->json(['status' => 'failed', 'message' => __('global.operation_failed')]);
            }
        } else {
            return response()->json(['status' => 'failed', 'message' =>  __('global.item_not_found')]);
        }
    }

    public function update(Request $request)
    {
        $id = $request->employee_id;
        $employeeExist = Employee::find($id);

        if (!$employeeExist) {
            return response()->json([
                "status"  => "error",
                "message" => "Employee not found"
            ], 404);
        }

        $employee_name = $request->r_employee_first_name;
        $employee_father_name = $request->employee_father_name;
        $employee_last_name = $request->r_employee_last_name;
        $employee_email = $request->employee_email;
        $employee_phone = $request->employee_phone;
        $employee_designation = $request->r_employee_designation ? $request->r_employee_designation : null;
        $employee_salary = $request->employee_salary;
        $employee_status = $request->r_add_employee_statuss;

        $fileName = $employeeExist->image ?? null;

        // ✅ Detect uploaded file (support edit_image, r_edit_image, image)
        $fileInput = collect(['edit_image', 'r_edit_image', 'image'])
            ->first(fn($field) => $request->hasFile($field));

        if ($fileInput) {
            $request->validate([
                $fileInput => 'image|mimes:jpeg,png,jpg,gif|max:2048',
            ]);

            // Delete old file if it exists
            if ($employeeExist->image) {
                $oldPath = storage_path('app/public/attachment/employee/image/' . $employeeExist->image);
                if (file_exists($oldPath)) {
                    @unlink($oldPath);
                }
            }

            $file = $request->file($fileInput);
            $fileName = time() . '_' . $file->getClientOriginalName();

            $relativeFolder = 'public' . DIRECTORY_SEPARATOR . 'attachment' . DIRECTORY_SEPARATOR . 'employee' . DIRECTORY_SEPARATOR . 'image';
            $fullFolder = storage_path('app' . DIRECTORY_SEPARATOR . $relativeFolder);

            if (!is_dir($fullFolder)) {
                mkdir($fullFolder, 0775, true);
            }

            $file->move($fullFolder, $fileName);
        }

        // Duplicate check
        $checkForDuplicate = Employee::where('id', '!=', $employeeExist->id)
            ->where('name', $employee_name)
            ->where('email', $employee_email)
            ->first();

        if ($checkForDuplicate) {
            return response()->json([
                "status"  => "error",
                "message" => __('global.duplicate_not_allowed')
            ]);
        }

        DB::beginTransaction();
        try {

            $newUserData = [
                'name'   => $employee_name . ' ' . $employee_last_name,
                'email'  => $employee_email,
                'status' => $employee_status,
                'photo'  => $fileName,
            ];

            // update the related user
            $updateUser = $employeeExist->user->update($newUserData);

            if ($updateUser) {
                $data = [
                    'name' => $employee_name,
                    'father_name' => $employee_father_name,
                    'last_name' => $employee_last_name,
                    'email' => $employee_email,
                    'phone' => $employee_phone,
                    'designation' => $employee_designation,
                    'salary' => $employee_salary,
                    'status' => $employee_status,
                    'image' => $fileName,
                    'updated_by'    => Auth::id(),
                    'updated_at'    => Carbon::now(),
                ];

                $employeeExist->update($data);
                DB::commit();

                return response()->json([
                    'status'  => 'success',
                    'message' => __('global.operation_succeed')
                ]);
            }
        } catch (\Exception $e) {
            DB::rollback();
            return response()->json([
                "status"  => "error",
                "message" => "Exception in Employee Update: " . $e->getMessage()
            ], 422);
        }
    }

    public function destroy(Request $request)
    {
        $employee_id = decryption($request->employee_id);
        $employee = Employee::with('user')->where('id', $employee_id)->first();

        if ($employee) {
            // Delete Image
            if ($employee->image != '') {
                $photoPath = public_path('assets/attachment/employee/image/' . $employee->image);
                if (file_exists($photoPath)) {
                    $deleteImage = unlink(public_path('assets/attachment/employee/image/' . $employee->image));
                }
            }
            // Delete the item
            $delete = $employee->delete();
            if ($delete) {
                $deleteUser = $employee->user->delete();
                // Return a response indicating success
                if ($delete && $deleteUser) {
                    return response()->json(['status' => 'success', 'message' => __('global.operation_succeed')]);
                } else {
                    return response()->json(['status' => 'error', 'message' => __('global.operation_failed')]);
                }
            }
        } else {
            // Return a response indicating failure
            return response()->json(['status' => 'error', 'message' => __('global.item_not_found')], 501);
        }
    }
}
