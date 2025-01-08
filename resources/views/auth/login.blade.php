<!DOCTYPE html>
<html>
<head>
    <style>
        body {
            margin: 0;
            padding: 0;
            min-height: 100vh;
            background:rgb(23, 14, 46);
            font-family: 'Arial', sans-serif;
        }
        
        .login-container {
            max-width: 400px;
            margin: 50px auto;
            padding: 30px;
            background: rgba(255, 255, 255, 0.95);
            border-radius: 15px;
            box-shadow: 0 8px 32px rgba(0, 0, 0, 0.1);
        }
        
        .salon-logo {
            text-align: center;
            margin-bottom: 30px;
        }
        
        .salon-logo img {
            width: 120px;
            height: 120px;
            border-radius: 60px;
        }
        
        .salon-title {
            text-align: center;
            color: #ff6b6b;
            font-size: 24px;
            margin-bottom: 30px;
        }
        
        .form-group {
            margin-bottom: 20px;
        }
        
        .form-group label {
            display: block;
            margin-bottom: 8px;
            color: #666;
            font-size: 14px;
        }
        
        .form-group input[type="email"],
        .form-group input[type="password"] {
            width: 100%;
            padding: 12px;
            border: 1px solid #ddd;
            border-radius: 8px;
            font-size: 14px;
            transition: border-color 0.3s;
        }
        
        .form-group input:focus {
            border-color: #ff6b6b;
            outline: none;
        }
        
        .remember-me {
            display: flex;
            align-items: center;
            margin: 20px 0;
        }
        
        .remember-me input[type="checkbox"] {
            margin-right: 8px;
        }
        
        .forgot-password {
            text-align: right;
            margin-bottom: 20px;
        }
        
        .forgot-password a {
            color: #ff6b6b;
            text-decoration: none;
            font-size: 14px;
        }
        
        .login-button {
            width: 100%;
            padding: 12px;
            background: #ff6b6b;
            color: white;
            border: none;
            border-radius: 8px;
            font-size: 16px;
            cursor: pointer;
            transition: background 0.3s;
        }
        
        .login-button:hover {
            background: #ff5252;
        }
        
        .error-message {
            color: #ff4444;
            font-size: 12px;
            margin-top: 5px;
        }
        
        .decorative-element {
            position: absolute;
            width: 200px;
            height: 200px;
            background: url('/api/placeholder/200/200') center/cover;
            opacity: 0.1;
            z-index: -1;
        }
        
        .decorative-element.top-right {
            top: 0;
            right: 0;
        }
        
        .decorative-element.bottom-left {
            bottom: 0;
            left: 0;
        }
    </style>
</head>
<body>
    <div class="decorative-element top-right"></div>
    <div class="decorative-element bottom-left"></div>
    
    <div class="login-container">
    <div class="salon-logo">
        <img src="https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcRTMuW7snrsoThmUeyqv0qmR0h61Oe9_bU27Q&s" alt="Salon Logo">
    </div>

        <h1 class="salon-title">Welcome to Salonmu</h1>
        
        <x-auth-session-status class="mb-4" :status="session('status')" />
        
        <form method="POST" action="{{ route('login') }}">
            @csrf
            
            <div class="form-group">
                <label for="email">Email Address</label>
                <input id="email" type="email" name="email" value="{{ old('email') }}" required autofocus autocomplete="username">
                <x-input-error :messages="$errors->get('email')" class="error-message" />
            </div>
            
            <div class="form-group">
                <label for="password">Password</label>
                <input id="password" type="password" name="password" required autocomplete="current-password">
                <x-input-error :messages="$errors->get('password')" class="error-message" />
            </div>
            
            <div class="remember-me">
                <input id="remember_me" type="checkbox" name="remember">
                <label for="remember_me">Remember me</label>
            </div>
            
            <div class="forgot-password">
                @if (Route::has('password.request'))
                    <a href="{{ route('password.request') }}">
                        Forgot your password?
                    </a>
                @endif
            </div>
            
            <button type="submit" class="login-button">
                Log in
            </button>
        </form>
    </div>
</body>
</html>