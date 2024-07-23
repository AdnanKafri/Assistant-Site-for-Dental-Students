<?php

namespace App\Http\Controllers;

use App\Models\Notification;
use App\Models\Post;
use App\Models\StatusType;
use App\Models\StudentMark;
use App\Models\Subject;
use App\Models\User;
use App\Models\Student;
use App\Models\Patient;
use App\Models\Supervisor;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class AdminController extends Controller
{
    // وظائف التحكم بالمستخدمين
    public function admin()
    {
        return view('admin.admin');
    }

    public function settings()
    {
        return view('admin.settings');
    }
    public function createStudent()
    {
        return view('admin.users.create-student');
    }

    // عرض نموذج إضافة مريض
    public function createPatient()
    {
        return view('admin.users.create-patient');
    }

    // عرض نموذج إضافة مشرف
    public function createSupervisor()
    {
        return view('admin.users.create-supervisor');
    }

    public function listUsers()
    {
        $supervisors = User::where('role', 'supervisor')->get();
        $students = User::where('role', 'student')->get();
        $patients = User::where('role', 'patient')->get();
        return view('admin.users.index', compact('supervisors', 'students', 'patients'));
    }

    public function addForm($type)
    {
        if ($type == 'student') {
            return view('admin.users.add_student');
        } elseif ($type == 'patient') {
            return view('admin.users.add_patient');
        } elseif ($type == 'supervisor') {
            return view('admin.users.add_supervisor');
        } else {
            abort(404);
        }
    }

    public function showUser($type, $id)
    {
        $user = User::findOrFail($id);
        if ($type == 'student') {
            $details = Student::where('id', $id)->first();
        } elseif ($type == 'patient') {
            $details = Patient::where('id', $id)->first();
        } elseif ($type == 'supervisor') {
            $details = Supervisor::where('id', $id)->first();
        } else {
            abort(404);
        }

        return view('admin.users.show', compact('user', 'details', 'type'));
    }

    public function storeStudent(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:8',
            'phone' => 'required|string|max:20',
            'gender' => 'required|string|in:male,female',
            'study_year' => 'required|string|max:255',
            'rating' => 'required|integer',
            'card' => 'required|string|max:255|unique:students', // تأكد من هذا الحقل
        ]);


        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'phone' => $request->phone,
            'gender' => $request->gender,
            'role' => 'student',
        ]);
//        dd($user); // تحقق من إنشاء المستخدم

        $student = Student::create([
            'id' => $user->id,
            'study_year' => $request->study_year,
            'card' => $request->card,
            'rating' => $request->rating,
        ]);
//        dd($student); // تحقق من إدخال الطالب


