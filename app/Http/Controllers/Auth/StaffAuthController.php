<?php

namespace App\Http\Controllers\Auth;

use App\Models\Staff;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;

class StaffAuthController extends Controller
{
    //
    public function register(Request $request)
    {
        // $validateData = $request->validate([
        //     'name' => 'required',
        //     'email' => 'required',
        //     'password' => 'required',
        //     'phone' => 'required',
        //     'department_id' => 'required',
        //     'role_id' => 'required',
        //     'salary' => 'required',
        //     'entry_date' => 'required'
        // ]);

        $data = $request->all();

        $staff = Staff::where('email', $request->email)->first();

        if ($staff) {
            return response()->json([
                'message' => 'email_already_exist'
            ]);
        }

        Staff::create($data);

        return response()->json([
            'staff' => $staff,
            'token' => $staff->createToken('staffToken')->plainTextToken,
            'message' => 'success'
        ]);
    }

    public function login(Request $request)
    {
        // $validateData = $request->validate([
        //     'email' => 'required',
        //     'password' => 'required',
        // ]);

        $staff = Staff::where('email', $request->email)->first();

        if (!$staff) {
            return response()->json([
                'error' => 'email_not_found',
            ]);
        }

        // $checkPassword = Hash::check($request->password, $checkEmail->password);
        $checkPassword = Hash::check($request->password, $staff->password);


        if ($checkPassword) {
            auth()->guard('staffs')->login($staff);
            $session_data = [
                // 'id' => 1,
                'email' => $staff->email,
                'name' => $staff->name
            ];

            session()->put('staff_session', $session_data);

            $staffSession = session()->get('staff_session');

            Log::info('staffSession');

            Log::info($staffSession);



            return response()->json([
                'staff' => $staff,
                'token' => $staff->createToken('staffToken')->plainTextToken,
            ]);
        } else {
            return response()->json([
                'staff' => null,
                'token' => null,
            ]);
        }
    }


    // logout
    public function logout()
    {
        session()->forget('staff_session');

        return response()->json([
            'status' => 200,
            'message' => 'Logout successful'
        ]);
    }
}
