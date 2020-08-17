<?php
namespace App\Helper;

use Illuminate\Support\Facades\Auth;

class Helper
{
    public static function avatar ()
    {
        $a = Auth::user()->profile->avatar;
        if (strpos($a, 'http') !== false) {
            $avatar = $a;
        } else if ($a != '') {
            $avatar = asset('storage/'.$a);
        } else {
            $avatar = asset('storage/sa/img_avatar.png');
        }
        return $avatar;
    }

    public static function authProfile($feild, $else) {
        return auth()->user()->profile->$feild != '' ? auth()->user()->profile->$feild : $else;
    }
}
