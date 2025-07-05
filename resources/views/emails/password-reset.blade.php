<!DOCTYPE html>
<html>
<head>
    <title>{{ __('Reset Password Notification') }}</title>
</head>
<body>
    <h1>{{ __('Reset Password Notification') }}</h1>
    
    <p>{{ __('You are receiving this email because we received a password reset request for your account.') }}</p>
    
    <p>
        <a href="{{ $url }}" style="background-color: #3490dc; color: white; padding: 10px 20px; text-decoration: none; border-radius: 4px; display: inline-block;">
            {{ __('Reset Password') }}
        </a>
    </p>
    
    <p>{{ __('This password reset link will expire in :count minutes.', ['count' => config('auth.passwords.customers.expire')]) }}</p>
    
    <p>{{ __('If you did not request a password reset, no further action is required.') }}</p>
    
    <hr>
    
    <p>
        <small>
            {{ __('If you are having trouble clicking the "Reset Password" button, copy and paste the URL below into your web browser:') }}
            <br>
            <a href="{{ $url }}">{{ $url }}</a>
        </small>
    </p>
    
    <p>
        {{ __('Regards') }},<br>
        {{ config('app.name') }}
    </p>
</body>
</html>
