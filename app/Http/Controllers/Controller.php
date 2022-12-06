<?php

namespace App\Http\Controllers;

use App\Services\Response\ResponseFacade;
use App\Transformers\IlluminatePaginatorAdapter;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;;

use Illuminate\Http\JsonResponse;
use Illuminate\Http\Response;
use Illuminate\Pagination\Paginator;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Support\Collection;
use Illuminate\Support\LazyCollection;


class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    protected function response(
        $data = null,
        $code = Response::HTTP_OK,
        string $message = null
    ): JsonResponse {
        return ResponseFacade::send($data, $code, $message);
    }

    protected function transform(mixed $data, mixed $classTransformer = null, array|string $includes = null): mixed
    {
        if (!empty($classTransformer) && $data !== null) {
            if (is_string($classTransformer)) {
                $classTransformer = app($classTransformer);
            }

            $fractal = fractal()->transformWith($classTransformer);
            if ($includes !== null) {
                $fractal->parseIncludes($includes);
            }

            if ($data instanceof Collection || $data instanceof LazyCollection) {
                $fractal->collection($data);
            } elseif ($data instanceof LengthAwarePaginator || $data instanceof Paginator) {
                $fractal->collection($data->getCollection())
                    ->withResourceName('data')
                    ->paginateWith(new IlluminatePaginatorAdapter($data));
            } else {
                $fractal->item($data);
            }

            $data = $fractal->toArray();
        }

        return $data;
    }
}
