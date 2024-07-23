<!DOCTYPE html>
<html lang="ar" dir="rtl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>الإشعارات</title>
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
</head>
<body>
<div class="container">
    <h1>الإشعارات</h1>

    @if(session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    @if(session('error'))
        <div class="alert alert-danger">
            {{ session('error') }}
        </div>
    @endif

    @foreach ($notifications as $notification)
        <div class="card mb-3">
            <div class="card-body">
                <p>{{ $notification->Description }}</p>
                <a href="{{ route('notifications.show', $notification->n_id) }}" class="btn btn-primary">عرض التفاصيل</a>
            </div>
        </div>
    @endforeach
</div>
<script src="{{ asset('js/app.js') }}"></script>
</body>
</html>
