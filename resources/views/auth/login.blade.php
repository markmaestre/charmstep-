<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <style>
         body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            background-color: #f2f2f2;
        }

        .container {
            max-width: 400px;
            margin: 50px auto;
            background: #fff;
            padding: 40px;
            border-radius: 8px;
            box-shadow: 0 0 20px rgba(0, 0, 0, 0.1);
        }

        h2 {
            text-align: center;
            margin-bottom: 30px;
            color: #333;
        }

        .form-group {
            margin-bottom: 20px;
        }

        label {
            display: block;
            font-weight: bold;
            margin-bottom: 5px;
            color: #555;
        }

        input[type="email"],
        input[type="password"] {
            width: 95%;
            padding: 10px;
            border: 1px solid #ccc;
            border-radius: 5px;
            transition: border-color 0.3s ease;
        }

        input[type="email"]:focus,
        input[type="password"]:focus {
            border-color: #4caf50;
        }

        .checkbox label {
            font-weight: normal;
            color: #777;
        }

        .btn {
            display: inline-block;
            padding: 12px 20px;
            background-color: #4caf50;
            color: #fff;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            text-decoration: none;
            transition: background-color 0.3s ease;
        }

        .btn:hover {
            background-color: #45a049;
        }

        .link {
            text-align: center;
            margin-top: 20px;
            color: #777;
        }

        .link a {
            color: #4caf50;
            text-decoration: none;
            transition: color 0.3s ease;
        }

        .link a:hover {
            color: black;
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
        });
    </script>
</head>
<body>
    <div class="container">
        <h2>Login</h2>
        @if ($errors->any())
            <div class="error-message">
                These credentials do not match our records.
            </div>
        @endif
        <form method="POST" action="{{ route('login') }}">
            @csrf
            <div class="form-group">
                <label for="email">Email</label>
                <input id="email" type="email" name="email" value="{{ old('email') }}" required autofocus autocomplete="username">
            </div>
            <div class="form-group">
                <label for="password">Password</label>
                <input id="password" type="password" name="password" required autocomplete="current-password">
            </div>
            <div class="form-group checkbox">
                <label>
                    <input type="checkbox" name="remember"> Remember me
                </label>
            </div>
            <div class="form-group">
                <button type="submit" class="btn">Login</button>
            </div>
            
            <div class="link">
                <a href="register">Register</a>
            </div>
        </form>
        <script src="{{ asset('js/auth.js') }}"></script>
    </div>
</body>
</html>
