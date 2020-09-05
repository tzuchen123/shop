<?php

namespace App\Http\Controllers;

use Hash; //雜湊
use Mail; //寄信
use Validator; //驗證器
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;

use Laravel\Socialite\Facades\Socialite;
use App\Shop\Entity\User; //使用者 Eloquent ORM Model

class UserAuthController extends Controller
{
    //Facebook登入
    public function facebookSignInProcess()
    {
        $redirect_url = env('FB_REDIRECT');

        return Socialite::driver('facebook')
            ->scopes(['user_friends'])
            ->redirectUrl($redirect_url)
            ->redirect();
    }

    //Facebook登入重新導向授權資料處理
    public function facebookSignInCallbackProcess()
    {
        if(request()->error=="access_denied")
        {
            throw new Exception('授權失敗，存取錯誤');
        }
        //依照網域產出重新導向連結 (來驗證是否為發出時同一callback)
        $redirect_url = env('FB_REDIRECT');
        //取得第三方使用者資料
        /*
        $user = Socialite::driver('facebook')->user();
        var_dump($user);
        //*/
        $FacebookUser = Socialite::driver('facebook')
            ->fields([
                'name',
                'email',
            ])
            ->redirectUrl($redirect_url)->user();
       
        $facebook_email = $FacebookUser->email;

        if(is_null($facebook_email))
        {
            throw new Exception('未授權取得使用者 Email');
        }
        //取得 Facebook 資料
        $facebook_id = $FacebookUser->id;
        $facebook_name = $FacebookUser->name;

        echo "facebook_id=".$facebook_id.", facebook_name=".$facebook_name;
        //*/
    }

}
