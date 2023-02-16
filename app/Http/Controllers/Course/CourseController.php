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
use App\Http\Controllers\Grades\GradeController;


class CourseController extends Controller
{
    public function __construct(
        protected CourseService $courseService
    )
    {
    }

    public function storeView()
    {
        $include = [

        ];

        $gradeData = app(GradeController::class)->index();

        return view('course/store')->with(compact('gradeData'));
    }

    public function editView($id)
    {
        $data = $this->courseService->details($id);

        return view('course/edit')->with(compact('data'));
    }

    public function indexView()
    {
        $include = [
            'courseDetails'
        ];

        $data = $this->courseService->index($include);

        return view('course/index')->with(compact('data'));
    }

    public function index(): JsonResponse
    {
        $include = [
            'grade',
            'courseDetails',
        ];

        $result = $this->courseService->index($include);

        return $this->response($this->transform($result, CourseTransformer::class, $include));
    }

    public function indexData()
    {
        $include = [
            'grade',
            'courseDetails',
        ];

        $result = $this->courseService->index($include);

        return $this->transform($result, CourseTransformer::class, $include);
    }

    public function details($id): JsonResponse
    {
        $include = [
            'grade',
            'courseDetails',
        ];

        $result = $this->courseService->details($id, $include);

        return $this->response($this->transform($result, CourseTransformer::class, $include));
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

    public function searchByName(\Illuminate\Support\Facades\Request $request)
    {
        $include=[
        ];

        $input = $request::all();

        $data = $this->courseService->searchByName($input, $include);

        return view('course/index', compact('data'));
    }
}
