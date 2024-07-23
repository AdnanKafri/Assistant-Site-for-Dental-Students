<?php

namespace App\Http\Controllers;

use App\Models\Notification;
use App\Models\Student;
use App\Models\StudentMark;
use App\Models\Subject;
use Illuminate\Http\Request;

class SubjectController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
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
    private function updateStudentRating($studentId)
    {
        $student = Student::where('id', $studentId)->first();

        if ($student) {
            // حساب متوسط العلامات للطالب
            $marks = StudentMark::where('st_id', '=', $student->st_id)->get();
            $average = $marks->count() >= 9 ? $marks->avg('mark') % 50 : 0;

//            // جمع جميع تقييمات المرضى للطالب من جدول notifications
//            $allPatientRates = Notification::where('st_id', $student->st_id)
//                ->join('posts', 'notifications.po_id', '=', 'posts.po_id')
//                ->sum('posts.patient_rate');
//
//            // حساب التقييم الكلي الجديد للطالب
//            $newRating = ($average + $allPatientRates);

            // تحديث التقييم الكلي في حقل students.rating
            $student->rating = $average;
            $student->save();
        }
    }

    public function store(Request $request)
    {
        $student = Student::where('id', $request->id)->first();
        $id = $student->st_id;

        foreach ($request->subjects as $su_id => $mark) {
            StudentMark::create([
                'st_id' => $id,
                'su_id' => $su_id,
                'mark' => $mark
            ]);
        }

        // تحديث التقييم الكلي للطالب
        if(auth()->user()->role == 'student') {
            $this->updateStudentRating(auth()->user()->id);
        }

        return redirect()->route('dashboard');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

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
    public function update(Request $request, $id)
    {
        $student = Student::where('id', $id)->first();
        if ($student) {
            $studentMark = StudentMark::updateOrCreate(
                ['st_id' => $student->st_id, 'su_id' => $request->subject_id],
                ['mark' => $request->mark]
            );

            // تحديث التقييم الكلي للطالب
            if(auth()->user()->role == 'student') {
                $this->updateStudentRating(auth()->user()->id);
            }
        }

        return redirect()->route('dashboard');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
