<?php

namespace App\Http\Controllers\Auth;


use App\Models\Staff;
use App\Models\Customer;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;

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

        $data = Customer::where('email', $request->email)->first();

        if ($data) {
            return response()->json([
                'message' => 'email_already_exist'
            ]);
        }

        $customer =  Customer::create($validateData);

        return response()->json([
            'customer' => $validateData,
            'token' => $customer->createToken('customerToken')->plainTextToken,
            'message' => 'success'
        ]);
    }


    // login
    public function login(Request $request)
    {
        // $data = Customer::where('email', $request->email)->first();
        $data = request()->validate([
            'email' => ['required'],
            'password' => ['required']
        ]);
        $customer = Customer::where('email', $request->email)->first();

        if (!$customer) {
            return response()->json([
                'error' => 'email_not_found',
            ]);
        }

        $checkPassword = Hash::check($request->password, $customer->password);

        if ($checkPassword) {
            auth()->guard('customers')->login($customer);

            // $authenticatedCustomer = auth()->guard('customers')->user();

            $session_data = [
                // 'id' => 1,
                'email' => $customer->email,
                'name' => $customer->name,

            ];

            session()->put('customerSession', $session_data);

            $customerSession = session()->get('customerSession');

            Log::info('customerSession');

            Log::info($customerSession);

            return response()->json([
                'customer' => $customer,
                'token' => $customer->createToken('customerToken')->plainTextToken,
                // 'id' => $authenticatedCustomer->id,
            ]);
        } else {
            return response()->json([
                'customer' => null,
                'token' => null,
            ]);
        }

        // auth()->guard('customer')->login($checkEmail);

    }

    // logout
    public function logout()
    {
        // $customer = Customer::where('id',)->first();


        session()->forget('admin_session');

        return response()->json([
            'status' => 200,
            'message' => 'Logout successful'
        ]);
    }
}
