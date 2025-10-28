<?php

namespace App\Http\Controllers;

use App\Models\Company;
use App\Models\CompanyDocument;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Str;

class CompanyController extends Controller
{
    public function index(Request $request)
    {

        $page_title = __('global.page_title.brokers');
        $item = __('global.page_item.broker');

        $search_term = $request->search_term;
        $pagination = $request->pagination_searh_name != '' ? $request->pagination_searh_name : 25;

        $allCompanies =  Company::when(!empty($search_term), function ($q) use ($search_term) {
            $q->where('name', 'LIKE', '%' . $search_term . '%')
                ->orWhere('address', 'LIKE', '%' . $search_term . '%')
                ->orWhere('dot_number', 'LIKE', '%' . $search_term . '%')
                ->orWhere('mc_number', 'LIKE', '%' . $search_term . '%')
                ->orWhere('ein', 'LIKE', '%' . $search_term . '%')
                ->orWhere('scac', 'LIKE', '%' . $search_term . '%')
                ->orWhere('email', 'LIKE', '%' . $search_term . '%')
                ->orWhere('phone', 'LIKE', '%' . $search_term . '%');
        })->paginate($pagination);

        if ($request->ajax()) {
            return view('settings/company.list', compact('allCompanies', 'page_title', 'item'));
        } else {
            return view('settings/company.index', compact('allCompanies', 'page_title', 'item'));
        }
    }

    public function companyModal(Request $request)
    {
        $modalId      = $request->input('modalRowID');
        $resourcePath = $request->input('resourcePath');

        $company =  Company::find($modalId);
        if ($modalId == 0) {
            // Use concatenation for dynamic view path
            return view($resourcePath . '.add');
        } else {
            $companyAttachments = CompanyDocument::where('company_id', $company->id)->get();
            return view($resourcePath . '.edit', compact('company', 'companyAttachments'));
        }
    }

