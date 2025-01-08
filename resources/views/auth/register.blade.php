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
        
        .register-container {
            max-width: 450px;
            margin: 40px auto;
            padding: 35px;
            background: rgba(255, 255, 255, 0.95);
            border-radius: 15px;
            box-shadow: 0 8px 32px rgba(0, 0, 0, 0.1);
        }
        
        .salon-logo {
            text-align: center;
            margin-bottom: 25px;
        }
        
        .salon-logo img {
            width: 100px;
            height: 100px;
            border-radius: 50px;
        }
        
        .salon-title {
            text-align: center;
            color: #ff6b6b;
            font-size: 24px;
            margin-bottom: 25px;
        }
        
        .form-group {
            margin-bottom: 20px;
        }
        
        .form-group label {
            display: block;
            margin-bottom: 8px;
            color: #555;
            font-size: 14px;
            font-weight: 500;
        }
        
        .form-group input {
            width: 100%;
            padding: 12px;
            border: 2px solid #ffd1d1;
            border-radius: 8px;
            font-size: 14px;
            transition: all 0.3s ease;
            background: #fff;
        }
        
        .form-group input:focus {
            border-color: #ff6b6b;
            outline: none;
            box-shadow: 0 0 0 3px rgba(255, 107, 107, 0.1);
        }
        
        .already-registered {
            text-align: center;
            margin: 20px 0;
        }
        
        .already-registered a {
            color: #ff6b6b;
            text-decoration: none;
            font-size: 14px;
            transition: color 0.3s;
        }
        
        .already-registered a:hover {
            color: #ff5252;
            text-decoration: underline;
        }
        
        .register-button {
            width: 100%;
            padding: 14px;
            background: #ff6b6b;
            color: white;
            border: none;
            border-radius: 8px;
            font-size: 16px;
            font-weight: 600;
            cursor: pointer;
            transition: all 0.3s ease;
            margin-top: 10px;
        }
        
        .register-button:hover {
            background: #ff5252;
            transform: translateY(-1px);
            box-shadow: 0 4px 12px rgba(255, 107, 107, 0.2);
        }
        
        .error-message {
            color: #ff4444;
            font-size: 12px;
            margin-top: 5px;
        }
        
        .decorative-element {
            position: fixed;
            width: 200px;
            height: 200px;
            opacity: 0.1;
            z-index: -1;
            background-size: contain;
            background-repeat: no-repeat;
        }
        
        .decorative-scissors {
            top: 20px;
            right: 20px;
            transform: rotate(45deg);
            background-image: url('/api/placeholder/200/200');
        }
        
        .decorative-comb {
            bottom: 20px;
            left: 20px;
            transform: rotate(-45deg);
            background-image: url('/api/placeholder/200/200');
        }
        
        @media (max-width: 500px) {
            .register-container {
                margin: 20px;
                padding: 20px;
            }
            
            .salon-logo img {
                width: 80px;
                height: 80px;
            }
        }
    </style>
</head>
<body>
    <div class="decorative-scissors decorative-element"></div>
    <div class="decorative-comb decorative-element"></div>
    
    <div class="register-container">
        <div class="salon-logo">
            <img src="https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcSVmX7VAPcp7kTmLsaCYZBAPL0oNCpnJXKrPg&s" alt="Salon Logo">
        </div>
        <h1 class="salon-title">Create Your Account</h1>
        
        <form method="POST" action="{{ route('register') }}">
            @csrf
            
            <div class="form-group">
                <label for="name">Full Name</label>
                <input id="name" type="text" name="name" value="{{ old('name') }}" required autofocus autocomplete="name">
                <x-input-error :messages="$errors->get('name')" class="error-message" />
            </div>
            
            <div class="form-group">
                <label for="email">Email Address</label>
                <input id="email" type="email" name="email" value="{{ old('email') }}" required autocomplete="username">
                <x-input-error :messages="$errors->get('email')" class="error-message" />
            </div>
            
            <div class="form-group">
                <label for="password">Password</label>
                <input id="password" type="password" name="password" required autocomplete="new-password">
                <x-input-error :messages="$errors->get('password')" class="error-message" />
            </div>
            
            <div class="form-group">
                <label for="password_confirmation">Confirm Password</label>
                <input id="password_confirmation" type="password" name="password_confirmation" required autocomplete="new-password">
                <x-input-error :messages="$errors->get('password_confirmation')" class="error-message" />
            </div>
            
            <div class="already-registered">
                <a href="{{ route('login') }}">Already have an account? Log in</a>
            </div>
            
            <button type="submit" class="register-button">
                Create Account
            </button>
        </form>
    </div>
</body>
</html>