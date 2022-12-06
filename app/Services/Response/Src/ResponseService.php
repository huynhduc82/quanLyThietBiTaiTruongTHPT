<?php
/**
 * Created by PhpStorm.
 * User: Phung Le
 * Date: 10/7/2020
 * Time: 3:49 PM.
 */

namespace App\Services\Response\Src;

use App\Exceptions\InvalidRequestEx;
use App\Helpers;
use ErrorException;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\Exceptions\ThrottleRequestsException;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Response;
use Illuminate\Pagination\CursorPaginator;
use Illuminate\Validation\UnauthorizedException;
use Illuminate\Validation\ValidationException;
use Prettus\Validator\Exceptions\ValidatorException;
use Symfony\Component\HttpKernel\Exception\BadRequestHttpException;
use Symfony\Component\HttpKernel\Exception\HttpException;
use Symfony\Component\HttpKernel\Exception\UnauthorizedHttpException;
use Throwable;

class ResponseService
{
    /**
     * @var string[]
     */
    protected array $allowMessage = [
        ValidationException::class,
        InvalidRequestEx::class,
        ModelNotFoundException::class,
        UnauthorizedException::class,
        UnauthorizedHttpException::class,
        ValidatorException::class,
    ];

    protected string $errorCodes = 'error_codes';

    public function send(
        $data,
        $code = Response::HTTP_OK,
        $message = null,
        $meta = []
    ): JsonResponse {
        $result = [
            'status' => false,
            'message' => null,
            'message_code' => null,
            'data' => null,
            'meta' => $meta === [] ? null : $meta,
        ];

        if ($code === Response::HTTP_OK) {
            $result['status'] = true;
        }

        if ($code === Response::HTTP_OK && !($data instanceof Throwable)) {
            if (is_string($data)) {
                $result['message'] = $data;
            } else {
                if ($data instanceof LengthAwarePaginator) {
                    $data = Helpers::formatPagination($data);
                } elseif ($data instanceof CursorPaginator) {
                    $data = Helpers::formatCursorPagination($data);
                }
                $result['data'] = $data;
                $result['message'] = $message;
            }
        } elseif ($data instanceof Throwable) {
            $result['status'] = false;

            $code = $this->getExceptionStatusCode($data);

            $enable = config('env.app_debug');
            $enable = filter_var(
                $enable,
                FILTER_VALIDATE_BOOLEAN
            );
            if ($enable) {
                // Allow debug
                $result = array_merge($result, $this->getExceptionMessageData($data));
                $result['traces'] = $this->getExceptionTrace($data);
                if (!is_null($data->getPrevious())) {
                    $result['previous'] = $data->getPrevious()->getMessage();
                }
            } elseif (in_array(get_class($data), $this->allowMessage, true)) {
                $result = array_merge($result, $this->getExceptionMessageData($data));
            } else {
                $result['message'] =
                    __('messages.response_invalid');
            }
            $result['meta'] = $this->getExceptionMeta($data);
        } elseif (is_string($data)) {
            $result['message'] = $data;
        } else {
            $result['data'] = $data;
            $result['message'] = $message;
        }

        return response()->json($result, $code);
    }

    private function getExceptionStatusCode(Throwable $exception): int
    {
        $statusCode = Response::HTTP_BAD_REQUEST;
        switch (get_class($exception)) {
            case InvalidRequestEx::class:
                /* @var InvalidRequestEx $exception */
                return $exception->getStatus();
            case ErrorException::class:
            case BadRequestHttpException::class:
                return Response::HTTP_INTERNAL_SERVER_ERROR;
            default:
                if ($exception instanceof HttpException) {
                    return $exception->getStatusCode();
                }
                break;
        }

        if (method_exists($exception, 'getCode')) {
            $code = (int) $exception->getCode();

            return ($code >= 100 && $code < 600) ? $code : $statusCode;
        }

        return $statusCode;
    }

    private function getExceptionMessageData(Throwable $exception): array
    {
        $result = [];
        switch (get_class($exception)) {
            case ValidatorException::class:
                /** @var ValidatorException $exception */
                $result = [
                    'data' => $exception->getMessageBag(),
                    'message' => $exception->getMessageBag()->first(),
                ];
                break;
            case ValidationException::class:
                /** @var ValidationException $exception */
                $result = [
                    'data' => $exception->errors(),
                    'message' => $exception->validator->getMessageBag()->first(),
                ];
                break;
            case ModelNotFoundException::class:
                /** @var ModelNotFoundException $exception */
                /** @var Model $model */
                $model = app($exception->getModel());
                $modelName = __('model.' . $model->getTable());
                $result = [
                    'message' => __('error_codes.Mdlx000002', [
                        'feild' => $modelName,
                    ]),
                    'message_code' => 'Mdlx000002',
                ];
                unset($model, $modelName);
                break;
            case ThrottleRequestsException::class:
                $result = [
                    'message' => __('messages.too_many_requests'),
                ];

                break;
            case UnauthorizedHttpException::class:
                /** @var UnauthorizedHttpException $exception */
                $result = [
                    'message' => $exception->getHeaders()['WWW-Authenticate'] ?? 'Unauthorized',
                ];

                break;
            default:
                $result = [
                    'message' => $exception->getMessage(),
                ];
                break;
        }

        $key = $this->errorCodes . '.' . $result['message'];
        if ((string) __($key) !== $key) {
            $result['message_code'] = $result['message'];
            $result['message'] = __($key);
        }

        return $result;
    }

    private function getExceptionMeta(Throwable $exception): string
    {
        $meta = class_basename($exception);
        if (method_exists($exception, 'getMeta')) {
            $meta = $exception->getMeta();
        }

        return $meta;
    }

    private function getExceptionTrace(Throwable $exception): mixed
    {
        $traceStr = $exception->getTraceAsString();
        $arr = preg_split('/#\d+\s+/', trim($traceStr));
        unset($arr[0]);

        return array_chunk($arr, 100)[0];
    }
}
