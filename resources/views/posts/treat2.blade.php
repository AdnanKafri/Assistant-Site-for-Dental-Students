{{--resources/views/posts/treat2.blade.php--}}
    <!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body>
<h2>هل انت متأكد أنك لديك هذه الحالة ؟</h2>
<div class="d-flex justify-content-center">
    <form method="POST" action="{{ route('confirm_request_treatment') }}">
        @csrf
        <input type="hidden" name="post_id" value="{{ request('post_id') }}">
        <button type="submit" class="btn btn-success">نعم</button>
    </form>
    <a href="{{ url()->previous() }}" class="btn btn-danger ml-2">لا</a>
</div>
</div>
</body>
</html>
