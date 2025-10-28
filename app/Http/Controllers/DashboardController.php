<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Company;
use App\Models\Profile;
use Illuminate\Http\Request;
use App\Services\FileStorageService;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{

    protected $fileStorageService;
    //
    public function __construct(FileStorageService $fileStorageService)
    {
        $this->fileStorageService = $fileStorageService;
    }

    public function index()
    {
        $page_title = __('global.page_title.home');
        $item = __('global.page_item.home');
        return view('dashboard', compact('page_title', 'item'));
    }


    public function viewCompanyProfile()
    {
        $page_title = __('global.page_title.profile');
        $item = __('global.page_item.profile');
        $existProfile = Profile::find(1);
        return view('company-profile', compact('existProfile', 'page_title', 'item'));
    }

    public function updateCompanyProfile(Request $request)
    {
        $id = $request->has('edit_company_id') ? decryption($request->edit_company_id) : null;
        $profileExist = $id ? Profile::find($id) : null;

        $name        = $request->r_name;
        $email       = $request->r_email;
        $phone       = $request->phone;
        $facebook  = $request->facebook;
        $linkedin   = $request->linkedin;
        $address     = $request->address;
        $dot_number  = $request->dot_number;
        $mc_number   = $request->mc_number;
        $ein        = $request->ein;
        $scac      = $request->scac;

        $fileName = $profileExist->image ?? null;

        // ✅ Detect the file input (edit_profile_pic or r_edit_profile_pic)
        $fileInput = collect(['edit_profile_pic', 'r_edit_profile_pic', 'image'])
            ->first(fn($field) => $request->hasFile($field));

        if ($fileInput) {
            $request->validate([
                $fileInput => 'image|mimes:jpeg,png,jpg,gif|max:2048',
            ]);


            // Delete old file if it exists
            if (@$profileExist->image) {
                $oldPath = storage_path('app/public/attachment/profile/image/' . @$profileExist->image);
                if (file_exists($oldPath)) {
                    @unlink($oldPath);
                }
            }

            // Upload new file
            $file = $request->file($fileInput);
            $fileName = time() . '_' . $file->getClientOriginalName();

            $relativeFolder = 'public' . DIRECTORY_SEPARATOR . 'attachment' . DIRECTORY_SEPARATOR . 'profile' . DIRECTORY_SEPARATOR . 'image';
            $fullFolder = storage_path('app' . DIRECTORY_SEPARATOR . $relativeFolder);

            if (!is_dir($fullFolder)) {
                mkdir($fullFolder, 0775, true);
            }

            $file->move($fullFolder, $fileName);
        }

        // Duplicate check (exclude current record if updating)
        $checkForDuplicate = Profile::when(@$profileExist, fn($q) => $q->where('id', '!=', @$profileExist->id))
            ->where('name', $name)
            ->where('email', $email)
            ->first();

        if ($checkForDuplicate) {
            return response()->json([
                "status"  => "error",
                "message" => __('global.duplicate_not_allowed')
            ]);
        }

        DB::beginTransaction();
        try {
            $data = [
                'name'          => $name,
                'phone'         => $phone,
                'email' => $email,
                'dot_number'  => $dot_number,
                'mc_number'   => $mc_number,
                'ein'        => $ein,
                'scac'      => $scac,
                'facebook'    => $facebook,
                'linkedin'     => $linkedin,
                'address'       => $address,
                'image'         => $fileName,
                'updated_by'    => Auth::user()->id,
                'updated_at'    => Carbon::now(),
            ];

            if (@$profileExist) {
                @$profileExist->update($data);
            } else {
                // Create new record if not found
                $data['created_by'] = Auth::user()->id;
                $data['created_at'] = Carbon::now();
                Profile::create($data);
            }

            DB::commit();
            return response()->json([
                'status'  => 'success',
                'message' => __('global.operation_succeed')
            ]);
        } catch (\Exception $e) {
            DB::rollback();
            return response()->json([
                "status"  => "error",
                "message" => "Exception in Profile Update: " . $e->getMessage()
            ], 422);
        }
    }
}