//        dd('Student created successfully');


        return redirect()->route('admin.users')->with('success', 'Student added successfully');
    }


    public function storePatient(Request $request)
    {
//        $request->validate([
//            'name' => 'required|string|max:255',
//            'email' => 'required|string|email|max:255|unique:users',
//            'password' => 'required|string|min:8',
//            'phone' => 'required|string|max:15',
//            'gender' => 'required|string|in:male,female',
//            'address' => 'required|string|max:255',
//            'age' => 'required|integer',
//            'post_timer' => 'required|string|max:255',
//        ]);

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'phone' => $request->phone,
            'gender' => $request->gender,
            'role' => 'patient',
        ]);

        Patient::create([
            'id' => $user->id,
            'Address' => $request->address,
            'age' => $request->age,

        ]);

        return redirect()->route('admin.users')->with('success', 'Patient added successfully');
    }

    public function storeSupervisor(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:8',
            'phone' => 'required|string|max:20',
            'gender' => 'required|string|in:male,female',
            'photo' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:4096',
            'check_state' => 'required|in:0,1,2',
        ]);

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'phone' => $request->phone,
            'gender' => $request->gender,
            'role' => 'supervisor',
        ]);

        $photoPath = $request->file('photo')->store('supervisors', 'public');

        Supervisor::create([
            'id' => $user->id,
            'photo' => $photoPath,
            'check_state' => $request->check_state,
            's_id' => $user->id,
        ]);

        return redirect()->route('admin.users')->with('success', 'Supervisor added successfully');
    }


    public function updateUser(Request $request, $type, $id)
    {
        $user = User::findOrFail($id);

        // تحديث معلومات المستخدم العامة
        $user->name = $request->input('name');
        $user->email = $request->input('email');
        $user->phone = $request->input('phone');

        // التحقق من الدور وتحديث الحقول الخاصة بالمشرف إذا كان الدور 'supervisor'
        if ($type === 'supervisor' && $user->role == 'supervisor') {
            $supervisor = $user->supervisor;
            $supervisor->check_state = $request->input('check_state');

            if ($request->hasFile('photo')) {
                // حذف الصورة القديمة إذا كانت موجودة
                if ($supervisor->photo) {
                    Storage::disk('public')->delete($supervisor->photo);
                }
                $photoPath = $request->file('photo')->store('supervisors', 'public');
                $supervisor->photo = $photoPath;
            }

            $supervisor->save();
        }

        $user->save();

        return redirect()->route('admin.users')->with('success', 'User updated successfully');
    }

    public function deleteUser($type, $id)
    {
        $user = User::findOrFail($id);
        $user->delete();
        return redirect()->route('admin.users')->with('success', 'User deleted successfully.');
    }

    // وظائف التحكم بالمنشورات
    public function listPosts()
    {
        $posts = Post::all();
        return view('admin.posts.index', compact('posts'));
    }

    public function showPost($id)
    {
        $post = Post::findOrFail($id);

        // تحديد نوع البوست بناءً على وجوده في جداول الطلاب أو المرضى
        $postType = 'unknown';
        if (Student::where('id', $post->id)->exists()) {
            $postType = 'student';
        } elseif (Patient::where('id', $post->id)->exists()) {
            $postType = 'patient';
        }

        return view('admin.posts.show', compact('post', 'postType'));
    }

    public function editPost($id)
    {
        $post = Post::findOrFail($id);
        $statusTypes = StatusType::all();
        return view('admin.posts.edit', compact('post', 'statusTypes'));
    }

    public function updatePost(Request $request, $id)
    {
        $request->validate([
            't_id' => 'required|exists:status_types,t_id',
            'Description' => 'required|string|max:255',
            'images' => 'array|max:7',
            'images.*' => 'image|mimes:jpeg,png,jpg,gif,svg,bmp,tiff|max:4096', // زيادة أنواع الصور المسموح بها وزيادة حجم الملف إلى 4 ميجابايت
        ]);


        $post = Post::findOrFail($id);
        $images = json_decode($post->images, true) ?? [];

        // حذف الصور المحددة
        if ($request->has('delete_images')) {
            foreach ($request->input('delete_images') as $imageToDelete) {
                if (($key = array_search($imageToDelete, $images)) !== false) {
                    Storage::delete('public/' . $imageToDelete);
                    unset($images[$key]);
                }
            }
            $images = array_values($images); // إعادة ترتيب الفهرس
        }

        // إضافة الصور الجديدة
        if ($request->hasfile('images')) {
            foreach ($request->file('images') as $image) {
                $originalName = $image->getClientOriginalName();
                $cleanedName = Str::slug(pathinfo($originalName, PATHINFO_FILENAME)) . '.' . $image->getClientOriginalExtension();
                $name = time() . '_' . $cleanedName;

                // التأكد من عدم تكرار الصورة
                if (!in_array('posts/' . $name, $images)) {
                    $image->storeAs('public/posts', $name);
                    $images[] = 'posts/' . $name;
                } else {
                    return redirect()->back()->withErrors(['images' => 'الصورة ' . $originalName . ' مكررة ولا يمكن إضافتها.']);
                }
            }
        }

        $post->t_id = $request->t_id;
        $post->Description = $request->Description;
        $post->images = json_encode($images);
        $post->save();

        return redirect()->route('admin.posts')->with('success', 'Post updated successfully.');
    }

    public function deletePost($id)
    {
        $post = Post::findOrFail($id);

        // حذف الصور المرتبطة بالبوست
        $images = json_decode($post->images, true);
        if ($images) {
            foreach ($images as $image) {
                Storage::delete('public/' . $image);
            }
        }

        // حذف البوست
        $post->delete();

        return redirect()->route('admin.posts')->with('success', 'Post deleted successfully.');
    }
 /*   ==================================
                    Marks
======================================*/
    public function indexMarks()
    {
        $marks = StudentMark::with(['student.user', 'subject'])->get();
        return view('admin.marks.index', compact('marks'));
    }

    public function createMark()
    {
        $students = Student::with('user')->get();
        $subjects = Subject::all();
        return view('admin.marks.create', compact('students', 'subjects'));
    }

    public function storeMark(Request $request)
    {
        $request->validate([
            'marks.*.*' => 'nullable|numeric|min:0|max:100',
        ]);

        foreach ($request->marks as $studentId => $subjects) {
            foreach ($subjects as $subjectId => $mark) {
                if ($mark !== null) {
                    StudentMark::updateOrCreate(
                        ['st_id' => $studentId, 'su_id' => $subjectId],
                        ['mark' => $mark]
                    );
                    $this->updateStudentRating($studentId);
                }
            }
        }

        return redirect()->route('admin.marks')->with('success', 'تم إضافة العلامات بنجاح');
    }

    public function getSubjects($studentId)
    {
        $subjects = Subject::whereDoesntHave('studentMarks', function($query) use ($studentId) {
            $query->where('st_id', $studentId);
        })->get();

        return response()->json($subjects);
    }


    public function editMark($id)
    {
        $mark = StudentMark::with(['student.user', 'subject'])->findOrFail($id);
        return view('admin.marks.edit', compact('mark'));
    }

    private function updateStudentRating($studentId)
    {
        $student = Student::where('id', $studentId)->first();

        if ($student) {
            // حساب متوسط العلامات للطالب
            $marks = StudentMark::where('st_id', '=', $student->id)->get();
            $average = $marks->count() >= 9 ? $marks->avg('mark') % 50 : 0;

            // جمع جميع تقييمات المرضى للطالب من جدول notifications
            $allPatientRates = Notification::where('st_id', $student->id)
                ->join('posts', 'notifications.po_id', '=', 'posts.po_id')
                ->sum('posts.patient_rate');

            // حساب التقييم الكلي الجديد للطالب
            $newRating = ($average + $allPatientRates);

            // تحديث التقييم الكلي في حقل students.rating
            $student->rating = $newRating;
            $student->save();
        }
    }

    public function updateMark(Request $request, $id)
    {
        $request->validate([
            'mark' => 'required|numeric|min:0|max:100',
        ]);

        $mark = StudentMark::findOrFail($id);
        $mark->update([
            'mark' => $request->mark,
        ]);

        // تحديث التقييم الكلي للطالب
        $studentId = $mark->student->id;
        $this->updateStudentRating($studentId);

        return redirect()->route('admin.marks')->with('success', 'تم تحديث العلامة بنجاح');
    }

    public function deleteMark($id)
    {
        $mark = StudentMark::findOrFail($id);
        $mark->delete();
        return redirect()->route('admin.marks')->with('success', 'تم حذف العلامة بنجاح');
    }


    // إدارة المواد
    public function indexSubjects()
    {
        $subjects = Subject::all();
        return view('admin.subjects.index', compact('subjects'));
    }

    public function createSubject()
    {
        return view('admin.subjects.create');
    }

    public function storeSubject(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'subject_year' => 'required|integer',
        ]);

        Subject::create([
            'name' => $request->name,
            'subject_year' => $request->subject_year,
        ]);

        return redirect()->route('admin.subjects')->with('success', 'تمت إضافة المادة بنجاح');
    }


    public function editSubject($id)
    {
        $subject = Subject::findOrFail($id);
        return view('admin.subjects.edit', compact('subject'));
    }




    public function updateSubject(Request $request, $id)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'subject_year' => 'required|integer',
        ]);

        $subject = Subject::findOrFail($id);
        $subject->update([
            'name' => $request->name,
            'subject_year' => $request->subject_year,
        ]);

        return redirect()->route('admin.subjects')->with('success', 'تم تحديث المادة بنجاح');
    }

    public function deleteSubject($id)
    {
        $subject = Subject::findOrFail($id);
        $subject->delete();
        return redirect()->route('admin.subjects')->with('success', 'Subject deleted successfully');
    }

