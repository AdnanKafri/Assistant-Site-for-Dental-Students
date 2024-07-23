<?php

namespace App\Http\Controllers;

use App\Models\Notification;
use App\Models\Student;
use App\Models\Patient;
use App\Models\Post;
use App\Models\Supervisor;
use Illuminate\Http\Request;

class NotificationController extends Controller
{
    public function index()
    {
        $user = auth()->user();
        $notifications = collect();

        if ($user->role == 'student') {
            $student1 = Student::where('id', $user->id)->first();
            if ($student1) {
                $notifications = Notification::where('st_id', $student1->st_id)
                    ->whereIn('type', [1, 3, 5, 12]) // إضافة النوع 10
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

        $patient1 = Patient::where('id', $user->id)->first();
        return view('dashboard', compact('notifications',count));
    }

    public function show($id)
    {
        $user = auth()->user();
        $notifications = collect();

        if ($user->role == 'student') {
            $student1 = Student::where('id', $user->id)->first();
            if ($student1) {
                $notifications = Notification::where('st_id', $student1->st_id)
                    ->whereIn('type', [1, 3, 5, 12]) // إضافة النوع 10
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

        // Ensure 'student.user' relationship is eager loaded
        $notification1 = Notification::with(['student.user', 'patient.user', 'post'])
            ->where('n_id', $id)
            ->firstOrFail();

        return view('noti.notification-detail', compact('notification1', 'notifications', 'count'));
    }

    public function accept(Request $request, $id)
    {
        $notification = Notification::where('n_id', $id)->firstOrFail();
        $student = Student::where('st_id', $notification->st_id)->first();
        $patient = Patient::where('p_id', $notification->p_id)->first();

        if (!$student) {
            return redirect()->back()->with('error', 'لم يتم العثور على الطالب المرتبط بالإشعار.');
        }

        if (!$patient) {
            return redirect()->back()->with('error', 'لم يتم العثور على المريض المرتبط بالإشعار.');
        }

        Notification::create([
            'p_id' => $patient->p_id,
            's_id' => $notification->s_id,
            'st_id' => $student->st_id,
            'po_id' => $notification->po_id,
            'Description' => 'تم قبول الحالة الخاصة بالمستخدم ' . $patient->user->name . ' الرجاء الانتظار حتى يتواصل معك المريض',
            'type' => 1,
        ]);

        Notification::create([
            'p_id' => $patient->p_id,
            's_id' => $notification->s_id,
            'st_id' => $student->st_id,
            'po_id' => $notification->po_id,
            'Description' => 'لقد تم قبول حالتكم "' . $notification->post->Description . '" وهذا رقم الطالب الرجاء التواصل معه: ' . $student->user->phone,
            'type' => 2,
        ]);

        // Update the state of the post to "2"
        $post = Post::where('po_id', $notification->po_id)->first();
        if ($post) {
            $post->update(['state' => 2]);
        }

        // Update the original notification type to indicate action has been taken
        $notification->update(['type' => 7]); // نوع جديد يشير إلى أن العملية تمت

        return redirect()->back()->with('success', 'تم قبول الحالة وإرسال الإشعارات.');
    }

    public function reject(Request $request, $id)
    {
        $notification = Notification::where('n_id', $id)->firstOrFail();
        $student = Student::where('st_id', $notification->st_id)->first();
        $patient = Patient::where('p_id', $notification->p_id)->first();

        if (!$student) {
            return redirect()->back()->with('error', 'لم يتم العثور على الطالب المرتبط بالإشعار.');
        }

        if (!$patient) {
            return redirect()->back()->with('error', 'لم يتم العثور على المريض المرتبط بالإشعار.');
        }

        Notification::create([
            'p_id' => $patient->p_id,
            's_id' => $notification->s_id,
            'st_id' => $student->st_id,
            'po_id' => $notification->po_id,
            'Description' => 'تم رفض حالة المريض ' . $patient->user->name,
            'type' => 3,
        ]);

        Notification::create([
            'p_id' => $patient->p_id,
            's_id' => $notification->s_id,
            'st_id' => $student->st_id,
            'po_id' => $notification->po_id,
            'Description' => 'نعتذر لرفض حالتكم لعدم تحقيقها الشروط المطلوبة ونتمنى لكم السلامة',
            'type' => 4,
        ]);

        // Update the state of the post to "1"
        $post = Post::where('po_id', $notification->po_id)->first();
        if ($post) {
            $post->update(['state' => 1]);
        }

        // Update the original notification type to indicate action has been taken
        $notification->update(['type' => 8]); // نوع جديد يشير إلى أن العملية تمت

        return redirect()->back()->with('success', 'تم رفض الحالة وإرسال الإشعارات.');
    }

    public function review(Request $request, $id)
    {
        $notification = Notification::where('n_id', $id)->firstOrFail();
        $student = Student::where('st_id', $notification->st_id)->first();
        $patient = Patient::where('p_id', $notification->p_id)->first();

        if (!$student) {
            return redirect()->back()->with('error', 'لم يتم العثور على الطالب المرتبط بالإشعار.');
        }

        if (!$patient) {
            return redirect()->back()->with('error', 'لم يتم العثور على المريض المرتبط بالإشعار.');
        }

        Notification::create([
            'p_id' => $patient->p_id,
            's_id' => $notification->s_id,
            'st_id' => $student->st_id,
            'po_id' => $notification->po_id,
            'Description' => 'الرجاء مرافقة المريض إلى الجامعة لإجراء تشخيص دقيق للحالة. انتظر مكالمة المريض.',
            'type' => 5,
        ]);

        Notification::create([
            'p_id' => $patient->p_id,
            's_id' => $notification->s_id,
            'st_id' => $student->st_id,
            'po_id' => $notification->po_id,
            'Description' => 'لم نستطع تشخيص الحالة بشكل مناسب. الرجاء التواصل مع الطالب ' . $student->user->name . ' ورقمه ' . $student->user->phone . ' للاتفاق على موعد للتشخيص الدقيق بالجامعة.',
            'type' => 6,
        ]);

        // Update the state of the post to "2"
        $post = Post::where('po_id', $notification->po_id)->first();
        if ($post) {
            $post->update(['state' => 2]);
        }

        // Update the original notification type to indicate action has been taken
        $notification->update(['type' => 9]); // نوع جديد يشير إلى أن العملية تمت

        return redirect()->back()->with('success', 'تمت مراجعة الحالة وإرسال الإشعارات.');
    }



    public function update(Request $request, $id)
    {
        $action = $request->input('action');
        if ($action == 'accept') {
            return $this->accept($request, $id);
        } elseif ($action == 'reject') {
            return $this->reject($request, $id);
        } elseif ($action == 'review') {
            return $this->review($request, $id);
        }
        return redirect()->back()->with('error', 'حدث خطأ غير متوقع.');
    }

    public function requestPost($postId)
    {
        $user = auth()->user();

        if ($user->role != 'patient') {
            return response()->json(['success' => false, 'message' => 'فقط المرضى يمكنهم إرسال الطلبات.'], 403);
        }

        $post = Post::with('user')->findOrFail($postId);

        if ($post->user->role != 'student') {
            return response()->json(['success' => false, 'message' => 'يمكنك فقط إرسال طلبات إلى بوستات الطلاب.'], 403);
        }

        Notification::create([
            'p_id' => $user->patient->p_id,
            's_id' => null,
            'st_id' => $post->user->student->st_id,
            'po_id' => $postId,
            'Description' => 'لديك حالة جديدة من قبل المريض ' . $user->name . ' الرجاء الانتظار إلى أن يتواصل معك المريض.',
            'type' => 10,
        ]);

        return response()->json(['success' => true]);
    }
    public function requestStudentPost($postId)
    {
        $user = auth()->user();

        if ($user->role != 'patient') {
            return response()->json(['success' => false, 'message' => 'فقط المرضى يمكنهم إرسال الطلبات.'], 403);
        }

        $post = Post::with('user')->findOrFail($postId);

        if ($post->user->role != 'student') {
            return response()->json(['success' => false, 'message' => 'يمكنك فقط إرسال طلبات إلى بوستات الطلاب.'], 403);
        }

        // إنشاء إشعار جديد
        Notification::create([
            'p_id' => $user->patient->p_id,
            's_id' => null,
            'st_id' => $post->user->student->st_id,
            'po_id' => $postId,
            'Description' => 'لديك حالة جديدة من قبل المريض ' . $user->name . ' الرجاء الانتظار إلى أن يتواصل معك المريض.',
            'type' => 10,
        ]);

        return response()->json(['success' => true, 'message' => 'تم إرسال الطلب بنجاح.']);
    }

    public function destroy($id)
    {
        $notification = Notification::find($id);

        if ($notification) {
            $notification->delete();
            return response()->json(['success' => true]);
        }

        return response()->json(['success' => false], 404);
    }
}
