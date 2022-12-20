<?php

namespace App\Http\Controllers\Course;

use App\Http\Controllers\Controller;
use App\Imports\CoursesDetailsImport;
use App\Services\Courses\CourseService;
use App\Transformers\Course\CourseTransformer;
use App\Transformers\Equipment\EquipmentTransformers;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Request;
use Maatwebsite\Excel\Facades\Excel;


class CourseController extends Controller
{
    public function __construct(
        protected CourseService $courseService
    )
    {
    }

    public function indexView()
    {
        $include = [
            'status',
            'room'
        ];

        $data = $this->courseService->index($include);

        return view('equipment/index')->with(compact('data'));
    }

    public function index(): JsonResponse
    {
        $include = [
            'grade',
        ];

        $result = $this->courseService->index($include);

        return $this->response($this->transform($result, CourseTransformer::class, $include));
    }

    public function details($id): JsonResponse
    {
        $include = [
            'status',
            'room'
        ];

        $result = $this->courseService->details($id, $include);

        return $this->response($this->transform($result, EquipmentTransformers::class, $include));
    }

    public function store(Request $request)
    {
        $input = $request::all();

        $result = $this->courseService->store($input);

        return $result;
    }

    public function edit(Request $request, $id): JsonResponse
    {
        $input = $request::all();

        $result = $this->courseService->edit($input, $id);

        return $this->response($result);
    }

    public function delete($id): JsonResponse
    {
        $result = $this->courseService->delete($id);

        return $this->response($result);
    }

    public function importCourseDetail(Request $request): JsonResponse
    {
        $file = $request::all()['file'];

        Excel::import(new CoursesDetailsImport, $file);

        return $this->response(123);
    }
}
