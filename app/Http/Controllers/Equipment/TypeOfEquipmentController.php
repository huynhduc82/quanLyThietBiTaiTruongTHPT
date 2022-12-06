<?php

namespace App\Http\Controllers\Equipment;

use App\Http\Controllers\Controller;
use App\Services\Equipment\TypeOfEquipmentService;
use App\Transformers\Equipment\TypeOfEquipmentTransformers;
use Illuminate\Support\Facades\Request;

class TypeOfEquipmentController extends Controller
{
    public function __construct(
        protected TypeOfEquipmentService $typeOfEquipmentService,
    )
    {
    }

    public function index()
    {
        $include=[
            'equipments',
            'imagesInfo',
        ];

        $result = $this->typeOfEquipmentService->index($include);

        return $this->response($this->transform($result,TypeOfEquipmentTransformers::class,$include));
    }

    public function detail($id)
    {
        $include=[
            'equipments',
            'imagesInfo',
        ];

        $result = $this->typeOfEquipmentService->details($id, $include);

        return $this->response($this->transform($result,TypeOfEquipmentTransformers::class,$include));
    }

    public function store(Request $request)
    {
        $input = $request::all();

        $result = $this->typeOfEquipmentService->store($input);

        return $this->response($result);
    }

    public function edit()
    {

    }

    public function delete()
    {

    }
}
