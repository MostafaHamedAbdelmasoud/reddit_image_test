<?php


namespace App\Models\Helpers;


use App\Models\Admin;
use Illuminate\Support\Facades\Auth;

/**
 * Class UserHelper
 * @package App\Models\Helpers
 */
trait UserHelper
{

    /**
     * check for admin
     * @return mixed
     */
    public function isAdmin()
    {
        return Admin::where('user_id',Auth::User()->id)->first();
    }
}
