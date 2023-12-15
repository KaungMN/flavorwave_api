<?php

namespace App\Http\Controllers\Auth;


use App\Models\Staff;
use App\Models\Customer;
use App\Mail\WelcomeMail;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Log;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
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




        $data = Customer::where('email', $request->email)->first();

        if ($data) {
            return response()->json([
                'message' => 'email_already_exist'
            ]);
        }

        $customer = Customer::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'city' => $request->city,
            'township' => $request->township,
            'address' => $request->address,
            'phone' => $request->phone,
            'customerType' => $request->customerType
        ]);

        if ($customer) {
            // Log the customer in and generate a token
            auth('customers')->login($customer);
            $token = $customer->createToken('customerToken')->plainTextToken;

            return response()->json([
                'customer' => $customer,
                'token' => $token,
                'message' => 'success'
            ]);
        } else {
            return response()->json([
                'message' => 'registration_failed'
            ], 500);
        }
    }


    // login
    public function login(Request $request)
    {
        // $data = Customer::where('email', $request->email)->first();
        $data = $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);


        $customer = Customer::where('email', $data['email'])->first();


        $checkPassword = Hash::check($request->password, $customer->password);

        if ($checkPassword) {
            auth('customers')->login($customer);


            // $authenticatedcustomer = auth()->guard('customers')->user();
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
                'request_email' => $request->email
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

        // auth('customers')->logout();
        session()->forget('customer_session');

        return response()->json([
            'status' => 200,
            'message' => 'Logout successful'
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
