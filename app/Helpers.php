<?php

namespace App;

use Carbon\Carbon;
use Exception;
use Illuminate\Http\UploadedFile;
use Illuminate\Pagination\AbstractPaginator;
use Illuminate\Pagination\CursorPaginator;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\ValidationException;

class Helpers
{
    const SEPARATOR = ',';

    public static function formatPagination(
        AbstractPaginator|LengthAwarePaginator|Paginator $data
    ): array {
        $perPage = $data->perPage();

        if ($data instanceof LengthAwarePaginator) {
            $totalRecord = $data->total();
            $lastPage = $data->lastPage();
        } else {
            $totalRecord = null;
        }

        return [
            'total' => $totalRecord,
            'count' => $data->count(),
            'per_page' => $perPage,
            'current_page' => $data->currentPage(),
            'last_page' => $lastPage ?? null,
            'has_more' => $data->hasMorePages(),
            'data' => $data->items(),
        ];
    }

    /**
     * @param CursorPaginator $data
     * @return array
     */
    public static function formatCursorPagination(CursorPaginator $data): array
    {
        $perPage = $data->perPage();

        return [
            'count' => $data->count(),
            'per_page' => $perPage,
            'last_page' => $lastPage ?? null,
            'has_more' => $data->hasMorePages(),
            'next_page_url' => $data->nextPageUrl(),
            'data' => $data->items(),
        ];
    }

    public static function validate(
        array $request = null,
        array $rules = [],
        array $messages = [],
        bool $throw = true
    ) {
        $request = $request ? $request : app('request')->all();

        $validator = Validator::make(
            $request,
            $rules,
            $messages
        );

        if ($validator->fails()) {
            if ($throw) {
                return $validator->validate();
            } else {
                try {
                    $validator->validate();
                } catch (ValidationException $e) {
                    return $e->errors();
                } catch (Exception $e) {
                    return $e->getMessage();
                }
            }
        }

        return true;
    }

    public static function getUserLoginId()
    {
        if(!empty(Auth::user()))
        {
            return Auth::user()->id;
        }
        return null;
    }

    public static function fromFile($file): UploadedFile
    {
        $newFile = new UploadedFile(
            $file->getPathname(),
            $file->getFilename(),
            $file->getMimeType(),
            0,
            true
        );

        return $newFile;
    }

    public static function getTimeNow()
    {
        $day = Carbon::now()->day; //ngày
        $month = Carbon::now()->month; //tháng
        $year = Carbon::now()->year; //năm
        $hour = Carbon::now()->hour; //giờ
        $minute = Carbon::now()->minute; //phút
        $second = Carbon::now()->second; //giây
        return $year . '_' . $month . '_' . $day . '_' . $hour . $minute . $second;
    }
}
