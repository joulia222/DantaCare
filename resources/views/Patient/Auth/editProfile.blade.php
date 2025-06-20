<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Profile | Dental Clinic</title>
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

        .profile-container {
            background: rgba(255, 255, 255, 0.95);
            border-radius: 20px;
            box-shadow: 0 15px 35px rgba(0, 0, 0, 0.2);
            padding: 40px;
            width: 100%;
            max-width: 500px;
            text-align: center;
        }

        .profile-header img {
            width: 100px;
            height: 100px;
            border-radius: 50%;
            object-fit: cover;
            border: 3px solid #2193b0;
        }

        .profile-header h1 {
            margin-top: 15px;
            color: #2193b0;
        }

        .input-group {
            margin: 20px 0;
            text-align: left;
        }

        .input-group input,
        .input-group select {
            width: 100%;
            padding: 12px;
            border: none;
            border-radius: 10px;
            background: #f5f5f5;
            color: #333;
            font-size: 1em;
        }

        .update-button {
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

        .update-button:hover {
            background: #1a7087;
        }

        .back-link {
            display: block;
            margin-top: 20px;
            text-decoration: none;
            color: #2193b0;
            font-weight: bold;
        }

        .message {
            background: #d4edda;
            color: #155724;
            padding: 10px;
            border-radius: 5px;
            margin-bottom: 15px;
        }
    </style>
</head>
<body>
<div class="profile-container">
    <div class="profile-header">
        <img src="{{ asset('Image/' . $patient->img) }}" alt="Profile Image">
        <h1>Edit Your Profile</h1>
    </div>

    @if(session('success_message'))
        <div class="message">{{ session('success_message') }}</div>
    @endif

    <form action="{{ route('patient.profile.update') }}" method="POST" enctype="multipart/form-data">
        @csrf

        <div class="input-group">
            <input type="text" name="name" value="{{ $patient->name }}" placeholder="Full Name" required>
        </div>

        <div class="input-group">
            <input type="email" name="email" value="{{ $patient->email }}" placeholder="Email Address" required>
        </div>

        <div class="input-group">
            <select name="gender" required>
                <option value="">Select Gender</option>
                <option value="1" {{ $patient->gender == 1 ? 'selected' : '' }}>Male</option>
                <option value="0" {{ $patient->gender == 0 ? 'selected' : '' }}>Female</option>
            </select>
        </div>

        <div class="input-group">
            <input type="number" name="age" value="{{ $patient->age }}" placeholder="Age" min="1" max="150" required>
        </div>

        <div class="input-group">
            <input type="tel" name="phone" value="{{ $patient->phone }}" placeholder="Phone Number" required>
        </div>

        <div class="input-group">
            <label>Current Image: {{ $patient->img }}</></label>
            <input type="file" name="img" accept="image/*">
        </div>
        
        

        <button type="submit" class="update-button">Update Profile</button>
    </form>

    <a href="{{ route('patient.index') }}" class="back-link">&larr; Back to Dashboard</a>
</div>
</body>
</html>
