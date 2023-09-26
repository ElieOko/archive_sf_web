<?php

namespace App\Http\Requests\Auth;

use Illuminate\Auth\Events\Lockout;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\RateLimiter;
use Illuminate\Support\Str;
use Illuminate\Validation\ValidationException;

class LoginRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\Rule|array|string>
     */
    public function rules(): array
    {
        return [
            'email' => ['required', 'string', 'email'],
            'password' => ['required', 'string'],
        ];
    }

    /**
     * Attempt to authenticate the request's credentials.
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    public function authenticate(): void
    {
        $this->ensureIsNotRateLimited();

        if (! Auth::attempt($this->only('email', 'password'), $this->boolean('remember'))) {
            RateLimiter::hit($this->throttleKey());

            throw ValidationException::withMessages([
                'email' => trans('auth.failed'),
            ]);
        }

        RateLimiter::clear($this->throttleKey());
    }

    /**
     * Ensure the login request is not rate limited.
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    public function ensureIsNotRateLimited(): void
    {
        if (! RateLimiter::tooManyAttempts($this->throttleKey(), 5)) {
            return;
        }

        event(new Lockout($this));

        $seconds = RateLimiter::availableIn($this->throttleKey());

        throw ValidationException::withMessages([
            'email' => trans('auth.throttle', [
                'seconds' => $seconds,
                'minutes' => ceil($seconds / 60),
            ]),
        ]);
    }

    /**
     * Get the rate limiting throttle key for the request.
     */
    public function throttleKey(): string
    {
        return Str::transliterate(Str::lower($this->input('email')).'|'.$this->ip());
    }
}
/*
**
auth

<?php 
 
namespace App\Http\Controllers\API; 
 
use Illuminate\Http\Request; 
use App\Http\Controllers\Controller; 
use DB; 
use App\User; 
use Validator; 
 
class AuthController extends Controller 
{ 
    private $apiToken; 
    public function __construct() 
    { 
        // Unique Token 
        $this->apiToken = uniqid(base64_encode(str_random(60))); 
    } 
    /** 
     * Client Login 
     */ 
   /*
     public function postLogin(Request $request) 
    { 
        // Validations 
        $rules = [ 
            'UserName'=>'required', 
            'UserPass'=>'required' 
        ]; 
 
        $validator = Validator::make($request->all(), $rules); 
 
        if ($validator->fails()) { 
            // Validation failed 
            return response()->json([ 
                'message' => 'Le nom d\'utilisateur et le mot de passe sont requis.', 
            ], 401); 
        } else { 
            // Fetch User 
            $user = User::where('UserName',$request->UserName)->first(); 
            if($user) { 
                // Verify the password 
                if( password_verify($request->UserPass, $user->UserPass) ) { 
                    // check serial number 
                    if($user->SerialNumber !== $request->header('SerialNumber')) 
                    { 
                        return response()->json([ 
                            'status' => 'error', 
                            'message' => 'Vous n\'êtes pas autorisé à utiliser ce téléphone.', 
                        ], 401); 
                    } 
 
                    // Update Token 
                    $postArray = ['APIToken' => $this->apiToken]; 
                    $login = User::where('UserName',$request->UserName)->update($postArray); 
                     
                    if($login) { 
                        return response()->json([ 
                            'status' => 'success', 
                            'UserName'    => $user->UserName, 
                            'UserId'    => $user->UserId, 
                            'BranchFId'    => $user->BranchFId, 
                            'AccessToken' => $this->apiToken, 
                        ]); 
                    } 
                } else { 
                    return response()->json([ 
                        'status' => 'error', 
                        'message' => 'Mot de passe incorrect', 
                    ], 401); 
                } 
            } else { 
                return response()->json([ 
                    'status' => 'error', 
                    'message' => 'Utilisateur non trouvé', 
                ], 401); 
            } 
        } 
    } 
 
     /** 
   * Logout 
   */ 
 
 /*
   public function postLogout(Request $request) 
    { 
        $token = $request->bearerToken(); 
        $user = User::where('APIToken',$token)->first(); 
        if($user) { 
            $postArray = ['APIToken' => null]; 
            $logout = User::where('UserId',$user->UserId)->update($postArray); 
            if($logout) { 
                return response()->json([ 
                    'status' => 'success', 
                    'message' => 'User Logged Out', 
                ]); 
            } 
        } else { 
            return response()->json([ 
                'status' => 'error', 
                'message' => 'User not found', 
            ], 401); 
        } 
    } 
 
  /** 
   * Register 
   */ 
//   public function postRegister(Request $request) 
//   { 
//     // Validations 
//     $rules = [ 
//       'name'     => 'required|min:3', 
//       'email'    => 'required|unique:users,email', 
//       'password' => 'required|min:8' 
//     ]; 
//     $validator = Validator::make($request->all(), $rules); 
//     if ($validator->fails()) { 
//       // Validation failed 
//       return response()->json([ 
//         'message' => $validator->messages(), 
//       ]); 
//     } else { 
//       $postArray = [ 
//         'name'      => $request->name, 
//         'email'     => $request->email, 
//         'password'  => bcrypt($request->password), 
//
