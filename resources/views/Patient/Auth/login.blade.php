<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login | Dental Clinic</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        }

        body {
            min-height: 100vh;
            background: linear-gradient(45deg, #2193b0, #6dd5ed);
            display: flex;
            justify-content: center;
            align-items: center;
            padding: 20px;
        }

        .login-container {
            background: rgba(255, 255, 255, 0.95);
            border-radius: 20px;
            box-shadow: 0 15px 35px rgba(0, 0, 0, 0.2);
            padding: 40px;
            width: 100%;
            max-width: 500px;
            transform: translateY(0);
            transition: all 0.3s ease;
        }

        .login-container:hover {
            transform: translateY(-5px);
        }

        .login-header {
            text-align: center;
            margin-bottom: 30px;
        }

        .login-header h1 {
            color: #2193b0;
            font-size: 2em;
            margin-bottom: 10px;
        }

        .login-header p {
            color: #666;
            font-size: 0.9em;
        }

        .input-group {
            position: relative;
            margin-bottom: 25px;
        }

        .input-group input {
            width: 100%;
            padding: 15px;
            border: none;
            border-radius: 10px;
            background: #f5f5f5;
            color: #333;
            font-size: 1em;
            transition: all 0.3s ease;
        }

        .input-group input:focus {
            background: #fff;
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.1);
            outline: none;
        }

        .login-button {
            width: 100%;
            padding: 15px;
            background: #2193b0;
            border: none;
            border-radius: 10px;
            color: white;
            font-size: 1em;
            font-weight: 600;
            cursor: pointer;
            transition: all 0.3s ease;
        }

        .login-button:hover {
            background: #1a7087;
            transform: translateY(-2px);
        }

        .login-button:active {
            transform: translateY(0);
        }

        .signup-link {
            text-align: center;
            margin-top: 25px;
            color: #666;
            font-size: 0.9em;
        }

        .signup-link a {
            color: #2193b0;
            text-decoration: none;
            font-weight: 600;
            transition: color 0.3s ease;
        }

        .signup-link a:hover {
            color: #1a7087;
        }
    </style>
</head>
<body>
<div class="login-container">
    <div class="login-header">
        <h1>Login to Your Account</h1>
        <p>Welcome back to our Dental Clinic</p>
    </div>

    <form action="{{ route('patient.login') }}" method="POST">
        @csrf
        @if ($errors->any())
    <ul>
        @foreach ($errors->all() as $error)
            <li>{{ $error }}</li>
        @endforeach
    </ul>
@endif

        <div class="input-group">
            <input type="email" name="email" placeholder="Email Address" required>
        </div>

        <div class="input-group">
            <input type="password" name="password" placeholder="Password" required>
        </div>

        <button type="submit" class="login-button">Login</button>
    </form>

    <div class="signup-link">
        Don't have an account? <a href="{{ route('patient.register.page') }}">Sign Up</a>
    </div>
</div>
</body>
</html>
