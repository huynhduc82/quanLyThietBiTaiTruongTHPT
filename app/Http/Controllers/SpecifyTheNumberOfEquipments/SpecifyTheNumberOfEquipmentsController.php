<?php

namespace App\Http\Controllers\SpecifyTheNumberOfEquipments;

use App\Http\Controllers\Controller;
use App\Services\SpecifyTheNumberOfEquipments\SpecifyTheNumberOfEquipmentsService;
use App\Transformers\SpecifyTheNumberOfEquipments\SpecifyTheNumberOfEquipmentsTransformer;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Request;


class SpecifyTheNumberOfEquipmentsController extends Controller
{
    public function __construct(
        protected SpecifyTheNumberOfEquipmentsService $specifyTheNumberOfEquipmentsService
    )
    {
    }

    public function indexView()
    {
        $include=[
            'status',
            'room'
        ];

        $data = $this->specifyTheNumberOfEquipmentsService->index($include);

        return view('equipment/index')->with(compact('data'));
    }

    public function index(): JsonResponse
    {
        $include=[

        ];

        $result = $this->specifyTheNumberOfEquipmentsService->index($include);

        return $this->response($this->transform($result, SpecifyTheNumberOfEquipmentsTransformer::class, $include));
    }

    public function details($id): JsonResponse
    {
        $include=[
            'status',
            'room'
        ];

        $result = $this->specifyTheNumberOfEquipmentsService->details($id, $include);

        return $this->response($this->transform($result, SpecifyTheNumberOfEquipmentsTransformer::class, $include));
    }

    public function getByCourseDetailId($id): JsonResponse
    {
        $include = [
            'equipment',
        ];

        $result = $this->specifyTheNumberOfEquipmentsService->getByCourseDetailId($id, $include);

        return $this->response($this->transform($result, SpecifyTheNumberOfEquipmentsTransformer::class, $include));
    }

    public function store(Request $request)
    {
        $input = $request::all();

        $result = $this->specifyTheNumberOfEquipmentsService->store($input);

        return $result;
    }

    public function edit(Request $request, $id): JsonResponse
    {
        $input = $request::all();

        $result = $this->specifyTheNumberOfEquipmentsService->edit($input, $id);

        return $this->response($result);
    }

    public function delete($id): JsonResponse
    {
        $result = $this->specifyTheNumberOfEquipmentsService->delete($id);

        return $this->response($result);
    }

    public function calEquipmentQuantity(Request $request)
    {
        $input = $request::all();

        $result = $this->specifyTheNumberOfEquipmentsService->calEquipmentQuantity($input);

        return $this->response($result);
    }
}
