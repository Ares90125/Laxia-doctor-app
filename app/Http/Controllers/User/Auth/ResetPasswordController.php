<?php

namespace App\Http\Controllers\User\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\ResetsPasswords;
use Illuminate\Http\Request;
use App\Models\Passwordnewset;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class ResetPasswordController extends Controller
{
    use ResetsPasswords;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest');
    }

    /**
     * Get the response for a successful password reset.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  string  $response
     * @return \Illuminate\Http\RedirectResponse
     */
    protected function sendResetResponse(Request $request, $response)
    {
        return ['status' => trans($response), 'reset_flag' => 'successed'];
    }
    protected function reset(Request $request)
    {
        $user=User::where('email',$request['email'])->first();
        if($user){
            $query=Passwordnewset::query();
            $query->where('type_id',$user->id);
            $query->where('token', $request['token']);
            $valid=$query->first();
            if($valid){
                $valid->delete();
                $user->password=Hash::make($request['password']);
                $user->save();
                return response()->json([
                    'success'=>true
                ], 200);
            }
        }
        return response()->json([
            'success'=>false
        ], 400);
    }
    /**
     * Get the response for a failed password reset.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  string  $response
     * @return \Illuminate\Http\RedirectResponse
     */
    protected function sendResetFailedResponse(Request $request, $response)
    {
        return response()->json(['email' => trans($response)], 400);
    }

    /**
     * Get the password reset validation rules.
     *
     * @return array
     */
    protected function rules()
    {
        return [
            'token' => 'required',
            'email' => 'required|email',
            'password' => 'required|min:6',
            'repassword' => 'required|same:password',
        ];
    }
}
