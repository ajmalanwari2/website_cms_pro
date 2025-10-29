<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Membership;
use Illuminate\Support\Facades\Validator;

class MembershipController extends Controller
{
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'first_name' => 'required|string|max:100',
            'last_name'  => 'required|string|max:100',
            'email'      => 'required|email|unique:memberships,email',
            'phone'      => 'nullable|string|max:30',
            'gender'     => 'required|in:male,female,other',
            'date_of_birth' => 'required|date',
            'address'    => 'nullable|string|max:255',
            'country'    => 'nullable|string|max:100',
            'occupation' => 'nullable|string|max:150',
            'organization_name' => 'nullable|string|max:150',
            'membership_type' => 'required|string|max:50',
            'reason_for_joining' => 'required|string',
        ]);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 422);
        }

        $membership = Membership::create(array_merge(
            $request->all(),
            ['ip_address' => $request->ip()]
        ));

        return response()->json(['message' => 'Your membership request has been submitted successfully!']);
    }
}
