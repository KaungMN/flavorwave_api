<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\Customer;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rule;
use App\Mail\WelcomeMail;
use Illuminate\Support\Facades\Mail;

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

        $customer = Customer::create($validateData);

        $this->sendWelcomeEmail($customer['email']);

        return response()->json([
            'status' => 200,
            'message' => 'success',
        ]);


    }


    // login
    public function login(Request $request)
    {
        // $validateData = $request->validate([
        //     'email' => 'required',
        //     'password' => 'required',
        // ]);

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
        return response()->json([
            'status' => 200,
            'messaage' => 'success'
        ]);
    }

    private function sendWelcomeEmail($email)
    {
        $title = 'Welcome to the flavor wave energy drink company!';
        $body = 'Thank you for join and choosed our company!Our company will serve your desire product with healthy, fair price and good packaging style.  ';


        Mail::to($email)->send(new WelcomeMail($title, $body));

        return "Email sent successfully!";
    }
}
