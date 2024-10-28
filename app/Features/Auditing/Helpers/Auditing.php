<?php

namespace App\Features\Auditing\Helpers;

use App\Features\Auditing\Models\UserLog;
use Illuminate\Support\Facades\Auth;

class Auditing
{

    /**
     * list of allowed actions values
     *
     * @var array
     */
    public static $allowedActions = [
        'login'     => 'قام بتسجيل الدخول'
    ];

    /**
     * Write new log for user auditing
     *
     * @static log($action)
     * @param string $action The action of user.
     * @throws \Exception
     * @return void
     */
    public static function log(string $action): void
    {
        if (! in_array($action, array_keys(static::$allowedActions) ) ) {
            $items = implode("', '", array_keys(static::$allowedActions));
            throw new \Error("The action '$action' not in ['$items']" );
        }

        $log = UserLog::create([
            'user_id'   => Auth::id() ?? 0,
            'action'    => $action,
            'action_ar' => static::$allowedActions[$action]
        ]);
    }
}
