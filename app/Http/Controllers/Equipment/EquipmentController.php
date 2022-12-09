<?php

namespace App\Http\Controllers\Equipment;

use App\Http\Controllers\Controller;
use App\Services\Equipment\EquipmentService;
use App\Transformers\Equipment\EquipmentTransformers;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Request;


class EquipmentController extends Controller
{
    public function __construct(
        protected EquipmentService $equipmentService
    )
    {
    }

    public function index(): JsonResponse
    {
        $include=[
            'status',
            'room'
        ];

        $result = $this->equipmentService->index($include);

        return $this->response($this->transform($result, EquipmentTransformers::class, $include));
    }

    public function details($id): JsonResponse
    {
        $include=[
            'status',
            'room'
        ];

        $result = $this->equipmentService->details($id, $include);

        return $this->response($this->transform($result, EquipmentTransformers::class, $include));
    }

    public function store(Request $request)
    {
        $input = $request::all();

        $result = $this->equipmentService->store($input);

        return $result;
    }

    public function edit(Request $request, $id): JsonResponse
    {
        $input = $request::all();

        $result = $this->equipmentService->edit($input, $id);

        return $this->response($result);
    }

    public function delete($id): JsonResponse
    {
        $result = $this->equipmentService->delete($id);

        return $this->response($result);
    }
}
