<?php

namespace App\Http\Controllers\User\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Str;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Socialite;
use Exception;
use Auth;
use Hash;
use Cache;
use File;

class SocialController extends Controller
{
    public function redirect($provider) {
        return Socialite::driver($provider)
            ->redirect();
    }

    public function callback($provider) {
        // \DB::beginTransaction();
        // try {
            $userSocial = Socialite::driver($provider)
                ->stateless()
                ->user();

            $user = User::where([
                'email' => $userSocial->email
            ])->first();

            if (!$user) {
                $user = User::create([
                    'name'  => $userSocial->name,
                    'email' => $userSocial->email,
                    'password' => null,
                    'is_active' => 1,
                    'provider' => $provider,
                    'provider_id' => $userSocial->id
                ]);
            }
            
            Auth::guard('patient')->setToken(
                $token = Auth::guard('patient')->login($user)
            );
            
            // \DB::commit();
        // } catch (Exception $e) {
        //     \DB::rollBack();
        //     \Log::error($e->getMessage());

        //     return response()->json([
        //         'status' => 0,
        //         'message' => 'ユーザーを登録できません。'
        //     ]);
        // }

        return redirect("/?token=$token");
    }

    private function getSocialAvatar($file, $path='/images/avatar/'){
        $fileContents = file_get_contents($file);
        $file_path = $path . time().Str::random(6) . ".jpg";
        return File::put(public_path().$file_path, $fileContents) ? $file_path : null;
    }
}