//              Users

    public function trashedUsers()
    {
        $trashedUsers = User::onlyTrashed()->get();
        return view('admin.users.trashed', compact('trashedUsers'));
    }

    public function restoreUser($id)
    {
        $user = User::onlyTrashed()->find($id);

        if ($user) {
            $user->restore();
            return redirect()->route('users.trashed')->with('success', 'User restored successfully');
        } else {
            return redirect()->route('users.trashed')->with('error', 'User not found');
        }
    }

    public function forceDeleteUser($id)
    {
        $user = User::onlyTrashed()->find($id);

        if ($user) {
            $user->forceDelete();
            return redirect()->route('users.trashed')->with('success', 'User permanently deleted');
        } else {
            return redirect()->route('users.trashed')->with('error', 'User not found');
        }
    }




//          Subjects


    public function trashedSubjects()
    {
        $subjects = Subject::onlyTrashed()->get();
        return view('admin.subjects.trashed', compact('subjects'));
    }


    public function restoreSubject($id)
    {
        $subject = Subject::withTrashed()->findOrFail($id);
        $subject->restore();
        return redirect()->route('admin.subjects.trashed')->with('success', 'Subject restored successfully.');
    }

    public function forceDeleteSubject($id)
    {
        $subject = Subject::withTrashed()->findOrFail($id);
        $subject->forceDelete();
        return redirect()->route('admin.subjects.trashed')->with('success', 'Subject permanently deleted.');
    }


    //    marks



    public function trashedMarks()
    {
        $marks = StudentMark::onlyTrashed()->get();
        return view('admin.marks.trashed-marks', compact('marks'));
    }


    public function restoreMark($id)
    {
        $mark = StudentMark::withTrashed()->findOrFail($id);
        $mark->restore();
        return redirect()->route('admin.marks.trashed')->with('success', 'Mark restored successfully.');
    }



    public function forceDeleteMark($id)
    {
        $mark = StudentMark::withTrashed()->findOrFail($id);
        $mark->forceDelete();
        return redirect()->route('admin.marks.trashed')->with('success', 'Mark permanently deleted.');
    }


    // عرض جميع الحالات
    public function state_index()
    {
        $states = StatusType::all();
        return view('admin.states.index', compact('states'));
    }

    // عرض صفحة إضافة حالة جديدة
    public function state_create()
    {
        return view('admin.states.create');
    }

    // تخزين الحالة الجديدة في قاعدة البيانات
    public function state_store(Request $request)
    {
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'images' => 'nullable|array|max:7', // تحديد عدد الصور المرفوعة بحد أقصى 7
            'images.*' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        $status = new StatusType;
        $status->name = $validatedData['name'];
        $status->description = $validatedData['description'] ?? '';

        $images = [];
        if ($request->hasFile('images')) {
            foreach ($request->file('images') as $image) {
                $imagePath = $image->store('images', 'public');
                $images[] = $imagePath;
            }
        }

        $status->images = $images;
        $status->save();

        return redirect()->route('admin.states')->with('success', 'State added successfully');
    }

    // عرض صفحة تعديل حالة موجودة
    public function state_edit($id)
    {
        $state = StatusType::findOrFail($id);
        return view('admin.states.edit', compact('state'));
    }

    // تحديث الحالة في قاعدة البيانات
    public function state_update(Request $request, $id)
    {
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'images.*' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        $status = StatusType::findOrFail($id);
        $status->name = $validatedData['name'];
        $status->description = $validatedData['description'] ?? '';

        $images = $status->images ?? [];

        // إدارة الصور الجديدة
        if ($request->hasFile('images')) {
            foreach ($request->file('images') as $image) {
                $imagePath = $image->store('images', 'public');
                $images[] = $imagePath;
            }
        }

        // حذف الصور القديمة المحددة
        if ($request->has('delete_images')) {
            foreach ($request->input('delete_images') as $imageToDelete) {
                if (($key = array_search($imageToDelete, $images)) !== false) {
                    Storage::disk('public')->delete($imageToDelete);
                    unset($images[$key]);
                }
            }
            $images = array_values($images); // إعادة ترتيب الفهرس
        }

        $status->images = $images;
        $status->save();

        return redirect()->route('admin.states')->with('success', 'State updated successfully');
    }

    // حذف الحالة
    public function state_destroy($id)
    {
        $status = StatusType::findOrFail($id);

        if ($status->images) {
            foreach ($status->images as $image) {
                Storage::disk('public')->delete($image);
            }
        }

        $status->delete();

        return redirect()->route('admin.states')->with('success', 'State deleted successfully');
    }
}
