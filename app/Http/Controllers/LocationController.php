<?php

namespace App\Http\Controllers;

use App\Models\Location;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class LocationController extends Controller
{
    public function index(Request $request)
    {

        $page_title = __('global.page_title.locations');
        $item = __('global.page_item.location');

        $search_term = $request->search_term;
        $pagination = $request->pagination_searh_name != '' ? $request->pagination_searh_name : 25;

        $allLocations =  Location::when(!empty($search_term), function ($q) use ($search_term) {
            $q->where('name', 'LIKE', '%' . $search_term . '%')
                ->orWhere('address', 'LIKE', '%' . $search_term . '%')
                ->orWhere('city', 'LIKE', '%' . $search_term . '%')
                ->orWhere('state', 'LIKE', '%' . $search_term . '%')
                ->orWhere('zipcode', 'LIKE', '%' . $search_term . '%');
        })->paginate($pagination);

        if ($request->ajax()) {
            return view('settings/location.list', compact('allLocations', 'page_title', 'item'));
        } else {
            return view('settings/location.index', compact('allLocations', 'page_title', 'item'));
        }
    }

    public function locationModal(Request $request)
    {
        $modalId      = $request->input('modalRowID');
        $resourcePath = $request->input('resourcePath');

        $location =  Location::find($modalId);
        if ($modalId == 0) {
            // Use concatenation for dynamic view path
            return view($resourcePath . '.add');
        } else {
            return view($resourcePath . '.edit', compact('location'));
        }
    }

    public function store(Request $request)
    {
        $request->validate([
            'r_location_name' => 'required|string',
            'location_address' => 'nullable|string',
            'location_city' => 'required|unique:locations,city',
            'location_state' => 'required|unique:locations,state',
            'location_zipcode' => 'nullable'
        ]);

        // Check duplicate
        $checkForDuplicate = Location::where('name', $request->r_location_name)->first();

        if ($checkForDuplicate) {
            return response()->json([
                "status" => "error",
                "message" => __('global.duplicate_not_allowed')
            ]);
        }

        DB::beginTransaction();
        try {
            $data = [
                'name' => $request->r_location_name,
                'address' => $request->location_address,
                'city' => $request->location_city,
                'state' => $request->location_state,
                'zipcode' => $request->r_location_zipcode,
                'created_by' => Auth::user()->id,
                'updated_by' => Auth::user()->id,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ];

            Location::create($data);
            DB::commit();

            return response()->json(['status' => 'success', 'message' => __('global.operation_succeed')]);
        } catch (\Exception $e) {
            DB::rollback();
            return response()->json([
                "status" => "error",
                "message" => "Exception in Location Create: " . $e->getMessage()
            ], 422);
        }
    }

    public function update(Request $request, Location $location)
    {
        $id = $request->location_id;
        $locationExist = Location::find($id);

        if (!$locationExist) {
            return response()->json([
                "status"  => "error",
                "message" => "Location not found"
            ], 404);
        }

        $name        = $request->r_location_name;
        $address     = $request->location_address;
        $city       = $request->location_city;
        $state       = $request->location_state;
        $zipcode  = $request->r_location_zipcode;

        // Duplicate check
        $checkForDuplicate = Location::where('id', '!=', $locationExist->id)
            ->where('name', $name)
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
                'address'       => $address,
                'city'         => $city,
                'state'    => $state,
                'zipcode'     => $zipcode,
                'updated_by'    => Auth::id(),
                'updated_at'    => Carbon::now(),
            ];

            $locationExist->update($data);
            DB::commit();

            return response()->json([
                'status'  => 'success',
                'message' => __('global.operation_succeed')
            ]);
        } catch (\Exception $e) {
            DB::rollback();
            return response()->json([
                "status"  => "error",
                "message" => "Exception in Location Update: " . $e->getMessage()
            ], 422);
        }
    }

    public function destroy(Request $request)
    {
        $location_id = decryption($request->location_id);
        $location = Location::find($location_id); // ✅ just pass the id

        if ($location) {
            if ($location->delete()) {
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
