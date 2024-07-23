<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CheckAdminEmail
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {
        $user = Auth::user();
        $allowedEmail = 'admin@aid.com'; // استبدل هذا البريد الإلكتروني بالبريد الإلكتروني للمستخدم المسموح له

        if ($user && $user->email === $allowedEmail) {
            return $next($request);
        }

        return redirect('/'); // إعادة التوجيه إلى الصفحة الرئيسية إذا لم يكن المستخدم مصرحًا له
    }


}
