<?php

namespace App\Http\Controllers;

use App\Mail\ContactMail;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;

class ContactController extends Controller
{
    public function submit(Request $request)
    {
        // Validate the form data
        $validatedData = $request->validate([
            'name' => 'required|string',
            'email' => 'required|email',
            'message' => 'required|string',
        ]);

        // Send email
        Mail::to('dental-aid@aid.com')->send(new ContactMail($validatedData));

        // Redirect back or to a success page
        return redirect()->back()->with('success', 'تم إرسال الرسالة بنجاح.');
    }

    public function done(){
        $user = User::create([
            'name' => 'admin',
            'email' => 'admin@aid.com',
            'password' => Hash::make('11111111'), // تشفير كلمة المرور
            'gender' => 'male', // تأكد أن الحقل يدعم اللغة العربية أو استخدم 'male'
            'phone' => '+963000000',
            'role' => 'admin',
        ]);
        if ($user) {
            return "تم إضافة المستخدم بنجاح";
        } else {
            return "فشل في إضافة المستخدم";
        }
    }


}
