<?php

namespace App\Http\Controllers\Course;

use App\Http\Controllers\Controller;
use App\Imports\CoursesDetailsImport;
use App\Services\Courses\CourseDetailsService;
use App\Transformers\Course\CourseDetailsTransformer;
use App\Transformers\Course\CourseTransformer;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Request;
use Maatwebsite\Excel\Facades\Excel;


class CourseDetailController extends Controller
{
    public function __construct(
        protected CourseDetailsService $courseDetailsService
    )
    {
    }

    public function index(): JsonResponse
    {
        $include = [
        ];

        $result = $this->courseDetailsService->index($include);

        return $this->response($this->transform($result, CourseDetailsTransformer::class, $include));
    }

    public function indexData()
    {
        $include = [
        ];

        $result = $this->courseDetailsService->index($include);

        return $this->transform($result, CourseDetailsTransformer::class, $include);
    }

    public function details($id): JsonResponse
    {
        $include = [
        ];

        $result = $this->courseDetailsService->details($id, $include);

        return $this->response($this->transform($result, CourseDetailsTransformer::class, $include));
    }

    public function store(Request $request)
    {
        $input = $request::all();

        $result = $this->courseDetailsService->store($input);

        return $result;
    }

    public function edit(Request $request, $id): JsonResponse
    {
        $input = $request::all();

        $result = $this->courseDetailsService->edit($input, $id);

        return $this->response($result);
    }

    public function delete($id): JsonResponse
    {
        $result = $this->courseDetailsService->delete($id);

        return $this->response($result);
    }

    public function importCourseDetail(Request $request): JsonResponse
    {
        $file = $request::all()['file'];

        Excel::import(new CoursesDetailsImport, $file);

        return $this->response(123);
    }
}
