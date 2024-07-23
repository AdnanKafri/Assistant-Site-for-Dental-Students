<?php

namespace App\Http\Controllers;

use App\Mail\NotificationMail;
use App\Models\Notification;
use App\Models\Patient;
use App\Models\Post;
use App\Models\StatusType;
use App\Models\Student;
use App\Models\StudentMark;
use App\Models\Supervisor;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;


class PostController extends Controller
{
    public function index(Request $request)
    {
        $sortType = $request->input('sort_type', 'created_at');
        $sortOrder = $request->input('sort_order', 'desc');
        $filterStatus = $request->input('filter_status', 'all');

        $postsQuery = Post::join('users', 'posts.id', '=', 'users.id')
            ->join('status_types', 'posts.t_id', '=', 'status_types.t_id')
            ->leftJoin('students', 'posts.id', '=', 'students.id')
            ->select('posts.*', 'users.name as user_name', 'users.role as user_role', 'status_types.name as status_name', 'students.rating as student_rating');

        if ($filterStatus !== 'all') {
            if ($filterStatus == 'طلب معالجة') {
                $postsQuery->where('users.role', 'student');
            } else if ($filterStatus == 'طلب حالة') {
                $postsQuery->where('users.role', '!=', 'student');
            }
        }

        $posts = $postsQuery->orderBy($sortType, $sortOrder)->get();

        $statusTypes = StatusType::all();
        $average = 0;

        if (auth()->user()->role == 'student') {
            $student = Student::where('id', auth()->user()->id)->first();

            if ($student) {
                $marks = StudentMark::where('st_id', '=', $student->st_id)->get();

                if ($marks->count() >= 9) {
                    $average = $marks->avg('mark') % 50;
                } else {
                    $average = 0;
                }

                $student->rating = $average;
                $student->save();
            }
        }

        $user = auth()->user();
        $notifications = collect();

        if ($user->role == 'student') {
            $student1 = Student::where('id', $user->id)->first();
            if ($student1) {
                $notifications = Notification::where('st_id', $student1->st_id)
                    ->whereIn('type', [1, 3, 5, 12])
                    ->get();
            }
        } elseif ($user->role == 'patient') {
            $patient = Patient::where('id', $user->id)->first();
            if ($patient) {
                $notifications = Notification::where('p_id', $patient->p_id)
                    ->whereIn('type', [2, 4, 6, 11])
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

        // تحليل الإشعارات وتحديد المنشورات ذات الإشعارات ذات الصلة
        $notificationPostIds = [];
        foreach ($notifications as $notification) {
            if ($notification->type == 11) {
                $notificationPostIds[] = $notification->po_id;
            }
        }

        $count = $notifications->count();

        return view('dashboard', compact('posts', 'statusTypes', 'average', 'sortType', 'sortOrder', 'filterStatus', 'notifications', 'count', 'notificationPostIds'));
    }



    public function store(Request $request)
    {
        $request->validate([
            't_id' => 'required|exists:status_types,t_id',
            'Description' => 'required|string|max:255',
            'images' => 'array|max:7',
            'images.*' => 'image|mimes:jpeg,png,jpg,gif,svg,bmp,tiff|max:4096', // زيادة أنواع الصور المسموح بها وزيادة حجم الملف إلى 4 ميجابايت
        ]);


        $images = [];
        if ($request->hasfile('images')) {
            foreach ($request->file('images') as $image) {
                $originalName = $image->getClientOriginalName();
                $cleanedName = Str::slug(pathinfo($originalName, PATHINFO_FILENAME)) . '.' . $image->getClientOriginalExtension();
                $name = time() . '_' . $cleanedName;
                $image->storeAs('public/posts', $name);
                $images[] = 'posts/' . $name;
            }
        }

        $post = new Post();
        $post->id = auth()->id();
        $post->t_id = $request->t_id;
        $post->Description = $request->Description;
        $post->images = json_encode($images);
        $post->save();

        return redirect()->route('dashboard')->with('success', 'تم نشر المنشور بنجاح!');
    }

    public function edit($id)
    {
        $post = Post::findOrFail($id);
        if (auth()->user()->id !== $post->id) {
            return redirect()->route('dashboard')->with(['error' => 'ليس لديك صلاحية لتعديل هذا المنشور!']);
        }
        $statusTypes = StatusType::all();
        return view('posts.edit', compact('post', 'statusTypes'));
    }

    public function update(Request $request, $id)
    {
        $post = Post::findOrFail($id);
        if (auth()->user()->id !== $post->id) {
            return redirect()->route('dashboard')->withErrors(['error' => 'يمكنك تعديل فقط المنشورات التي قمت بنشرها!']);
        }

        $request->validate([
            't_id' => 'required|exists:status_types,t_id',
            'Description' => 'required|string|max:255',
            'images' => 'array|max:7',
            'images.*' => 'image|mimes:jpeg,png,jpg,gif,svg,bmp,tiff|max:4096', // زيادة أنواع الصور المسموح بها وزيادة حجم الملف إلى 4 ميجابايت
        ]);


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

        return redirect()->route('dashboard')->with('success', 'تم تعديل المنشور بنجاح!');
    }


    public function destroy($id)
    {
        $post = Post::findOrFail($id);
        $images = json_decode($post->images, true);

        foreach ($images as $image) {
            Storage::delete('public/' . $image);
        }

        $post->delete();
        return redirect()->route('dashboard')->with('success', 'تم حذف المنشور!');
    }

    public function showRequestTreatmentForm(Request $request)
    {
        $supervisors = Supervisor::where('check_state','=','1')->get(); // احضر جميع المشرفين من قاعدة البيانات
        return view('posts.request_treatment', compact('supervisors'));
    }
    public function showRequestTreatmentForm2(Request $request)
    {
        return view('posts.treat2');
    }

    public function confirmRequestTreatment(Request $request)
    {
        // الحصول على معرف الطالب من الطلب
        $postId = $request->post_id;
        $post = Post::find($postId);

        // التحقق من وجود المنشور
        if (!$post) {
            return redirect()->route('dashboard')->with('error', 'المنشور غير موجود.');
        }

        $studentId = $post->id;

        // العثور على الطالب باستخدام جدول students
        $student = DB::table('students')->where('id', $studentId)->first();

        // التحقق من وجود الطالب
        if (!$student) {
            return redirect()->route('dashboard')->with('error', 'الطالب غير موجود.');
        }

        // العثور على المستخدم باستخدام جدول users
        $studentUser = User::find($student->id);

        // التحقق من وجود المستخدم
        if (!$studentUser) {
            return redirect()->route('dashboard')->with('error', 'المستخدم غير موجود.');
        }

        // الحصول على رقم هاتف الطالب
        $studentPhoneNumber = $studentUser->phone;

        // الحصول على المستخدم الحالي (المريض)
        $currentUser = auth()->user();

        // العثور على المريض في جدول patients باستخدام معرف المستخدم
        $patient = DB::table('patients')->where('id', $currentUser->id)->first();

        // التحقق من وجود المريض
        if (!$patient) {
            return redirect()->route('dashboard')->with('error', 'المريض غير موجود.');
        }

        // إنشاء وصف الإشعار
        $description = "الرجاء التوصل مع الطالب وهذا هو رقم الطالب: $studentPhoneNumber";

        // إنشاء الإشعار الجديد
        Notification::create([
            'p_id' => $patient->p_id, // استخدام معرف المريض من جدول patients
            's_id' => '1',
            'st_id' => $student->st_id,
            'po_id' => $postId,
            'Description' => $description,
            'type' => 11
        ]);

        $description1 = "لقد ارسل مريض طلبا الى حالتك , ترقب مكالمة منه.";
        Notification::create([
            'p_id' => $patient->p_id, // استخدام معرف المريض من جدول patients
            's_id' => '1',
            'st_id' => $student->st_id,
            'po_id' => $postId,
            'Description' => $description1,
            'type' => 12
        ]);

        // إعادة التوجيه إلى لوحة التحكم مع رسالة نجاح
        return redirect()->route('dashboard')->with('success', 'تم تأكيد الطلب بنجاح.');
    }






    public function submitRequest(Request $request)
    {
        $supervisor_id = $request->input('supervisor_id');
        $post_id = $request->input('post_id');

        // احصل على البوست
        $post = Post::find($post_id);

        // تعريف المتغير $patient_id كقيمة افتراضية null
        $patient_id = null;

        if ($post) {
            \Log::info('Post found: ' . $post->id);
            $user = $post->user;
            if ($user) {
                \Log::info('User found: ' . $user->id);
                $patient = Patient::where('id', $user->id)->first();
                if ($patient) {
                    \Log::info('Patient found: ' . $patient->p_id);
                    $patient_id = $patient->p_id; // التأكد من استخدام p_id بدلاً من id
                } else {
                    \Log::info('Patient not found for user: ' . $user->id);
                }
            } else {
                \Log::info('User not found for post: ' . $post->id);
            }
        } else {
            \Log::info('Post not found: ' . $post_id);
        }

        if (!$patient_id) {
            return redirect()->route('dashboard')->with('error', 'لا يمكن العثور على معرف المريض.');
        }

        // احصل على معرف الطالب المسجل حاليا
        $student = Student::where('id', auth()->id())->first();

        if (!$student) {
            return redirect()->route('dashboard')->with('error', 'لا يمكن العثور على معرف الطالب.');
        }

        $student_id = $student->st_id;

        // احصل على المشرف
        $supervisor = Supervisor::find($supervisor_id);

        if (!$supervisor) {
            return redirect()->route('dashboard')->with('error', 'لا يمكن العثور على المشرف.');
        }

        // احصل على المستخدم المرتبط بالمشرف
        $supervisor_user = $supervisor->user;

        if (!$supervisor_user) {
            return redirect()->route('dashboard')->with('error', 'لا يمكن العثور على معلومات المستخدم للمشرف.');
        }

        $supervisor_name = $supervisor_user->name;
        $supervisor_email = $supervisor_user->email;

        // أنشئ الإشعار الجديد
        Notification::create([
            'p_id' => $patient_id,
            's_id' => $supervisor->s_id,
            'st_id' => $student_id,
            'po_id' => $post_id,
            'Description' => "رسالة للدكتور {$supervisor_name} لديك حالة الرجاء مراجعتها",
            'type' => 0,
        ]);

        // تحديث حالة البوست إلى "معلقة"
        $post->state = 3;
        $post->save();

        // إرسال البريد الإلكتروني باستخدام Mailable
        Mail::to($supervisor_email)->send(new NotificationMail($supervisor_name));

        return redirect()->route('dashboard')->with('success', 'تم إرسال طلبك بنجاح .');
    }

// app/Http/Controllers/PostController.php



// ...

    public function sendRequest(Request $request, $postId)
    {
        $post = Post::findOrFail($postId);

        // تحقق من أن المستخدم طالب وأن الحالة هي لمريض
        if (auth()->user()->role != 'student' && auth()->user()->role != 'patient') {
            return response()->json(['success' => false, 'message' => 'ليس لديك الصلاحية لإرسال الطلب.'], 403);
        }

        // تحقق من حالة البوست (ينبغي أن تكون الحالة متاحة)
        if ($post->state != 0) {
            return response()->json(['success' => false, 'message' => 'هذه الحالة غير متاحة لإرسال الطلب.'], 400);
        }

        // تحديث حالة البوست إلى معلقة (3)
        $post->state = 3;
        $post->save();

        // إنشاء إشعار جديد
        $notification = new Notification();
        $notification->user_id = auth()->user()->id;
        $notification->post_id = $postId;
        $notification->message = 'تم إرسال طلب جديد للبوست رقم ' . $postId;
        $notification->save();

        return response()->json(['success' => true, 'message' => 'تم إرسال الطلب بنجاح!']);
    }

    private function updateStudentRating($studentId)
    {
        $student = Student::where('id', $studentId)->first();

        if ($student) {
            // حساب متوسط العلامات للطالب
            $marks = StudentMark::where('st_id', '=', $student->st_id)->get();
            $average = $marks->count() >= 9 ? $marks->avg('mark') % 50 : 0;

            // جمع جميع تقييمات المرضى للطالب من جدول notifications
            $allPatientRates = Notification::where('st_id', $student->st_id)
                ->join('posts', 'notifications.po_id', '=', 'posts.id')
                ->sum('posts.patient_rate');

            // حساب التقييم الكلي الجديد للطالب
            $newRating = ($average + $allPatientRates);

            // تحديث التقييم الكلي في حقل students.rating
            $student->rating = $newRating;
            $student->save();
        }
    }

    public function rateStudent(Request $request, $id)
    {
        $request->validate([
            'rating' => 'required|integer|min:1|max:5',
        ]);

        $post = Post::findOrFail($id);

        // تحديث قيمة patient_rate في البوست
        $post->patient_rate = $request->rating;
        $post->save();

        // العثور على الطالب المرتبط بالبوست من جدول notifications
        $notification = Notification::where('po_id', $post->id)->first();

        if ($notification) {
            // تحديث التقييم الكلي للطالب
            $this->updateStudentRating($notification->st_id);
        }

        return redirect()->route('dashboard')->with('success', 'تم تقديم التقييم بنجاح.');
    }




}
