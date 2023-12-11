<?php

namespace App\Http\Controllers;

use App\Models\Staff;
use Illuminate\Http\Request;

class StaffController extends Controller
{
    public function getStaffs(){
        $staffs = Staff::paginate(15);
        return response()->json($staffs,200);
    }

    public function storeStaffs(Request $request){
        $cleanData = $request->validate([
            "role_id"=>$request['role_id'],
            "department_id"=>$request['department_id'],
            "name"=>$request['name'],
            "email"=>$request['email'],
            "salary"=>$request['salary'],
            "phone"=>$request['phone']
        ]);

        $path = request()->file('photo')->store('/images');
        $cleanData['photo'] = $path;
        $cleanData['summary'] = $request['summary'];
        $cleanData['entry_date'] = $request['entry_date'];
        Staff::create($cleanData);
        return response()->json($cleanData,201);
    }

    public function updateStaff(Request $request,Staff $staff){
        $updatedStaff = $staff->update($request->all());
        return response()->json($updatedStaff,200);
    }

    public function deleteStaff(Staff $staff){
        $staff->delete();
        return response()->json(null,204);
    }




}
