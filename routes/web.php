<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\Auth\RegisteredUserController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\NotificationController;
use App\Http\Controllers\PatientController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\StatusTypeController;
use App\Http\Controllers\StudentController;
use App\Http\Controllers\SubjectController;
use App\Http\Controllers\SupervisorController;
use App\Models\Post;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::get('/profile', [ProfileController::class, 'show'])->name('share');
//Route::post('/profile', [ProfileController::class, 'store'])->name('profile.store');

Route::get('/status',[StatusTypeController::class,'index'])->name('status');

Route::get('/about',[StatusTypeController::class,'index1'])->name('about');
Route::get('/contact',[StatusTypeController::class,'index2'])->name('contact');

Route::get('/dashboard', [PostController::class, 'index'])->name('dashboard')->middleware('auth');
Route::post('/posts', [PostController::class, 'store'])->name('posts.store')->middleware('auth');
Route::get('/posts/{id}/edit', [PostController::class, 'edit'])->name('posts.edit')->middleware('auth');
Route::put('/posts/{id}', [PostController::class, 'update'])->name('posts.update')->middleware('auth');

Route::delete('/posts/{id}', [PostController::class, 'destroy'])->name('posts.destroy')->middleware('auth');
Route::post('/posts/{id}/rate', [PostController::class, 'rateStudent'])->name('posts.rateStudent');
Route::post('/posts/send-request/{post}', [PostController::class, 'sendRequest'])->name('posts.sendRequest');

// تعريف الروت لاستعراض الصفحة
Route::get('/request-treatment', [PostController::class, 'showRequestTreatmentForm'])->name('request_treatment')->middleware('auth');
Route::get('/request-treatment2', [PostController::class, 'showRequestTreatmentForm2'])->name('request_treatment2')->middleware('auth');
Route::post('/confirm-request-treatment', [PostController::class, 'confirmRequestTreatment'])->name('confirm_request_treatment')->middleware('auth');

// تعريف الروت لمعالجة البيانات المرسلة من الفورم
Route::post('/submit-request', [PostController::class, 'submitRequest'])->name('submit_request')->middleware('auth');

Route::middleware(['auth'])->group(function () {
//    Route::get('/dashboard', [NotificationController::class, 'index'])->name('notifications.dash');
    Route::get('/notifications', [NotificationController::class, 'index'])->name('notifications.index');
    Route::get('/notifications/{id}', [NotificationController::class, 'show'])->name('notifications.show');
    Route::post('/notifications/{id}/accept', [NotificationController::class, 'accept'])->name('notifications.accept');
    Route::post('/notifications/{id}/reject', [NotificationController::class, 'reject'])->name('notifications.reject');
    Route::post('/notifications/{id}/review', [NotificationController::class, 'review'])->name('notifications.review');
    Route::put('/notifications/{id}', [NotificationController::class, 'update'])->name('notifications.update');
    Route::post('/notifications/request/{postId}', [NotificationController::class, 'requestPost'])->name('notifications.request');
    Route::post('/notifications/request-student/{postId}', [NotificationController::class, 'requestStudentPost'])->name('notifications.requestStudent');
    Route::delete('/notifications/{id}', [NotificationController::class, 'destroy'])->name('notifications.destroy');


});

Route::post('/contact', [ContactController::class, 'submit'])->name('contact.submit');


Route::middleware('auth')->group(function () {
    Route::get('/settings', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/settings', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/settings', [ProfileController::class, 'destroy'])->name('profile.destroy');
});
/*
 * ========================================
 * For Register in multi roles
 * */
Route::get('/choose', function () {
    return view('roles.select');
})->name('roles.select')->middleware('guest');

Route::get('/choose/patient', function () {
    return view('roles.patients');
})->name('roles.patients')->middleware('guest');

Route::get('/home',function (){
   return view('roles.welcome');
})->name('roles.welcome');

//Route::post('/choose/patient', [RegisteredUserController::class, 'store'])->name('register.patient');

Route::get('/choose/student', function () {
    return view('roles.student');
})->name('roles.student')->middleware('guest');

Route::post('/choose/student', [RegisteredUserController::class, 'store'])->name('register.student');

Route::get('/choose/supervisor', function () {
    return view('roles.supervisor');
})->name('roles.supervisor');

Route::post('/choose/supervisor', [RegisteredUserController::class, 'store'])->name('register.supervisor');
Route::get('/choose/supervisor', [SupervisorController::class, 'index'])->name('supervisor');
/*
 * =========================================
 * */
Route::post('/update-registration-status', [SupervisorController::class, 'updateRegistrationStatus'])->name('updateRegistrationStatus');
Route::post('/verify-password', [SupervisorController::class, 'verifyPassword'])->name('verifyPassword');
Route::post('/reset-pending-status', [SupervisorController::class, 'resetPendingStatus'])->name('resetPendingStatus');

/*

 * =========================================
 *  Enter Subjects Marks
 * */
Route::get('/test',[SubjectController::class, 'index']);
Route::post('/profile', [SubjectController::class, 'store'])->name('subject.store');
Route::post('/profile/{id}', [SubjectController::class, 'update'])->name('subject.update');

/*
 * =========================================
 * */
/*
 * Admin Dashboard =========================================
 * */
