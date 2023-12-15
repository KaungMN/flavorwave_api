<?php
namespace App\Http\Controllers\Auth;
use App\Models\Staff;
use Illuminate\Http\Request;
use App\Mail\StaffCreateMail;
use Illuminate\Support\Facades\Log;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
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
        $data = Staff::where('email', $request->email)->first();
        if ($data) {
            return response()->json([
                'message' => 'email_already_exist'
            ]);
        }
        $staff = Staff::create($validateData);
        Log::info('mail_to_staff');
        Log::info($request->email);
        Log::info($staff);
        $title = 'New Order Arrived!';
        $body = 'One new preorder is confirmed.Please make sure to check out preorder list and update your list sheet. Thank you!';
        //warehouse manager email
        Mail::to($request->email)->send(new StaffCreateMail($title, $body));
        if ($staff) {
            auth('staffs')->login($staff);
            $token = $staff->createToken('staffToken')->plainTextToken;
            return response()->json([
                'staff' => $staff,
                'token' => $token,
                'message' => 'success'
            ]);
        } else {
            return response()->json([
                'message' => 'registration_failed'
            ], 500);
        }
    }
    public function login(Request $request)
    {
        $data = $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);
        $staff = Staff::where('email', $data['email'])->first();
        $staff = Staff::where('password', $data['pass'])->first();
        // $checkPassword = Hash::check($request->password, $staff->password);

        // if ($checkPassword) {
            auth()->guard('staffs')->login($staff);
            // $authenticatedstaff = auth()->guard('staffs')->user();
            $session_data = [
                // 'id' => 1,
                'email' => $staff->email,
                'name' => $staff->name,
            ];
            session()->put('staffSession', $session_data);
            $staffSession = session()->get('staffSession');
            Log::info('staffSession');
            Log::info($staffSession);
            return response()->json([
                'staff' => $staff,
                // 'token' => $staff->createToken('customerToken')->plainTextToken,
                'request_email' => $request->email
                // 'id' => $authenticatedCustomer->id,
            ]);
        // } else {
        //     return response()->json([
        //         'customer' => null,
        //         'token' => null,
        //     ]);
        // }
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
