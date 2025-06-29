<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Registrasi - BacterFly</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
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
        input, select, button {
            width: 100%;
            padding: 10px;
            border-radius: 5px;
            border: 1px solid #ccc;
            box-sizing: border-box;
            background-color: #333;
            color: #fff;
        }
        .code-group {
            display: flex;
            gap: 10px;
        }
        .code-group input {
            flex: 2;
        }
        .code-group button {
            flex: 1;
            padding: 10px;
            background-color: #444;
            cursor: pointer;
        }
        .signup-btn {
            background-color: #ff6200;
            border: none;
            font-size: 16px;
            cursor: pointer;
        }
        .message {
            color: #ff6200;
            text-align: center;
            margin-bottom: 10px;
        }
        .checkbox-group {
            display: flex;
            gap: 10px;
            font-size: 14px;
        }
        .links {
            margin-top: 10px;
            display: flex;
            justify-content: space-between;
        }
        .links a {
            color: #ff6200;
            text-decoration: none;
        }
    </style>
</head>
<body>
<div class="container">
    @if(session('pesan'))
        <div class="message">{{ session('pesan') }}</div>
    @endif

    <p style="text-align: center;">Only email registration is supported in your office</p>

    <!-- FORM SEND CODE -->
    <form method="POST" action="{{ url('rregister.php') }}">
        @csrf
        <div class="form-group">
            <input type="email" name="email" placeholder="Email Address" value="{{ old('email') ?? session('email') }}" required>
        </div>

        <div class="form-group">
            <input type="password" name="password" placeholder="Password" required>
        </div>

        <div class="form-group">
            <input type="password" name="confirm_password" placeholder="Confirm Password" required>
        </div>

        <!-- VERIFIKASI -->
        <div class="form-group code-group">
            <input type="text" name="code" placeholder="Verification Code">
            <button type="submit" name="send_code">Send Code</button>
        </div>

        <!-- DIVISI -->
        <div class="form-group">
            <select name="division" required>
                <option value="">Pilih Divisi</option>
                <option value="Laboratorium" {{ old('division') == 'Laboratorium' ? 'selected' : '' }}>Laboratorium</option>
                <option value="Produksi" {{ old('division') == 'Produksi' ? 'selected' : '' }}>Produksi</option>
                <option value="Manager" {{ old('division') == 'Manager' ? 'selected' : '' }}>Manager</option>
            </select>
        </div>

        <!-- S&K -->
        <div class="form-group checkbox-group">
            <input type="checkbox" id="terms" required>
            <label for="terms">I confirm that I have read, consent and agree to BacterFly's Terms of Use and Privacy Policy.</label>
        </div>

        <button type="submit" class="signup-btn" name="signup">REGISTER</button>

        <div class="links">
            <a href="mailto:bacterfly@gmail.com?subject=Kendala%20Registrasi">Call Us</a>
            <a href="{{ url('login') }}">Log In</a>
        </div>
    </form>
</div>
</body>
</html>