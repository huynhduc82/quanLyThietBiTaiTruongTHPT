<?php

namespace App\Http\Controllers\Grades;

use App\Http\Controllers\Controller;
use App\Services\Grades\GradeService;
use App\Transformers\Grades\GradeTransformers;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Request;

class GradeController extends Controller
{
    public function __construct(
        protected GradeService $gradeService
    )
    {
    }

    public function storeView()
    {
        $include = [

        ];

        $data = $this->gradeService->index($include);

        return view('grade/store')->with(compact('data'));
    }

    public function editView($id)
    {
        $include = [

        ];

        $data = $this->gradeService->details($id, $include);

        return view('grade/edit')->with(compact('data'));
    }
    public function indexView()
    {
        $include = [
        ];

        $data = $this->gradeService->index($include);

        return view('grade/index')->with(compact('data'));
    }

    public function index()
    {
        $include = [
        ];

        $result = $this->gradeService->index($include);

        return $this->transform($result, GradeTransformers::class, $include);
    }

    public function details($id): JsonResponse
    {
        $include = [
        ];

        $result = $this->gradeService->details($id, $include);

        return $this->response($this->transform($result, GradeTransformers::class, $include));
    }

    public function store(Request $request)
    {
        $input = $request::all();

        $result = $this->gradeService->store($input);

        return $result;
    }

    public function edit(Request $request, $id): JsonResponse
    {
        $input = $request::all();

        $result = $this->gradeService->edit($input, $id);

        return $this->response($result);
    }

    public function delete($id): JsonResponse
    {
        $result = $this->gradeService->delete($id);

        return $this->response($result);
    }
}
