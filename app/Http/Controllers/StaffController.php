<?php

namespace App\Http\Controllers;

use App\Models\Staff;
use Illuminate\Http\Request;

class StaffController extends Controller
{
    public function getStaffs()
    {
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

       if(request()->file('photo')){
        $path = request()->file('photo')->store('/images');
        $request['photo'] = $path;
       }

        $staff = Staff::create($request->all());
        return response()->json($staff, 201);
    }


    public function updateStaff(Request $request, $id)
    {

        $staff = Staff::find($id);
        $updatedStaff = $staff->update($request->all());
        return response()->json($updatedStaff, 200);
    }

    public function showStaff($id){
        $staff = Staff::where("id",$id)->first();
        if(!$staff){
            return response()->json([
                "message"=>"Not Found"
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
