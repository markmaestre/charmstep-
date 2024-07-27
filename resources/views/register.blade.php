<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>User Registration</title>
    <link href="https://fonts.googleapis.com/css2?family=Quicksand:wght@400;500;700&display=swap" rel="stylesheet" />
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }
        body {
            font-family: "Quicksand", Arial, sans-serif;
            background: linear-gradient(to right bottom, #ffad42, #903bff);
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            overflow: hidden;
        }
        .container {
            max-width: 400px;
            width: 100%;
            background: rgba(255, 255, 255, 0.9);
            padding: 30px;
            border-radius: 10px;
            box-shadow: 0 0 20px rgba(0, 0, 0, 0.1);
            backdrop-filter: blur(10px);
            text-align: center;
        }
        h2 {
            color: #333;
            margin-bottom: 20px;
            font-size: 28px;
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
        input[type="text"],
        input[type="email"],
        input[type="password"],
        select {
            width: 100%;
            padding: 12px;
            border: 1px solid #ccc;
            border-radius: 5px;
            font-size: 16px;
            transition: border 0.3s;
            outline: none;
        }
        input[type="text"]:focus,
        input[type="email"]:focus,
        input[type="password"]:focus,
        select:focus {
            border-color: #903bff;
        }
        .error {
            color: #dc3545;
            font-size: 0.875em;
            margin-top: 5px;
            text-align: left;
        }
        button {
            width: 100%;
            background: linear-gradient(to right bottom, rgb(223, 55, 153), rgb(202, 44, 128));
            color: white;
            border: none;
            padding: 15px;
            font-size: 18px;
            border-radius: 5px;
            cursor: pointer;
            transition: background 0.3s;
        }
        button:hover {
            background: linear-gradient(to right bottom, rgb(202, 44, 128), rgb(223, 55, 153));
        }
        button:active {
            background: rgb(202, 44, 128);
        }
        .square {
            height: 100vh;
            width: 50vw;
            display: table;
            position: absolute;
            background: rgba(255, 255, 255, 0.1);
            transform: rotate(45deg);
            z-index: 1;
        }
        .square.tl {
            top: -80%;
            left: -10%;
            animation: bounce 6s infinite ease-in-out;
        }
        .square.tr {
            top: 0%;
            right: -30%;
            animation: bounce 5s infinite ease-in-out;
        }
        .square.bl {
            bottom: -70%;
            left: -15%;
            animation: bounce 4s infinite ease-in-out;
        }
        .square.br {
            bottom: 0%;
            right: -40%;
            animation: bounce 3s infinite ease-in-out;
        }
        @keyframes bounce {
            0% {
                transform: translateY(0px) rotate(45deg);
            }
            50% {
                transform: translateY(20px) rotate(45deg);
                border-radius: 50px;
            }
            100% {
                transform: translateY(0px) rotate(45deg);
            }
        }
    </style>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.3/jquery.validate.min.js"></script>
</head>
<body>
    <div class="container">
        <h2>User Registration</h2>
        <form id="register-form" class="registration-form">
            @csrf
            <div class="form-group">
                <label for="name">Name:</label>
                <input type="text" id="name" name="name" required>
            </div>
            
            <div class="form-group">
                <label for="email">Email:</label>
                <input type="email" id="email" name="email" required>
            </div>
            
            <div class="form-group">
                <label for="password">Password:</label>
                <input type="password" id="password" name="password" required>
            </div>
            
            <div class="form-group">
                <label for="password_confirmation">Confirm Password:</label>
                <input type="password" id="password_confirmation" name="password_confirmation" required>
            </div>
            
            <div class="form-group">
                <label for="role">Role:</label>
                <select id="role" name="role" required>
                    <option value="user">User</option>
                    <option value="seller">Seller</option>
                </select>
            </div>

            <input type="hidden" id="status" name="status" value="active">
            
            <button type="submit">Register</button>
        </form>
    </div>

    <span class="square tl"></span>
    <span class="square tr"></span>
    <span class="square bl"></span>
    <span class="square br"></span>
    
    <script src="{{ asset('js/auth.js') }}"></script>
</body>
</html>
