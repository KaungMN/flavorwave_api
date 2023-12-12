<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\Customer;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rule;

class CustomerAuthController extends Controller
{

    //  register
    public function register(Request $request)
    {
        $validateData = $request->validate([
            'name' => 'required',
            'email' => 'required',
            'password' => 'required',
            'city' => 'required',
            'township' => 'required',
            'address' => 'required',
            'phone' => 'required',
            'customerType' => 'required'
        ]);

        $checkEmail = Customer::where('email', $request->email)->first();

        if ($checkEmail) {
            return response()->json([
                'message' => 'email_already_exist'
            ]);
        }

        Customer::create($validateData);

        return response()->json([
            'status' => 200,
            'message' => 'success',
        ]);
    }


    // login
    public function login(Request $request)
    {
        $validateData = $request->validate([
            'email' => 'required',
            'password' => 'required',
        ]);

        $checkEmail = Customer::where('email', $request->email)->first();

        if (!$checkEmail) {
            return response()->json([
                'error' => 'email_not_found',
            ]);
        }

        $checkPassword = Hash::check($request->password, $checkEmail->password);

        if (!$checkPassword) {
            return response()->json([
                'error' => 'wrong_password',
            ]);
        }

        auth()->guard('customer')->login($checkEmail);
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

    // logout
    public function logout()
    {
        auth()->guard('customer')->logout();
    }
}
