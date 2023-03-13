@extends("layouts.app")

@section("title", "Trang đăng nhập")

@section("content")
<div class="title text-center text-danger text-bold h1">
    Trang đăng nhập
</div>
@if($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif
<div class="login-form">
    <form method="POST" action="{{ route('login') }}">
        @csrf
        <div class="form-group">
            <label for="email">Email:</label>
            <input type="email" class="form-control" name="email" id="email">
        </div>
        <div class="form-group">
            <label for="password">Password:</label>
            <input type="password" class="form-control" name="password" id="password">
        </div>
        <input type="submit" class="btn btn-primary" value="Đăng nhập">
    </form>
</div>
@endsection