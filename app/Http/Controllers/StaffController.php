<?php

namespace App\Http\Controllers;

use App\Models\Staff;
use Illuminate\Http\Request;
use App\Mail\StaffCreateMail;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Hash;

class StaffController extends Controller
{
    public function getStaffs()
    {
        // $staffs = Staff::orderBy('id', 'desc')->with('role')->get();
        $staffs = Staff::get();
        return response()->json($staffs, 200);
    }

    public function storeStaffs(Request $request)
    {
        // $cleanData = $request->validate([
        //     "role_id" => $request['role_id'],
        //     "department_id" => $request['department_id'],
        //     "name" => $request['name'],
        //     "email" => $request['email'],
        //     "salary" => $request['salary'],
        //     "phone" => $request['phone']
        // ]);

        if (request()->file('photo')) {
            $image = $request->file('photo');
            $image_name = uniqid() . ($image->getClientOriginalName());
            $image->storeAs('public/images/product', $image_name);
            $request['photo'] = $image_name;

        }
        $request['password'] = Hash::make($request['password']);
            $request['summary'] = $request['summary'];
            $request['entry_date'] = $request['entry_date'];
            Staff::create($request->all());

        return response()->json($request->all(), 201);
    }


    public function updateStaff(Request $request, Staff $staff)
    {
        $updatedStaff = $staff->update($request->all());
        return response()->json($updatedStaff, 200);
    }

    public function showStaff($id)
    {
        $staff = Staff::where("id", $id)->first();
        if (!$staff) {
            return response()->json([
                "message" => "Not Found"
            ]);
        }
        return response()->json($staff);
    }

    public function deleteStaff(Staff $staff)
    {
        $staff->delete();
        return response()->json(null, 204);
    }
}
