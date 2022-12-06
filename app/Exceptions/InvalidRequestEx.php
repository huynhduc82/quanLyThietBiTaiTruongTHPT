<?php

namespace App\Exceptions;

use Exception;
use Illuminate\Http\Response;

class InvalidRequestEx extends Exception
{
    private $status;

    public function __construct($message, $status = Response::HTTP_BAD_REQUEST)
    {
        $this->status = $status;
        parent::__construct($message);
    }

    public function getStatus()
    {
        return $this->status;
    }

    public static function with($message, $status = Response::HTTP_BAD_REQUEST)
    {
        return new self($message, $status);
    }

    public static function withMissingParameter($paramName)
    {
        return new self(
            __('Missing parameter :name.', ['name' => __("parameters.$paramName")]),
            Response::HTTP_BAD_REQUEST
        );
    }

    public static function withInvalidParameter($paramName)
    {
        return new self(
            __('Parameter :name is invalid.', ['name' => __("parameters.$paramName")]),
            Response::HTTP_BAD_REQUEST
        );
    }

    public static function withEmptyParameter($paramName)
    {
        return new self(
            __('Parameter :name must be not empty.', ['name' => __("parameters.$paramName")]),
            Response::HTTP_BAD_REQUEST
        );
    }
}
