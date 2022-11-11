<div>
    <p>Hi, {{ auth()->user()->name }}</p>
    <div style="text-align:center">
        <p>Your Login OTP is</p>
        <h3>{{ session()->get('otp')['pin'] }}</h3>
        <p>Please enter this otp to Login</p>
    </div>
</div>