<div>
    <p>Hi, {{ auth()->user()->name }}</p>
    <div style="text-align:center">
        <p>Your OTP is</p>
        <h3>{{ session()->get('otp')['pin'] }}</h3>
        <p>Please enter this otp to Update Password</p>
    </div>
</div>