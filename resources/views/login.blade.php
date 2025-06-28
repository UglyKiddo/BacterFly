<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Masuk</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #1a1a1a;
            color: #fff;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            margin: 0;
        }
        .container {
            width: 100%;
            max-width: 400px;
            padding: 20px;
        }
        .form-group {
            margin-bottom: 15px;
        }
        .form-group label {
            display: block;
            margin-bottom: 5px;
        }
        .form-group input {
            width: 100%;
            padding: 10px;
            border: 1px solid #ccc;
            border-radius: 5px;
            background-color: #333;
            color: #fff;
        }
        .form-group input[type="checkbox"] {
            width: auto;
            margin-right: 10px;
        }
        .login-btn {
            width: 100%;
            padding: 10px;
            background-color: #ff6200;
            border: none;
            border-radius: 5px;
            color: #fff;
            font-size: 16px;
            cursor: pointer;
        }
        .links {
            margin-top: 10px;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }
        .links a {
            color: #ff6200;
            text-decoration: none;
            font-size: 14px;
            padding: 5px 10px;
        }
        .message {
            text-align: center;
            margin-bottom: 15px;
            color: #ff6200;
        }
    </style>
</head>
<body>
    <div class="container">
        @if (session('pesan'))
            <div class="message">{{ session('pesan') }}</div>
        @endif

        <p style="text-align: center;">Login using email office only</p>
        <form method="POST" action="{{ route('login') }}">
            @csrf
            <div class="form-group">
                <label for="email">Alamat Email</label>
                <input type="email" name="email" id="email" placeholder="Email Address" required>
            </div>
            <div class="form-group">
                <label for="password">Kata Sandi</label>
                <input type="password" name="password" id="password" placeholder="Password" required>
            </div>
            <div class="form-group">
                <label>
                    <input type="checkbox" required>
                    I confirm that i have read, consent and agree to Bacterfly's Terms of Use and Privacy Policy.
                </label>
            </div>
            <button type="submit" name="login" class="login-btn">LOG IN</button>
            <div class="links">
                <a href="{{ url('forgot_password') }}">Forgot Password?</a>
                <a href="{{ url('register') }}">Register</a>
            </div>
        </form>
    </div>
</body>
</html>