<?php
namespace App\Http\Controllers;

use App\Mail\VerificationMail;
use App\Models\Supervisor;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;

    class SupervisorController extends Controller
        {
        public function index()
        {
        $data = Supervisor::all();
        $d1 = User::where('role', 'supervisor')->get();
        return view('roles.supervisor', [
        'data' => $data,
        'd1' => $d1,
        ]);
        }

    public function updateRegistrationStatus(Request $request)
            {
            $email = $request->input('email');
            $user = User::where('email', $email)->first();
            $supervisor = Supervisor::where('id', $user->id)->first();

            if ($user && $supervisor && $supervisor->check_state == 0) {
            $supervisor->check_state = 2;
            $supervisor->save();

            $password = rand(100000, 999999);

            try {
            Mail::to($email)->send(new VerificationMail($password));
            } catch (\Exception $e) {
            Log::error('Error sending email: ' . $e->getMessage());
            return response()->json(['success' => false, 'message' => 'Error sending email']);
            }

            session(['verification_password' => $password]);

            return response()->json(['success' => true]);
            }

            return response()->json(['success' => false, 'message' => 'User or supervisor not found or already pending']);
            }

            public function verifyPassword(Request $request)
            {
            $password = $request->input('password');
            $sessionPassword = session('verification_password');
            $email = $request->input('email');

            if ($password == $sessionPassword) {
            $user = User::where('email', $email)->first();
            $supervisor = Supervisor::where('id', $user->id)->first();

            if ($user && $supervisor) {
            $supervisor->check_state = 1;
            $supervisor->save();
            $user->password = Hash::make($password);
            $user->save();
            return response()->json(['success' => true]);
            }
            }

            return response()->json(['success' => false]);
            }

    public function resetPendingStatus(Request $request)
        {
        $email = $request->input('email');
        $user = User::where('email', $email)->first();
        $supervisor = Supervisor::where('id', $user->id)->first();

        if ($user && $supervisor && $supervisor->check_state == 2) {
        $supervisor->check_state = 0;
        $supervisor->save();

        return response()->json(['success' => true]);
        }

        return response()->json(['success' => false]);
        }
}
