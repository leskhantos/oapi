<?php
/**
 * Created by PhpStorm.
 * User: pazgalev
 * Date: 12/19/19
 * Time: 12:49 PM
 */

namespace App\Exceptions\Http;


use Symfony\Component\HttpKernel\Exception\HttpException;

class ForbiddenHttpException extends HttpException
{
    public function __construct(string $message = null, \Throwable $previous = null, array $headers = [], ?int $code = 0)
    {
        $message = $message ?? 'Access forbidden';
        parent::__construct(403, $message, $previous, $headers, $code);
    }
}