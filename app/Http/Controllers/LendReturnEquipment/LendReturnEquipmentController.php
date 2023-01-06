<?php

namespace App\Http\Controllers\LendReturnEquipment;

use App\Http\Controllers\Class\ClassController;
use App\Http\Controllers\Controller;
use App\Http\Controllers\Course\CourseController;
use App\Http\Controllers\Course\CourseDetailController;
use App\Http\Controllers\Grades\GradeController;
use App\Services\LendReturnEquipments\LendReturnEquipmentService;
use App\Services\Rooms\RoomServices;
use App\Transformers\LendReturnEquipment\LendReturnEquipmentTransformer;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Request;

class LendReturnEquipmentController extends Controller
{
    public function __construct(
        protected LendReturnEquipmentService $service
    )
    {
    }

    public function indexView()
    {
        $include = [
            'details',
            'details.equipments',
            'user',
            'lender',
            'returner'
        ];

        $data = $this->service->index($include);
        return view('lendreturn/index')->with(compact('data'));
    }

    public function storeView()
    {
        $gradeData = app(GradeController::class)->index();
        $classData = app(ClassController::class)->index();
        $roomData = app(RoomServices::class)->index();
        $courseData = app(CourseController::class)->indexData();
        $courseDetailData = app(CourseDetailController::class)->getNeedEquipment();
        return view('lendreturn/store')->with(compact('roomData','gradeData', 'classData', 'courseData'
            , 'courseDetailData'));
    }

    public function index()
    {
        $include = [
            'details',
            'details.equipments'
        ];

        return $this->response($this->transform($this->service->index($include),
            LendReturnEquipmentTransformer::class, $include));
    }

    public function getLendReturnByDay(Request $request)
    {
        $include = [
            'details',
            'details.equipments',
            'user',
            'lender',
            'returner'
        ];

        $input = $request::all();

        $data = $this->service->getLendReturnByDay($input, $include);

        $table_view = view('lendreturn/table_view', compact('data'))->render();

        return response()->json(['succes' => true, 'table_view' => $table_view]);
    }

    /**
     * @throws \Exception
     */
    public function lend(Request $request): JsonResponse
    {
        $input = $request::all();

        $this->service->lend($input);


        return $this->response($input);
    }

    public function return(Request $request, $id): JsonResponse
    {
        $input = $request::all();

        $this->service->return($input, $id);

        return $this->response();
    }

    public function details($id): JsonResponse
    {
        $include = [
            'details',
            'details.equipments'
        ];

        return $this->response($this->transform($this->service->details($include, $id),
            LendReturnEquipmentTransformer::class, $include));
    }

    public function approved($id)
    {
        $this->service->approved($id);

        return $this->response('',200);
    }


    public function edit(Request $request, $id)
    {
        $input = $request::all();

        $this->service->edit($id, $input);
    }

    public function delete($id)
    {
        $this->service->delete($id);
    }
}
