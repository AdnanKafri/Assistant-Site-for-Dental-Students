<?php
namespace App\Http\Controllers;

use App\Http\Requests\ProfileUpdateRequest;
use App\Models\Notification;
use App\Models\Patient;
use App\Models\Post;
use App\Models\StatusType;
use App\Models\Student;
use App\Models\StudentMark;
use App\Models\Subject;
use App\Models\Supervisor;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\View\View;

class ProfileController extends Controller
{
    /**
     * Display the user's profile form.
     */
    public function edit(Request $request): View
    {
        $user = $request->user();
        $marks = collect(); // تعيين قيمة افتراضية
        $subjects = collect(); // تعيين قيمة افتراضية

        if ($user->role == 'student') {
            $userId = Student::where('id', $user->id)->first()->st_id;
            $marks = StudentMark::with('subject')->where('st_id', $userId)->get();
            $subjects = Subject::all(); // جلب جميع المواد
        }

        $user1 = auth()->user();
        $notifications = collect();

        if ($user1->role == 'student') {
            $student1 = Student::where('id', $user1->id)->first();
            if ($student1) {
                $notifications = Notification::where('st_id', $student1->st_id)
                    ->whereIn('type', [1, 3, 5,12]) // إضافة النوع 10
                    ->get();
            }
        } elseif ($user1->role == 'patient') {
            $patient = Patient::where('id', $user1->id)->first();
            if ($patient) {
                $notifications = Notification::where('p_id', $patient->p_id)
                    ->whereIn('type', [2, 4, 6, 11]) // إضافة النوع 10
                    ->get();
            }
        } elseif ($user1->role == 'supervisor') {
            $super = Supervisor::where('id', $user1->id)->first();
            if ($super) {
                $notifications = Notification::where('s_id', $super->s_id)
                    ->where('type', 0)
                    ->get();
            }
        }
        $count = $notifications->count();


        return view('profile.edit', [
            'user' => $user,
            'marks' => $marks,
            'subjects' => $subjects, // تمرير المواد إلى العرض
            'count' => $count, // تمرير المواد إلى العرض
            'notifications' => $notifications, // تمرير المواد إلى العرض
        ]);
    }

    /**
     * Update the user's profile information.
     */
    public function update(ProfileUpdateRequest $request): RedirectResponse
    {
        $request->user()->fill($request->validated());

        if ($request->user()->isDirty('email')) {
            $request->user()->email_verified_at = null;
        }

        $request->user()->save();

        return Redirect::route('profile.edit')->with('status', 'profile-updated');
    }

    /**
     * Delete the user's account.
     */
    public function destroy(Request $request): RedirectResponse
    {
        $request->validateWithBag('userDeletion', [
            'password' => ['required', 'current_password'],
        ]);

        $user = $request->user();

        Auth::logout();

        $user->delete();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return Redirect::to('/');
    }
    public function show()
    {
        $user = auth()->user();
        $posts = Post::where('id', $user->id)->get();
        $status = StatusType::all();


        $notifications = collect();

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

        return view('share', compact('user', 'posts', 'status', 'notifications', 'count'));
    }
}
