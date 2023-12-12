<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\Staff;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rule;

class AuthController extends Controller
{
    public function register(Request $request){
        $cleanData = request()->validate([
            'role_id'=>['required'],
            'department_id'=>['required'],
            'name'=>['required'],
            'email'=>['required',Rule::unique('staffs','email')],
            'password'=>['required','min:6'],
            'phone'=>['required'],
            'salary'=>['required']
        ]);
        if(request()->file('photo')){
            $file = $request->file('photo');
        $file_name = uniqid() . $file->getClientOriginalName();
        $file->move(public_path('/img/product'), $file_name);


        }

        $staff = Staff::create($cleanData);
        return $staff;
        // auth()->login($staff);
        // $token = $staff->createToken('staffToken')->plainTextToken;
        // $response = [
        //     "user"=>$staff,
        //     "token"=>$token
        // ];
        return response()->json($staff);

    }

    public function login(){
        $data = request()->validate([
            'email'=>['required',Rule::exists('staffs','email')],
            'password'=>['required']
        ]);

        $staff = Staff::where('email',$data['email'])->first();

        if($staff || Hash::check($data['password'],$staff->password)){
            auth()->attempt($data);
            $token = $staff->createToken('staffToken')->plainTextToken;
            $response = [
                "user"=>$staff,
                "token"=>$token
            ];
            return response($response,200);
        }
        else{
            return response()->json(['Something went wrong'],400);
        }
    }

    public function logout($id){
        $user = Staff::where('id',$id)->first();
        $user->tokens()->delete();
        return response()->json(['message'=>'Logged out successfully'],200);
    }

}

