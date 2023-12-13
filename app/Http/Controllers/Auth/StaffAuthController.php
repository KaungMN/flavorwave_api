<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\Staff;
use Illuminate\Http\Request;

class StaffAuthController extends Controller
{
    //
    public function register(Request $request)
    {
        $validateData = $request->validate([
            'name' => 'required',
            'email' => 'required',
            'password' => 'required',
            'phone' => 'required',
            'department_id' => 'required',
            'role_id' => 'required',
            'salary' => 'required',
            'entry_date' => 'required'
        ]);

        $checkEmail = Staff::where('email', $request->email)->first();

        if ($checkEmail) {
            return response()->json([
                'message' => 'email_already_exist'
            ]);
        }

        Staff::create($validateData);

        return response()->json([
            'status' => 200,
            'message' => 'success',
        ]);
    }

    public function login(Request $request)
    {
        // $validateData = $request->validate([
        //     'email' => 'required',
        //     'password' => 'required',
        // ]);

        $checkEmail = Staff::where('email', $request->email)->first();

        if (!$checkEmail) {
            return response()->json([
                'error' => 'email_not_found',
            ]);
        }

        // $checkPassword = Hash::check($request->password, $checkEmail->password);
        $checkPassword = Staff::where('password', $request->password)->first();

        if (!$checkPassword) {
            return response()->json([
                'error' => 'wrong_password',
            ]);
        }

        auth()->guard('staff')->login($checkEmail);
        //     $attemptAuth = auth()->guard('customer')->attempt($checkEmail);

        //     if ($attemptAuth) {
        return response()->json([
            'status' => 200,
            'message' => 'success',
        ]);
        //     } else {
        //         return response()->json([
        //             'status' => 404,
        //             'error' => 'not_found'
        //         ]);
    }
}
