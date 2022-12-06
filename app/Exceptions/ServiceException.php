<?php

namespace App\Exceptions;

use Illuminate\Http\Response;

class ServiceException extends \Exception
{
    protected $code = Response::HTTP_INTERNAL_SERVER_ERROR;
}
