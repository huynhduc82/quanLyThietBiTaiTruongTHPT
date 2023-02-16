<?php

namespace App\Http\Controllers\SpecifyTheNumberOfEquipments;

use App\Http\Controllers\Class\ClassController;
use App\Http\Controllers\Controller;
use App\Http\Controllers\Grades\GradeController;
use App\Models\TypeOfEquipments\TypeOfEquipment;
use App\Repositories\Eloquents\Equipment\TypeOfEquipmentRepo;
use App\Services\Courses\CourseDetailsService;
use App\Services\Courses\CourseService;
use App\Services\Equipment\TypeOfEquipmentService;
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
            'equipment'
        ];

        $data = $this->specifyTheNumberOfEquipmentsService->index($include);
//      dd($data->toArray());
        return view('specifythenumberofequipment/index')->with(compact('data'));
    }
    public function storeView()
    {
        $gradeData = app(GradeController::class)->index();
        $classData = app(ClassController::class)->index();
        $courseData = app(CourseService::class)->index();
        $courseDetailData = app(CourseDetailsService::class)->index();
        $typeOfEquipmentData = app(TypeOfEquipmentRepo::class)->getModel()->newQuery()->get();

        return view('specifythenumberofequipment/store')->with(compact(['courseData','courseDetailData','gradeData','classData','typeOfEquipmentData']));
    }

    public function editView($id)
    {
        $include = [

        ];

        $data = $this->specifyTheNumberOfEquipmentsService->details($id);

        return view('specifythenumberofequipment/edit')->with(compact('data'));
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

    public function getByName($name): JsonResponse
    {
        $include = [
            'equipment',
        ];

        $result = $this->specifyTheNumberOfEquipmentsService->getByName($name, $include);

        return $this->response($this->transform($result, SpecifyTheNumberOfEquipmentsTransformer::class, $include));
    }

    public function getByCourseId($id): JsonResponse
    {
        $include = [
            'equipment',
        ];

        $result = $this->specifyTheNumberOfEquipmentsService->getByCourseId($id, $include);

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

    public function searchByName(\Illuminate\Support\Facades\Request $request)
    {
        $include=[
        ];


        $input = $request::all();

        $data = $this->specifyTheNumberOfEquipmentsService->searchByName($input, $include);

        return view('specifythenumberofequipment/index', compact('data'));
    }
}
