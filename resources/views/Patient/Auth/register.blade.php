<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sign Up | Dental Clinic</title>
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

        .signup-container {
            background: rgba(255, 255, 255, 0.95);
            border-radius: 20px;
            box-shadow: 0 15px 35px rgba(0, 0, 0, 0.2);
            padding: 40px;
            width: 100%;
            max-width: 500px;
            transform: translateY(0);
            transition: all 0.3s ease;
        }

        .signup-container:hover {
            transform: translateY(-5px);
        }

        .signup-header {
            text-align: center;
            margin-bottom: 30px;
        }

        .signup-header h1 {
            color: #2193b0;
            font-size: 2em;
            margin-bottom: 10px;
        }

        .signup-header p {
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

        .signup-button {
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

        .signup-button:hover {
            background: #1a7087;
            transform: translateY(-2px);
        }

        .signup-button:active {
            transform: translateY(0);
        }

        .login-link {
            text-align: center;
            margin-top: 25px;
            color: #666;
            font-size: 0.9em;
        }

        .login-link a {
            color: #2193b0;
            text-decoration: none;
            font-weight: 600;
            transition: color 0.3s ease;
        }

        .login-link a:hover {
            color: #1a7087;
        }
    </style>
</head>
<body>
<div class="signup-container">
    <div class="signup-header">
        <h1>Create an Account</h1>
        <p>Join our Dental Clinic</p>
    </div>

    <form id="signupForm" action="{{route('patient.register')}}" method="POST" enctype="multipart/form-data">
        @csrf
        @if ($errors->any())
    <ul>
        @foreach ($errors->all() as $error)
            <li>{{ $error }}</li>
        @endforeach
    </ul>
@endif

        <div class="input-group">
            <i class="fas fa-user"></i>
            <input type="text" id="name" name="name" placeholder="Full Name" required>
            <div class="error-message">Name is required</div>
        </div>

        <div class="input-group">
            <i class="fas fa-envelope"></i>
            <input type="email" id="email" name="email" placeholder="Email Address" required>
            <div class="error-message">Please enter a valid email address</div>
        </div>

        <div class="input-group">
            <i class="fas fa-lock"></i>
            <input type="password" id="password" name="password" placeholder="Password" required>
            <div class="error-message">Password must be at least 6 characters</div>
        </div>

        <div class="input-group">
            <i class="fas fa-venus-mars"></i>
            <select id="gender" name="gender" required>
                <option value="">Select Gender</option>
                <option value="1">Male</option>
                <option value="0">Female</option>
            </select>
            <div class="error-message">Please select your gender</div>
        </div>

        <div class="input-group">
            <i class="fas fa-calendar"></i>
            <input type="number" id="age" name="age" placeholder="Age" min="1" max="150" required>
            <div class="error-message">Please enter a valid age</div>
        </div>

        <div class="input-group">
            <i class="fas fa-phone"></i>
            <input type="tel" id="phone" name="phone" placeholder="Phone Number" required>
            <div class="error-message">Please enter a valid phone number</div>
        </div>

        <div class="input-group">
            <i class="fas fa-image"></i>
            <input type="file" id="img" name="img" accept="image/*" required>
            <div class="error-message">Please select an image</div>
        </div>

        <button type="submit" class="signup-button">Create Account</button>
    </form>

    <div class="login-link">
        Already have an account? <a href="{{ route('patient.login.page') }}">Login</a>
    </div>
</div>
</body>
</html>
