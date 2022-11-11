<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\LoginActivity;
use App\Providers\RouteServiceProvider;
use Illuminate\Contracts\Session\Session;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Support\Facades\Mail;
use Illuminate\Http\JsonResponse;

class LoginController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

    use AuthenticatesUsers;

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    protected $redirectTo = RouteServiceProvider::HOME;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }

    // protected function validateLogin(Request $request)
    // {
    //     $request->validate([
    //         $this->username() => 'required|string',
    //         'password' => 'required|string',
    //     ]);
    // }

    public function showLoginForm(Request $request)
    {
        return view('auth.login', ['request' => $request]);
    }

    public function login(Request $request)
    {
        $this->validateLogin($request);

        $user = User::where('email', $request->email)->first();

        if (isset($user) && !$user->approved) {
            return redirect(route('login'))->withErrors(['email' => 'Your account is not approved yet']);
        }

        // If the class is using the ThrottlesLogins trait, we can automatically throttle
        // the login attempts for this application. We'll key this by the username and
        // the IP address of the client making these requests into this application.
        if (
            method_exists($this, 'hasTooManyLoginAttempts') &&
            $this->hasTooManyLoginAttempts($request)
        ) {
            $this->fireLockoutEvent($request);

            return $this->sendLockoutResponse($request);
        }

        if ($this->attemptLogin($request)) {

            if (auth()->user()->role_id >= 5) {

                if (!$request->otp) {
                    return $this->sendOTP($request); // send otp

                } else {
                    return $this->validateOTP($request); // Validate otp
                }
                return $this->logout($request, route('login'));
            } else {
                $this->addLoginActivity($request);
                return $this->sendLoginResponse($request);
            }
        }

        // If the login attempt was unsuccessful we will increment the number of attempts
        // to login and redirect the user back to the login form. Of course, when this
        // user surpasses their maximum number of attempts they will get locked out.
        $this->incrementLoginAttempts($request);

        return $this->sendFailedLoginResponse($request);
    }

    public function logout(Request $request, $redirect = '/')
    {
        $this->guard()->logout();
        \Log::debug("message" . $redirect);
        // if ($redirect == '/') {
        //     $request->session()->invalidate();

        //     $request->session()->regenerateToken();
        // }

        if ($response = $this->loggedOut($request)) {
            return $response;
        }
        if ($redirect != '/') {
            return $request->wantsJson()
                ? new JsonResponse([], 204)
                : redirect($redirect)->withInput($request->all());
        } else {
            return $request->wantsJson()
                ? new JsonResponse([], 204)
                : redirect('/login')->withInput($request->all());
        }
    }

    public function sendOTP(Request $request)
    {
        $request->session()->put('otp', array(
            'pin' => rand(000000, 999999),
            'expire_time' => time() + 2 * 60,
        ));
        try {
            $data = array('name' => env('MAIL_FROM_NAME'));
            Mail::send(['html' => 'mail.otp'], $data, function ($message) {
                $message->to(auth()->user()->email, auth()->user()->name)->subject('Your Login OTP is here');
                $message->from(env('MAIL_FROM_ADDRESS'), env('MAIL_FROM_NAME'));
            });
            return $this->logout($request, route('login') . '?otp-verification=1');
        } catch (\Exception $e) {
            // Do Nothing and Login the without OTP User
            return $this->sendLoginResponse($request);
        }
    }

    public function validateOTP(Request $request)
    {
        $otp = $request->session()->get('otp');
        if (isset($otp) && isset($otp['pin']) && isset($otp["expire_time"]) && $otp['expire_time'] >= time() && $request->otp == $otp['pin']) {
            $request->session()->forget('otp');
            $this->addLoginActivity($request);
            return $this->sendLoginResponse($request);
        }
        return $this->invalidOTP($request);
    }

    public function addLoginActivity(Request $request)
    {
        LoginActivity::create([
            'user_id' => auth()->user()->id,
            'ip_address' => $request->ip()
        ]);
    }

    public function invalidOTP(Request $request)
    {
        $this->guard()->logout();

        // $request->session()->invalidate();

        // $request->session()->regenerateToken();

        if ($response = $this->loggedOut($request)) {
            return $response;
        }

        $input = $request->all();
        unset($input['_token']);

        return $request->wantsJson()
            ? new JsonResponse([], 204)
            : redirect(route('login') . '?otp-verification=1')->withInput($input)->withErrors(['otp' => 'invalid/Expired OTP']);
    }
}
