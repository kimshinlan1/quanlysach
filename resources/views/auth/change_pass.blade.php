@extends('layouts.app')

@section('title', 'Profile')

@section('content')
    <form method="post">
        <div class="form-group">
            <div class="input-group">
                <div class="input-group-addon"><span class="glyphicon glyphicon-lock"></span></div>
                <input class="form-control" type="password" id="password" placeholder="Mật khẩu hiện tại" aria-label="Password"
                    aria-describedby="password-toggle">
                <div class="input-group-append">
                    <button class="btn btn-outline-secondary" type="button" id="password-toggle"
                        onclick="togglePassword($(this))">Show</button>
                </div>
            </div>
        </div>
        <div class="form-group">
            <div class="input-group">
                <div class="input-group-addon"><span class="glyphicon glyphicon-log-in"></span></div>
                <input class="form-control" type="password" placeholder="Mật khẩu mới">
                <div class="input-group-append">
                    <button class="btn btn-outline-secondary" type="button" id="password-toggle"
                        onclick="togglePassword()">Show</button>
                </div>
            </div>
            
        </div>
        <div class="form-group">
            <div class="input-group">
                <div class="input-group-addon"><span class="glyphicon glyphicon-log-in"></span></div>
                <input class="form-control" type="password" placeholder="Nhập lại mật khẩu mới">
                <div class="input-group-append">
                    <button class="btn btn-outline-secondary" type="button" id="password-toggle"
                        onclick="togglePassword()">Show</button>
                </div>
            </div>
            
        </div>
    </form>

@endsection

@section('scripts')
    <script>
        function togglePassword(target) {
            console.log(e[0]);
            var passwordInput = $("#password")[0];
            var passwordToggle = $("#password-toggle")[0];

            if (passwordInput.type === "password") {
                passwordInput.type = "text"
                passwordToggle.innerHTML = "Hide";
            } else {
                passwordInput.type = 'password';
                passwordToggle.innerHTML = "Show";
            }
        }
    </script>
@endsection
