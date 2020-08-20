<?php
namespace App\Helper;

use Illuminate\Support\Facades\Auth;

class Helper
{
    public static function avatar ($for)
    {
        if (strpos($for, 'http') !== false) {
            $avatar = $for;
        } else if ($for != '') {
            $avatar = asset('storage/'.$for);
        } else {
            $avatar = asset('storage/sa/img_avatar.png');
        }
        return $avatar;
    }

}