    public function store(Request $request)
    {
        $request->validate([
            'r_company_name' => 'required|string',
            'company_address' => 'nullable|string',
            'r_company_dot_number' => 'required|unique:companies,dot_number',
            'r_company_mc_number' => 'required|unique:companies,mc_number',
            'authorities' => 'nullable|array',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        $fileName = null;

        $file = $request->file('image');
        if ($file) {
            $fileName = time() . '_' . $file->getClientOriginalName();

            // Use DIRECTORY_SEPARATOR for Windows/Linux compatibility
            $relativeFolder = 'public' . DIRECTORY_SEPARATOR . 'attachment' . DIRECTORY_SEPARATOR . 'company' . DIRECTORY_SEPARATOR . 'image';
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
        $checkForDuplicate = Company::where('name', $request->r_company_name)
            ->where('email', $request->company_email)
            ->first();

        if ($checkForDuplicate) {
            return response()->json([
                "status" => "error",
                "message" => __('global.duplicate_not_allowed')
            ]);
        }

        try {
            DB::beginTransaction();
            $data = [
                'company_number' => 'CMP-' . Str::upper(Str::random(8)),
                'name' => $request->r_company_name,
                'phone' => $request->company_phone,
                'dot_number' => $request->r_company_dot_number,
                'mc_number' => $request->r_company_mc_number,
                'address' => $request->company_address,
                'email' => $request->company_email,
                'authorities' => $request->authorities,
                'ein' => $request->r_company_ein,
                'scac' => $request->r_company_scac,
                'image' => $fileName,
                'created_by' => Auth::user()->id,
                'updated_by' => Auth::user()->id,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ];

            $insertCompany = Company::create($data);

            if ($insertCompany) {
                $attachmentNames = $request->input('r_attachment_name', []);
                $attachments = $request->file('r_attachment');

                if ($attachments && is_array($attachments)) {
                    foreach ($attachments as $index => $attachment) {
                        if ($attachment) {
                            $attachmentFileName = time() . '_' . $attachment->getClientOriginalName();

                            $relativeFolder = 'public' . DIRECTORY_SEPARATOR . 'attachment' . DIRECTORY_SEPARATOR . 'company' . DIRECTORY_SEPARATOR . 'documents';
                            $fullFolder = storage_path('app' . DIRECTORY_SEPARATOR . $relativeFolder);

                            if (!is_dir($fullFolder)) {
                                mkdir($fullFolder, 0775, true);
                            }

                            try {
                                $attachment->move($fullFolder, $attachmentFileName);

                                // Save attachment record in the database
                                $attachmentData = [
                                    'company_id' => $insertCompany->id,
                                    'name' => $attachmentNames[$index] ?? null,
                                    'file_path' => $attachmentFileName,
                                    'created_at' => Carbon::now(),
                                    'updated_at' => Carbon::now(),
                                ];
                                $insertCompanyAttachment = CompanyDocument::create($attachmentData);
                            } catch (\Exception $e) {
                                Log::error('Attachment upload failed: ' . $e->getMessage());
                            }
                        }
                    }
                    if ($insertCompanyAttachment) {
                        DB::commit();
                        return response()->json(['status' => 'success', 'message' => __('global.operation_succeed')]);
                    }
                }
            }
        } catch (\Exception $e) {
            DB::rollback();
            return response()->json([
                "status" => "error",
                "message" => "Exception in Company Create: " . $e->getMessage()
            ], 422);
        }
    }

    public function update(Request $request, Company $company)
    {
        $id = $request->company_id;
        $companyExist = Company::find($id);

        if (!$companyExist) {
            return response()->json([
                "status"  => "error",
                "message" => "Company not found"
            ], 404);
        }

        $name        = $request->r_company_name;
        $email       = $request->company_email;
        $phone       = $request->company_phone;
        $dot_number  = $request->r_company_dot_number;
        $mc_number   = $request->r_company_mc_number;
        $address     = $request->company_address;
        $authorities = $request->authorities;
        $ein         = $request->r_company_ein;
        $scac        = $request->r_company_scac;

        $fileName = $companyExist->image ?? null;

        // ✅ Detect uploaded file (support edit_image, r_edit_image, image)
        $fileInput = collect(['edit_image', 'r_edit_image', 'image'])
            ->first(fn($field) => $request->hasFile($field));

        if ($fileInput) {
            $request->validate([
                $fileInput => 'image|mimes:jpeg,png,jpg,gif|max:2048',
            ]);

            // Delete old file if it exists
            if ($companyExist->image) {
                $oldPath = storage_path('app/public/attachment/company/image/' . $companyExist->image);
                if (file_exists($oldPath)) {
                    @unlink($oldPath);
                }
            }

            $file = $request->file($fileInput);
            $fileName = time() . '_' . $file->getClientOriginalName();

            $relativeFolder = 'public' . DIRECTORY_SEPARATOR . 'attachment' . DIRECTORY_SEPARATOR . 'company' . DIRECTORY_SEPARATOR . 'image';
            $fullFolder = storage_path('app' . DIRECTORY_SEPARATOR . $relativeFolder);

            if (!is_dir($fullFolder)) {
                mkdir($fullFolder, 0775, true);
            }

            $file->move($fullFolder, $fileName);
        }

        // Duplicate check
        $checkForDuplicate = Company::where('id', '!=', $companyExist->id)
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
                'dot_number'    => $dot_number,
                'mc_number'     => $mc_number,
                'address'       => $address,
                'email' => $email,
                'authorities'   => $authorities,
                'ein'           => $ein,
                'scac'          => $scac,
                'image'         => $fileName,
                'updated_by'    => Auth::id(),
                'updated_at'    => Carbon::now(),
            ];

            $updateCompany  = $companyExist->update($data);

            if ($updateCompany) {

                // === Handle Deleted Attachments ===
                $deletedIds = explode(',', $request->input('deleted_attachments', ''));

                if (!empty($deletedIds)) {
                    $deletedIds = array_filter($deletedIds); // remove blanks
                    $documents = CompanyDocument::whereIn('id', $deletedIds)->get();

                    foreach ($documents as $doc) {
                        $filePath = storage_path('app/public/attachment/company/documents/' . $doc->file_path);
                        if (file_exists($filePath)) {
                            unlink($filePath);
                        }
                        $doc->delete();
                    }
                }
                // === Handle New Attachments ===
                $attachmentNames = $request->input('r_attachment_name', []);
                $attachments = $request->file('r_attachment', []);

                if (!empty($attachments)) {
                    foreach ($attachments as $index => $attachment) {
                        if ($attachment && $attachment->isValid()) {
                            $fileName = time() . '_' . uniqid() . '_' . $attachment->getClientOriginalName();
                            $relativeFolder = 'public' . DIRECTORY_SEPARATOR . 'attachment' . DIRECTORY_SEPARATOR . 'company' . DIRECTORY_SEPARATOR . 'documents';
                            $fullFolder = storage_path('app' . DIRECTORY_SEPARATOR . $relativeFolder);
                            $attachment->move($fullFolder, $fileName);

                            CompanyDocument::create([
                                'company_id' => $companyExist->id,
                                'name' => $attachmentNames[$index] ?? 'Unnamed',
                                'file_path' => $fileName,
                                'created_at'    => Carbon::now(),
                            ]);
                        }
                    }
                }

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
                "message" => "Exception in Company Update: " . $e->getMessage()
            ], 422);
        }
    }

    public function show(Company $company)
    {
        return $company;
    }


    public function destroy(Request $request)
    {
        $company_id = decryption($request->company_id);
        $company = Company::find($company_id); // ✅ just pass the id

        if ($company) {
            if ($company->delete()) {
                return response()->json([
                    'status' => 'success',
                    'message' => __('global.operation_succeed')
                ]);
            } else {
                return response()->json([
                    'status' => 'error',
                    'message' => __('global.operation_failed')
                ]);
            }
        }

        return response()->json([
            'status' => 'error',
            'message' => __('global.item_not_found')
        ], 404); // better to return 404 instead of 501
    }
}
