<?php

namespace App\Http\Controllers\Equipment;

use App\Http\Controllers\Controller;
use App\Services\Equipment\TypeOfEquipmentService;
use App\Transformers\Equipment\TypeOfEquipmentTransformers;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class TypeOfEquipmentController extends Controller
{
    public function __construct(
        protected TypeOfEquipmentService $typeOfEquipmentService,
    )
    {
    }

    public function indexView()
    {
        $include=[
            'equipments',
            'imagesInfo'
        ];

        $data = $this->typeOfEquipmentService->index($include);

        return view('equipment/index')->with(compact('data'));
    }

    public function storeView()
    {
        return view('equipment/store');
    }

    public function editView($id)
    {
        $include=[
            'equipments',
            'imagesInfo',
        ];

        $data = $this->typeOfEquipmentService->details($id, $include);

        return view('equipment/edit')->with(compact('data'));
    }

    public function index(): JsonResponse
    {
        $include=[
            'equipments',
            'imagesInfo',
        ];

        $result = $this->typeOfEquipmentService->index($include);

        return $this->response($this->transform($result,TypeOfEquipmentTransformers::class,$include));
    }

    public function detail($id): JsonResponse
    {
        $include=[
            'equipments',
            'imagesInfo',
        ];

        $result = $this->typeOfEquipmentService->details($id, $include);

        return $this->response($this->transform($result,TypeOfEquipmentTransformers::class,$include));
    }

    public function store(Request $request): JsonResponse
    {
        $input = $request->all();

        $result = $this->typeOfEquipmentService->store($input);

        return $this->response($result);
    }

    public function edit(Request $request, $id): JsonResponse
    {
        $input = $request->all();

        $result = $this->typeOfEquipmentService->edit($input, $id);

        return $this->response($result);
    }

    public function delete($id)
    {
        $result = $this->typeOfEquipmentService->delete($id);

        return $this->response($result);
    }
}
