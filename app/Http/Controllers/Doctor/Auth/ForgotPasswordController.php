<?php

namespace App\Http\Controllers\Doctor\Auth;

use App\Mail\UserVerifyEmail;
use Illuminate\Support\Facades\Mail;
use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\SendsPasswordResetEmails;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Passwordnewset;
use Illuminate\Support\Facades\Hash;


class ForgotPasswordController extends Controller
{
    use SendsPasswordResetEmails;

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
     * Get the response for a successful password reset link.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  string  $response
     * @return \Illuminate\Http\RedirectResponse
     */
    protected function sendResetLinkResponse(Request $request, $response)
    {
        return ['status' => trans($response), 'send_flag' => 'successed'];
    }

    /**
     * Get the response for a failed password reset link.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  string  $response
     * @return \Illuminate\Http\RedirectResponse
     */
    protected function sendResetLinkFailedResponse(Request $request, $response)
    {
        return response()->json(['email' => trans($response)], 400);
    }
    protected function sendResetLinkEmail(Request $request){
        $user=User::where('email',$request['email'])->first();
        if($user){
            $permitted_chars = 'abcdefghijklmnopqrstuvwxyz';
            $token=substr(str_shuffle($permitted_chars), 0, 5);
            $data=new Passwordnewset;
            $data->type_id=$user->id;
            $data->token=Hash::make($token);
            $data->save();
        }
        $details = [
            'email'=>$request['email'],
            'token' => Hash::make($token)
        ];
        Mail::to($request['email'])->send(new UserVerifyEmail($details));
        // return new JsonResponse(
        //     [
        //         'success' => true,
        //         'message' => "Thank you for subscribing to our email, please check your inbox"
        //     ],
        //     200
        // );
        return response()->json(['send_flag' => 'successed'], 200);
    }
}
