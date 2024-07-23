<!DOCTYPE html>
<html lang="ar">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Supervisor Registration</title>
    <link rel="website icon" type="png" href="{{ asset('images/img.png') }}">
    <link rel="stylesheet" href="{{ asset('css/cs.css') }}">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.css">
</head>
<style>
    .rtl {
        direction: rtl;
        text-align: right; /* اختيارية */
    }
</style>
<body>
<div class="header">

    <a href="{{ url()->previous() }}" class="back-button">← Back</a>
    <div class="logo">
        <h1 class="text-2xl font-semibold text-black">Dental Aid</h1>
        <a href="{{ url('/') }}">
            <img src="{{ asset('images/img.png') }}" alt="Logo">
        </a>
    </div>
</div>

<div class="container">
    @foreach($data as $index => $super)
        @foreach($d1 as $user)
            @if($super->id == $user->id)
                <div class="card {{ $super->check_state == 1 ? 'registered' : ($super->check_state == 0 ? 'not-registered' : 'pending') }}"
                     id="card-{{ $index }}"
                     data-email="{{ $user->email }}"
                     data-name="{{ $user->name }}"
                     data-state="{{ $super->check_state }}">
                    <img src="{{ asset('storage/' . $super->photo) }}" alt="{{ $user->name }}">
                    <h2>{{ $user->name }}</h2>
                    <p>{{ $user->email }}</p>
                    <p dir="ltr">{{ substr($user->phone, 0, 4) . str_repeat('*', strlen($user->phone) - 4) }}</p>
                    <span class="status">{{ $super->check_state == 1 ? 'مسجل' : ($super->check_state == 0 ? 'غير مسجل' : 'معلق') }}</span>
                </div>
            @endif
        @endforeach
    @endforeach
</div>

<!-- نافذة إدخال كلمة المرور -->
<div id="modal" class="modal">
    <div class="modal-content">
        <span class="close">&times;</span>
        <p>الرجاء إدخال كلمة السر المرسلة إلى <span id="email-span"></span></p>
        <br>
        <input type="password" id="password-input" placeholder="كلمة السر">
        <br>
        <div class="button-container">
            <button id="submit-button" class="button">تحقق</button>
        </div>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.all.min.js"></script>
<script src="{{ asset('js/js.js') }}"></script>
</body>
</html>
