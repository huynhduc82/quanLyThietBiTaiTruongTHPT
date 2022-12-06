<?php

namespace App\Services\Response;

use App\Services\Response\Src\ResponseService;
use Illuminate\Support\Facades\Facade;

class ResponseFacade extends Facade
{
    protected static function getFacadeAccessor()
    {
        return ResponseService::class;
    }
}
