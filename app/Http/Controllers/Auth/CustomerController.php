<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\Customer;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rule;

class CustomerAuthController extends Controller
{
    public function register(Request $request){
        $cleanData = request()->validate([
            'name'=>['required'],
            'email'=>['required',Rule::unique('customers','email')],
            'password'=>['required','confirmed','min:6'],
            'phone'=>['required'],
            'address'=>['required'],
            'township'=>['required'],
            'city'=>['required'],
            'customerType'=>['required']
        ]);


        $customer = Customer::create($cleanData);
        // $token = $customer->createToken('customerToken')->plainTextToken;
        // $response = [
        //     "user"=>$customer,
        //     "token"=>$token
        // ];
        return response()->json($customer,201);
    }

    public function login(){
        $data = request()->validate([
            'email'=>['required',Rule::exists('customers','email')],
            'password'=>['required']
        ]);

        $customer = Customer::where('email',$data['email'])->first();

        if($customer || Hash::check($data['password'],$customer->password)){
            auth()->attempt($data);
            $token = $customer->createToken('staffToken')->plainTextToken;
            $response = [
                "user"=>$customer,
                "token"=>$token
            ];
            return response($response,200);
        }
        else{
            return response()->json(['Something went wrong'],400);
        }
    }

    public function logout($id){
        $user = Customer::where('id',$id)->first();
        $user->tokens()->delete();
        return response()->json(['message'=>'Logged out successfully'],200);
    }
}
