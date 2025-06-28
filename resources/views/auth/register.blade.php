<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Daftar</title>
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
        .form-group input,
        .form-group select {
            width: 100%;
            padding: 10px;
            border: 1px solid #ccc;
            border-radius: 5px;
            background-color: #333;
            color: #fff;
            box-sizing: border-box;
        }
        .form-group.checkbox-label {
            display: flex;
            align-items: center;
            gap: 10px;
            font-size: 14px;
        }
        .checkbox-group {
            display: flex;
            align-items: center;
            gap: 10px;
            font-size: 14px;
            margin-bottom: 15px;
        }

        .checkbox-group input[type="checkbox"] {
            width: auto;
            margin: 0;
        }
        .code-group {
            display: flex;
            gap: 10px;
        }
        .code-group input {
            flex: 1;
        }
        .code-group button {
            padding: 10px 20px;
            border: 1px solid #ccc;
            border-radius: 5px;
            background-color: #333;
            color: #fff;
            cursor: pointer;
        }
        .signup-btn {
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
        }
        .links a {
            color: #ff6200;
            text-decoration: none;
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

        <p style="text-align: center;">Only email registration is supported in your office</p>

        <!-- Form registrasi -->
        <form method="POST" action="{{ route('register') }}">
            @csrf

            <div class="form-group">
                <input type="email" name="email" placeholder="Email Address" value="{{ old('email') }}" required>
            </div>

            <div class="form-group">
                <input type="password" name="password" placeholder="Password" required>
            </div>

            <div class="form-group">
                <input type="password" name="confirm_password" placeholder="Confirm Password" required>
            </div>

            <!-- Input kode verifikasi + tombol kirim -->
            <div class="form-group code-group">
                <input type="text" name="code" placeholder="Verification Code" required>

                <!-- Form kecil hanya untuk kirim kode -->
                <form method="POST" action="{{ route('send.code') }}">
                    @csrf
                    <input type="hidden" name="email" value="{{ old('email') }}">
                    <button type="submit" name="send_code">Send Code</button>
                </form>
            </div>

            <div class="form-group">
                <label for="division">Pilih Divisi:</label>
                <select name="division" id="division" required>
                    <option value="">Pilih Divisi</option>
                    <option value="Laboratorium">Laboratorium</option>
                    <option value="Produksi">Produksi</option>
                    <option value="Manager">Manager</option>
                </select>
            </div>

            <div class="form-group checkbox-group">
                <input type="checkbox" id="terms" required>
                <label for="terms">I confirm that I have read, consent and agree to Bacterfly's Terms of Use and Privacy Policy.</label>
            </div>

            <button type="submit" class="signup-btn">REGISTER</button>

            <div class="links">
                <a href="mailto:bacterfly@gmail.com?subject=Kendala%20Registrasi">Call Us</a>
                <a href="{{ url('login') }}">Log In</a>
            </div>
        </form>
    </div>
</body>
</html>