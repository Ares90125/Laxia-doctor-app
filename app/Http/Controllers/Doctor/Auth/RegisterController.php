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
use Illuminate\Contracts\Auth\MustVerifyEmail;

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
     * The user has been registered.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\JsonResponse
     */
    protected function registered(Request $request, User $user)
    {
        if ($user instanceof MustVerifyEmail) {
            return response()->json(['status' => trans('verification.sent')]);
        }

        return response()->json($user);
    }

    
    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        return Validator::make($data, [
//            'name' => 'required|max:255|unique:users',
            'email' => 'required|email|max:255|unique:users',
            'password' => 'required|min:6',
        ],
        [
            'email.required' => '正しいメールアドレスを入力してください',
            'password.required' => '6文字以上で入力してください',
            'password.min' => '6文字以上で入力してください'
        ]);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return \App\Models\User
     */
    protected function create(array $data)
    {
        \DB::beginTransaction();

        try {
            $user = User::create([
//                'name' => $data['name'],
                'email' => $data['email'],
                'password' => bcrypt($data['password']),
                'role' =>  UserType::DOCTOR,
                'is_active' => 1
            ]);

            \DB::commit();
        } catch (\Throwable $e) {
            \DB::rollBack();
            \Log::error($e->getMessage());

            return back()
                ->with(['system.message.danger' => __('lang.delete.failed', ['name' => __('lang.agent')])]);
        }
        return $user;
    }
}
