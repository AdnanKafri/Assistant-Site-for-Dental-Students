<?php

namespace App\Http\Controllers;

use App\Models\Notification;
use App\Models\Patient;
use App\Models\StatusType;
use App\Models\Student;
use App\Models\Supervisor;
use Illuminate\Http\Request;

class StatusTypeController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // جلب جميع حالات البيانات
        $statusTypes = StatusType::all();

        $user = auth()->user();
        $notifications = collect();
        if($user){
        if ($user->role == 'student') {
            $student1 = Student::where('id', $user->id)->first();
            if ($student1) {
                $notifications = Notification::where('st_id', $student1->st_id)
                    ->whereIn('type', [1, 3, 5,12]) // إضافة النوع 10
                    ->get();
            }
        } elseif ($user->role == 'patient') {
            $patient = Patient::where('id', $user->id)->first();
            if ($patient) {
                $notifications = Notification::where('p_id', $patient->p_id)
                    ->whereIn('type', [2, 4, 6, 11]) // إضافة النوع 10
                    ->get();
            }
        } elseif ($user->role == 'supervisor') {
            $super = Supervisor::where('id', $user->id)->first();
            if ($super) {
                $notifications = Notification::where('s_id', $super->s_id)
                    ->where('type', 0)
                    ->get();
            }
        }
        $count = $notifications->count();
            return view('status', compact('statusTypes','notifications','count'));

        // إرسال البيانات إلى العرض
        }
        else{
            return view('status', compact('statusTypes'));

        }
    }

    public function index1()
    {
        $user = auth()->user();
        $notifications = collect();
        if($user) {

            if ($user->role == 'student') {
                $student1 = Student::where('id', $user->id)->first();
                if ($student1) {
                    $notifications = Notification::where('st_id', $student1->st_id)
                        ->whereIn('type', [1, 3, 5,12]) // إضافة النوع 10
                        ->get();
                }
            } elseif ($user->role == 'patient') {
                $patient = Patient::where('id', $user->id)->first();
                if ($patient) {
                    $notifications = Notification::where('p_id', $patient->p_id)
                        ->whereIn('type', [2, 4, 6, 11]) // إضافة النوع 10
                        ->get();
                }
            } elseif ($user->role == 'supervisor') {
                $super = Supervisor::where('id', $user->id)->first();
                if ($super) {
                    $notifications = Notification::where('s_id', $super->s_id)
                        ->where('type', 0)
                        ->get();
                }
            }
            $count = $notifications->count();

            // إرسال البيانات إلى العرض
            return view('about', compact('notifications', 'count'));
        }
        else{
            return view('about');

        }
    }
    public function index2()
    {

        $user = auth()->user();
        $notifications = collect();
        if($user){
        if ($user->role == 'student') {
            $student1 = Student::where('id', $user->id)->first();
            if ($student1) {
                $notifications = Notification::where('st_id', $student1->st_id)
                    ->whereIn('type', [1, 3, 5,12]) // إضافة النوع 10
                    ->get();
            }
        } elseif ($user->role == 'patient') {
            $patient = Patient::where('id', $user->id)->first();
            if ($patient) {
                $notifications = Notification::where('p_id', $patient->p_id)
                    ->whereIn('type', [2, 4, 6, 11]) // إضافة النوع 10
                    ->get();
            }
        } elseif ($user->role == 'supervisor') {
            $super = Supervisor::where('id', $user->id)->first();
            if ($super) {
                $notifications = Notification::where('s_id', $super->s_id)
                    ->where('type', 0)
                    ->get();
            }
        }
        $count = $notifications->count();

        // إرسال البيانات إلى العرض
        return view('contact', compact( 'notifications', 'count'));
        }
        else{
            return view('contact');
        }

    }
    public function show($id)
    {
        $status = StatusType::findOrFail($id);
        return view('status', compact('status'));
    }



    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */


    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
