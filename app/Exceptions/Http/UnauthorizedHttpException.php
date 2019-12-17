<?php
/**
 * Created by PhpStorm.
 * User: pazgalev
 * Date: 12/17/19
 * Time: 10:41 AM
 */

namespace App\Exceptions\Http;


class UnauthorizedHttpException extends \Symfony\Component\HttpKernel\Exception\UnauthorizedHttpException
{
    public function __construct($message = null, \Throwable $previous = null, $code = 0, array $headers = [])
    {
        $message = $message ?? 'Unauthenticated.';
        parent::__construct('Bearer', $message, $previous, $code, $headers);
    }
}