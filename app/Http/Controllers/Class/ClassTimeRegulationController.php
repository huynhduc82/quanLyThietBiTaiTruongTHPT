<?php

namespace App\Http\Controllers\Class;

use App\Http\Controllers\Controller;
use App\Services\Class\ClassTimeRegulationService;
use App\Transformers\Class\ClassTimeRegulationsTransformers;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Request;


class ClassTimeRegulationController extends Controller
{
    public function __construct(
        protected ClassTimeRegulationService $classTimeRegulationService
    )
    {
    }


    public function storeView(): Factory|View|Application
    {
        return view('classtime/store');
    }

    public function editView($id): Factory|View|Application
    {
        $data = $this->classTimeRegulationService->details($id);
    
        return view('classtime/edit')->with(compact('data'));
    }

    public function indexView(): Factory|View|Application
    {
        $data = $this->classTimeRegulationService->index();
        return view('classtime/index')->with(compact('data'));
    }

    public function index(): JsonResponse
    {
        $result = $this->classTimeRegulationService->index();

        return $this->response($this->transform($result, ClassTimeRegulationsTransformers::class));
    }

    public function details($id): JsonResponse
    {
        $result = $this->classTimeRegulationService->details($id);

        return $this->response($this->transform($result, ClassTimeRegulationsTransformers::class));
    }

    public function store(Request $request)
    {
        $input = $request::all();

        return $this->classTimeRegulationService->store($input);
    }

    public function edit(Request $request, $id): JsonResponse
    {
        $input = $request::all();

        $result = $this->classTimeRegulationService->edit($input, $id);

        return $this->response($result);
    }

    public function delete($id): JsonResponse
    {
        $result = $this->classTimeRegulationService->delete($id);

        return $this->response($result);
    }
}
