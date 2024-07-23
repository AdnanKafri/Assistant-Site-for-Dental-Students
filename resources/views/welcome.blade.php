@extends("layouts.navb")
@section('title', 'Welcome')

@section('content')
    <style>

        .rtl {
            direction: rtl;
            text-align: right; /* اختيارية */
        }
    </style>
    <main class="flex-1 p-6 main-content ">
        <div class="space-y-6 p-6 bg-white bg-opacity-80 rounded-lg shadow-lg rtl">

            <h2 class="text-center text-4xl font-bold text-blue-600 mb-4">مرحبًا بكم في موقع "مساعد لطلاب الأسنان"!</h2>
            <p class="text-lg text-gray-800 leading-relaxed">
                نحن هنا لنساعدكم في تأمين حالات التدريب العملي بكل سهولة ويسر. تواصلوا مع المرضى وابدأوا في تطوير مهاراتكم السريرية اليوم. معًا نحو مستقبل أفضل في مجال طب الأسنان.            </p>


            <h2 class="text-center text-4xl font-bold text-blue-600 mb-4">
                <a href="{{route('dashboard')}}" class="rtl text-center">لنبدأ !</a>
            </h2>
        </div>
        <br>

        <br>
        <br>
        <br>
        <br>
        <div class="space-y-6 p-6 bg-white bg-opacity-80 rounded-lg shadow-lg">
            <h2 class="text-center text-4xl font-bold text-blue-600 mb-4">Welcome to "Dental Student Aid"!</h2>
            <p class="text-lg text-gray-800 leading-relaxed">
                We are here to assist you in securing practical training cases with ease. Connect with patients and start enhancing your clinical skills today. Together towards a better future in dentistry.            </p>

            <h2 class="text-center text-4xl font-bold text-blue-600 mb-4">
                <a href="{{route('dashboard')}}">Get Started!</a>
            </h2>
        </div>

    </main>
@endsection
