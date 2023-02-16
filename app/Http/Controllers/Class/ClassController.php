<?php

namespace App\Http\Controllers\Class;

use App\Http\Controllers\Controller;
use App\Imports\ClassesImport;
use App\Models\Class\Classes;
use App\Services\Class\ClassService;
use App\Services\Courses\CourseService;
use App\Services\Grades\GradeService;
use App\Transformers\Class\ClassTransformer;
use App\Transformers\Course\CourseTransformer;
use App\Transformers\Equipment\EquipmentTransformers;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Request;
use Maatwebsite\Excel\Facades\Excel;


class ClassController extends Controller
{
    public function __construct(
        protected ClassService $classService
    )
    {
    }

    public function indexView()
    {
        $include = [
        ];

        $data = $this->classService->index($include);

        return view('class/index')->with(compact('data'));
    }

    public function editView($id)
    {
        $include = [
        ];

        $data = $this->classService->details($id, $include);
        $gradeData = app(GradeService::class)->index();

        return view('class/edit')->with(compact(['data', 'gradeData']));
    }

    public function storeView()
    {
        $gradeData = app(GradeService::class)->index();

        return view('class/store')->with(compact('gradeData'));
    }

    public function index()
    {
        $include = [
            'grade',
        ];

        $result = $this->classService->index($include);

        return $this->transform($result, ClassTransformer::class, $include);
    }

    public function details($id): JsonResponse
    {
        $include = [
            'grade',
        ];

        $result = $this->classService->details($id, $include);

        return $this->response($this->transform($result, ClassTransformer::class, $include));
    }

    public function store(Request $request)
    {
        $input = $request::all();

        $result = $this->classService->store($input);

        return $result;
    }

    public function edit(Request $request, $id): JsonResponse
    {
        $input = $request::all();

        $result = $this->classService->edit($input, $id);

        return $this->response($result);
    }

    public function delete($id): JsonResponse
    {
        $result = $this->classService->delete($id);

        return $this->response($result);
    }

    public function importClass(Request $request): JsonResponse
    {
        $file = $request::all()['file'];

        Excel::import(new ClassesImport(), $file);

        return $this->response(123);
    }

    public function getByName($name, $id)
    {
        $include = ['type'];
        $result = $this->classService->getByName($name, $id, $include);

        return $this->response($result);
    }
}
