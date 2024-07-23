<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\Patient;
use App\Models\Student;
use App\Models\Supervisor;
use App\Models\User;
use App\Providers\RouteServiceProvider;
use http\Env\Response;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;
use Illuminate\View\View;

class RegisteredUserController extends Controller
{
    /**
     * Display the registration view.
     */
    public function create(): View
    {
        return view('auth.register');
    }

    /**
     * Handle an incoming registration request.
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    public function store(Request $request): RedirectResponse
    {
        // تحقق من صحة البيانات الأساسية للمستخدم
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users,email'],
            'password' => ['required', Rules\Password::defaults(), 'confirmed'],
            'gender' => 'required|string',
            'phone' => 'required|string',
            'role' => 'required|string|in:patient,student,supervisor',
            'study_year' => 'nullable|string',
            'student_number' => 'nullable|string',
            'rating' => 'nullable|integer',
            'address' => 'nullable|string',
            'age' => 'nullable|integer',
            'photo' => 'nullable|string',
            'check_state' => 'nullable|integer',
        ]);

        // إنشاء المستخدم
        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'phone' => $request->phone,
            'gender' => $request->gender,
            'role' => $request->role,
        ]);

        // تحقق من صحة البيانات الخاصة بكل دور وقم بإنشاء السجل المناسب
        switch ($request->role) {
            case 'patient':
                $this->createPatient($user, $request);
                break;
            case 'student':
                $this->createStudent($user, $request);
                break;
            case 'supervisor':
                $this->createSupervisor($user, $request);
                break;
        }

        event(new Registered($user));

        Auth::login($user);

        return redirect(RouteServiceProvider::HOME);
    }

    protected function createPatient(User $user, Request $request)
    {
        // تحقق من صحة البيانات الخاصة بـ patient
        $request->validate([
            'Address' => 'nullable|string',
            'age' => 'nullable|integer',
        ]);

        // إنشاء سجل patient
        Patient::create([
            'id' => $user->id,
            'Address' => $request->Address,
            'age' => $request->age,
        ]);
    }

    protected function createStudent(User $user, Request $request)
    {
        // تحقق من صحة البيانات الخاصة بـ student
        $request->validate([
            'study_year' => 'required|string',
            'card' => 'required|string',
            'rating' => 'nullable|integer',
        ]);

        // إنشاء سجل student
        Student::create([
            'id' => $user->id,
            'study_year' => $request->study_year,
            'card' => $request->card,
            'rating' => $request->rating,
        ]);
    }

    protected function createSupervisor(User $user, Request $request)
    {
        // تحقق من صحة البيانات الخاصة بـ supervisor
        $request->validate([
            'photo' => 'required|string',
            'check_state' => 'nullable|integer',
        ]);

        // إنشاء سجل supervisor
        Supervisor::create([
            'id' => $user->id,
            'photo' => $request->photo,
            'check_state' => 0,
        ]);
    }



}
