<?php

namespace App\Http\Controllers\Doctor\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Doctor\RegisterRequest;
use App\Providers\RouteServiceProvider;
use App\Services\Helpers\EmailService;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;
use App\Services\UserService;
use App\Services\User\ProfileService;
use App\Enums\User\Type as UserType;
use App\Models\User;
use App\Jobs\UserVerifyEmailJob;
// use App\Mail\User\VerifyEmail;

class RegisterController extends Controller
{
    protected $service;
    protected $profileService;

    /*
    |--------------------------------------------------------------------------
    | Register Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users as well as their
    | validation and creation. By default this controller uses a trait to
    | provide this functionality without requiring any additional code.
    |
    */

    use RegistersUsers;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct(
        UserService $service,
        ProfileService $profileService
    ) {
        $this->middleware('guest');
        $this->service = $service;
        $this->profileService = $profileService;

    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return \App\Models\User
     */
    protected function create(array $data)
    {
        return User::create([
//            'name' => $data['name'],
            'email' => $data['email'],
            'password' => Hash::make($data['password']),
            'role' => UserType::DOCTOR,
            'is_active' => 1
            // 'confirmation_code' => sha1(time()),
        ]);
    }

    /**
     * @param Request $request
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function register(RegisterRequest $request)
    {
        //  $data = $request->all();
        //  $user = User::where('email', $data['email'])
        //      ->where('is_active', 0)
        //      ->first();

        //  if (isset($user)) {
        //      $user->delete();
        //  }

        //  $user = $this->create($request->all());
         return response()->json([
             'status' => 1,
             'message' => '',
            //  'data' => $user
             'data' => null
         ]);
    }

    public function complete()
    {
        exit("OK3");
        return view('user.register.complete_email');
    }
}
