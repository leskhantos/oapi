<?php
/**
 * Created by PhpStorm.
 * User: pazgalev
 * Date: 12/18/19
 * Time: 2:13 PM
 */

namespace App\Exceptions\Http\Auth;


use App\Exceptions\Http\UnauthorizedHttpException;

class InvalidToken extends UnauthorizedHttpException
{
    public function __construct()
    {
        $message = 'Invalid token';
        parent::__construct($message, null, 2, []);
    }
}