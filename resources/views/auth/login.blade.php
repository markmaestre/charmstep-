<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link href="https://fonts.googleapis.com/css2?family=Quicksand:wght@400;500;700&display=swap" rel="stylesheet" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
    <style>
        * {
            margin: 0;
            padding: 0;
        }
        html {
            font-family: "Quicksand";
            background: linear-gradient(to right bottom, #ffad42, #903bff);
            overflow: hidden;
        }
        .home-icon {
            position: absolute;
            top: 20px;
            right: 20px;
            font-size: 24px;
            color: #fff;
            cursor: pointer;
            z-index: 100;
        }
        .login-field {
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
        }
        .login-background {
            background: #fff;
            min-height: 600px;
            min-width: 400px;
            background: linear-gradient(to right bottom,
                    rgba(255, 255, 255, 0.2),
                    rgba(255, 255, 255, 0.1));
            backdrop-filter: blur(20px);
            border-radius: 10px;
            z-index: 5;
            display: flex;
            flex-flow: column;
            box-shadow: 0 0 5px 0 rgba(22, 22, 22, 0.1);
        }
        .login-title {
            position: relative;
            color: #fff;
            text-align: center;
            margin-top: 50px;
            padding: 10px;
            border-top: 5px solid rgba(255, 255, 255, 0.1);
            border-bottom: 5px solid rgba(255, 255, 255, 0.1);
        }
        .login-title span {
            font-size: 30px;
            letter-spacing: 3px;
        }
        .login-form {
            display: flex;
            justify-content: center;
            align-items: center;
            min-height: 100%;
            flex-grow: 1;
            border-bottom-left-radius: 30px;
            border-bottom-right-radius: 30px;
        }
        .login-form .field {
            margin: 50px 0;
            text-align: center;
        }
        .login-form .field input {
            font-family: Quicksand;
            border: 0px;
            padding: 20px 60px;
            border-radius: 10px;
            outline: none;
            text-align: center;
            box-shadow: 0 2px 5px 0 rgba(50, 50, 50, 0.2);
            background: linear-gradient(to right bottom,
                    rgba(255, 255, 255, 0.8),
                    rgba(255, 255, 255, 0.7));
            backdrop-filter: blur(10px);
            color: #111;
            font-size: 16px;
        }
        ::placeholder {
            color: #666;
            letter-spacing: 2px;
        }
        .login-field .button-field {
            display: flex;
            flex-flow: column;
        }
        .login-form .field button {
            font-family: Quicksand;
            flex-grow: 1;
            border: 0px;
            padding: 15px 50px;
            outline: none;
            text-align: center;
            cursor: pointer;
            margin: 10px;
            transition: 1s;
            box-shadow: 0 2px 5px 0 rgba(50, 50, 50, 0.2);
            font-size: 16px;
            border-radius: 10px;
        }
        .login-form .field button:hover {
            transform: translateY(-3px);
            transition: 1s;
        }
        .login-form .button-login {
            background: linear-gradient(to right bottom,
                    rgb(223, 55, 153),
                    rgb(202, 44, 128));
            color: #fff;
        }
        .login-form .button-register {
            background: linear-gradient(to right bottom,
                    rgb(55, 153, 223),
                    rgb(44, 128, 202));
            color: #fff;
        }
        .square {
            height: 100vh;
            width: 50vw;
            display: table;
            position: absolute;
            background: rgba(255, 255, 255, 0.1);
            transform: rotate(45deg);
        }
        .square.square-tl {
            top: -80%;
            left: -10%;
            animation: bounce 6s infinite ease-in-out;
            background: rgb(34, 34, 34, 0.1);
            z-index: 50;
        }
        .square.square-tr {
            top: 0%;
            right: -30%;
            animation: bounce 5s infinite ease-in-out;
        }
        .square.square-bl {
            bottom: -70%;
            left: -15%;
            animation: bounce 4s infinite ease-in-out;
        }
        .square.square-br {
            bottom: 0%;
            right: -40%;
            animation: bounce 3s infinite ease-in-out;
            background: rgb(34, 34, 34, 0.1);
        }
        @keyframes bounce {
            0% {
                transform: translateY(0px) rotate(45deg)
            }
            50% {
                transform: translateY(20px) rotate(45deg);
                border-radius: 50px;
            }
            100% {
                transform: translateY(0px) rotate(45deg)
            }
        }
        .star {
            height: 50px;
            width: 50px;
            display: table;
            position: absolute;
            box-shadow: 0 0 5px 0 rgba(34, 34, 34, 0.5);
            transition: 0.5s;
        }
        .star1 {
            bottom: -10%;
            left: -30%;
            transform: rotate(-30deg);
            animation: sweep 4s infinite;
            background: rgba(34, 34, 34, 0.5);
        }
        .star2 {
            bottom: -30%;
            left: -10%;
            transform: rotate(-30deg);
            animation: sweep 3s infinite;
            background: rgb(255, 255, 255, 0.5);
        }
        @keyframes sweep {
            100% {
                bottom: 120%;
                left: 120%;
                transform: rotate(360deg);
            }
        }
        .error-message {
            color: red;
            text-align: center;
            margin-top: 10px;
        }
    </style>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
        $(document).ready(function() {
            $('form').on('submit', function(e) {
                let email = $('#email').val();
                let password = $('#password').val();
                let hasError = false;

                $('.error-message').remove();

                if (email === '') {
                    $('#email').after('<div class="error-message">Email is required</div>');
                    hasError = true;
                }
                if (password === '') {
                    $('#password').after('<div class="error-message">Password is required</div>');
                    hasError = true;
                }

                if (hasError) {
                    e.preventDefault();
                }
            });

            $('.home-icon').click(function() {
                window.location.href = '/home';
            });
        });
    </script>
</head>
<body>
    <i class="fas fa-home home-icon"></i>
    <div class="login-field">
        <div class="login-background">
            <div class="login-title">
                <span>Sign In</span>
            </div>
            <div class="login-form">
                <form method="POST" action="{{ route('login') }}">
                    @csrf
                    <div class="field username-field">
                        <input type="email" id="email" name="email" placeholder="Email" value="{{ old('email') }}" required autofocus autocomplete="username">
                    </div>
                    <div class="field password-field">
                        <input type="password" id="password" name="password" placeholder="Password" required autocomplete="current-password">
                    </div>
                    <div class="field checkbox">
                        <label>
                            <input type="checkbox" name="remember"> Remember me
                        </label>
                    </div>
                    <div class="field button-field">
                        <button class="button button-login" type="submit">LOGIN</button>
                        <button class="button button-register" type="button" onclick="window.location='/register'">REGISTER</button>
                    </div>
                </form>
                @if ($errors->any())
                    <div class="error-message">
                        These credentials do not match our records.
                    </div>
                @endif
            </div>
        </div>
    </div>
    <span class="square square-tl"></span>
    <span class="square square-tr"></span>
    <span class="square square-bl"></span>
    <span class="square square-br"></span>
    <span class="star star1"></span>
    <span class="star star2"></span>
    <script src="{{ asset('js/auth.js') }}"></script>
</body>
</html>