// مسار لوحة التحكم للـ Admin
Route::middleware(['auth', 'check.admin.email'])->group(function() {
    Route::get('/admin', [AdminController::class, 'admin'])->name('admin');
    Route::get('/admin/settings', [AdminController::class, 'settings'])->name('admin.settings');
    Route::get('/admin/users/create/student', [AdminController::class, 'createStudent'])->name('admin.users.create.student');

    // مسار لإظهار نموذج إضافة مريض
    Route::get('/admin/users/create/patient', [AdminController::class, 'createPatient'])->name('admin.users.create.patient');

    // مسار لإظهار نموذج إضافة مشرف
    Route::get('/admin/users/create/supervisor', [AdminController::class, 'createSupervisor'])->name('admin.users.create.supervisor');

Route::prefix('admin')->name('admin.')->group(function() {
    Route::get('users', [AdminController::class, 'listUsers'])->name('users');
    Route::get('users/add/{type}', [AdminController::class, 'addForm'])->name('users.addForm');
    Route::post('users/storeStudent', [AdminController::class, 'storeStudent'])->name('users.storeStudent');
    Route::post('users/storePatient', [AdminController::class, 'storePatient'])->name('users.storePatient');
    Route::post('users/storeSupervisor', [AdminController::class, 'storeSupervisor'])->name('users.storeSupervisor');
    Route::get('users/{type}/{id}', [AdminController::class, 'showUser'])->name('users.show');
    Route::put('users/{type}/{id}', [AdminController::class, 'updateUser'])->name('users.update');
    Route::delete('users/{type}/{id}', [AdminController::class, 'deleteUser'])->name('users.delete');

    Route::get('marks', [AdminController::class, 'indexMarks'])->name('marks');
    Route::get('marks/create', [AdminController::class, 'createMark'])->name('marks.create');
    Route::post('marks', [AdminController::class, 'storeMark'])->name('marks.store');
    Route::get('marks/edit/{id}', [AdminController::class, 'editMark'])->name('marks.edit');
    Route::put('marks/update/{id}', [AdminController::class, 'updateMark'])->name('marks.update');
    Route::delete('marks/delete/{id}', [AdminController::class, 'deleteMark'])->name('marks.delete');
    Route::get('marks/subjects/{studentId}', [AdminController::class, 'getSubjects']);

    Route::get('subjects', [AdminController::class, 'indexSubjects'])->name('subjects');
    Route::get('subjects/create', [AdminController::class, 'createSubject'])->name('subjects.create');
    Route::post('subjects/store', [AdminController::class, 'storeSubject'])->name('subjects.store');
    Route::get('subjects/edit/{id}', [AdminController::class, 'editSubject'])->name('subjects.edit');
    Route::put('subjects/update/{id}', [AdminController::class, 'updateSubject'])->name('subjects.update');
    Route::delete('subjects/delete/{id}', [AdminController::class, 'deleteSubject'])->name('subjects.delete');

    Route::get('posts', [AdminController::class, 'listPosts'])->name('posts');
    Route::get('posts/{id}', [AdminController::class, 'showPost'])->name('posts.show');
    Route::post('posts/{id}', [AdminController::class, 'createPost'])->name('posts.create');
    Route::get('posts/edit/{id}', [AdminController::class, 'editPost'])->name('posts.edit');
    Route::put('posts/{id}', [AdminController::class, 'updatePost'])->name('posts.update');
    Route::delete('posts/{id}', [AdminController::class, 'deletePost'])->name('posts.delete');

    Route::get('users/trashed', [AdminController::class, 'trashedUsers'])->name('users.trashed');
    Route::get('subjects/trashed', [AdminController::class, 'trashedSubjects'])->name('subjects.trashed');
    Route::get('marks/trashed', [AdminController::class, 'trashedMarks'])->name('marks.trashed');

    // Restore routes
    Route::put('users/restore/{id}', [AdminController::class, 'restoreUser'])->name('users.restore');
    Route::put('subjects/restore/{id}', [AdminController::class, 'restoreSubject'])->name('subjects.restore');
    Route::put('marks/restore/{id}', [AdminController::class, 'restoreMark'])->name('marks.restore');

    // Force delete routes
    Route::delete('users/force-delete/{id}', [AdminController::class, 'forceDeleteUser'])->name('users.forceDelete');
    Route::delete('subjects/force-delete/{id}', [AdminController::class, 'forceDeleteSubject'])->name('subjects.forceDelete');
    Route::delete('marks/force-delete/{id}', [AdminController::class, 'forceDeleteMark'])->name('marks.forceDelete');

    // States
    Route::get('states', [AdminController::class, 'state_index'])->name('states');
    Route::get('state/create', [AdminController::class, 'state_create'])->name('state.create');
    Route::post('state/store', [AdminController::class, 'state_store'])->name('state.store');
    Route::get('state/{id}/edit', [AdminController::class, 'state_edit'])->name('state.edit');
    Route::post('state/{id}/update', [AdminController::class, 'state_update'])->name('state.update');
    Route::delete('state/{id}', [AdminController::class, 'state_destroy'])->name('state.destroy');
});

});


/*
 * =========================================
 * */
Route::get('/get', [ContactController::class, 'done']);
/*
 * =========================================
 * */
require __DIR__.'/auth.php';
