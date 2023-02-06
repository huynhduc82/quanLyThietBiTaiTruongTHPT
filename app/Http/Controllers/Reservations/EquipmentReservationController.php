<?php

namespace App\Http\Controllers\Reservations;

use App\Http\Controllers\Class\ClassController;
use App\Http\Controllers\Controller;
use App\Http\Controllers\Course\CourseController;
use App\Http\Controllers\Course\CourseDetailController;
use App\Http\Controllers\Grades\GradeController;
use App\Services\LendReturnEquipments\LendReturnEquipmentService;
use App\Services\Reservations\EquipmentReservationService;
use App\Services\Rooms\RoomServices;
use App\Transformers\Reservations\EquipmentReservationTransformer;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Support\Facades\Request;

class EquipmentReservationController extends Controller
{
    public function __construct(
        protected EquipmentReservationService $equipmentReservationService
    )
    {
    }

    public function indexView()
    {
        $include = [
            'details',
            'details.equipments',
            'user',
            'details.typeOfEquipment',
        ];

        $data = $this->equipmentReservationService->index($include);
        return view('reservation/index')->with(compact('data'));
    }

    public function storeView(): Factory|View|Application
    {
        $gradeData = app(GradeController::class)->index();
        $classData = app(ClassController::class)->index();
        $roomData = app(RoomServices::class)->index();
        $courseData = app(CourseController::class)->indexData();
        $courseDetailData = app(CourseDetailController::class)->getNeedEquipment();

        return view('reservation/store')->with(compact('roomData','gradeData', 'classData', 'courseData'
            , 'courseDetailData'));
    }

    public function returnView(int $id): Factory|View|Application
    {
        $include = [
            'details',
            'details.equipments',
            'details.typeOfEquipment',
            'user',
            'lender',
            'returner'
        ];
        $lendReturn = $this->equipmentReservationService->details($include, $id);

        return view('lendreturn/return')->with(compact('lendReturn'));
    }

    public function filter(Request $request): Factory|View|Application
    {
        $include = [
            'details',
            'details.equipments',
            'user',
            'details.typeOfEquipment',
        ];

        $input = $request::all();

        $data = $this->equipmentReservationService->filter($input, $include);

        return view('reservation/index', compact('data'));
    }

    public function index()
    {
        $include = [
            'details',
            'details.equipments'
        ];

        return $this->response($this->transform($this->equipmentReservationService->index($include),
            EquipmentReservationTransformer::class, $include));
    }

    public function details($id)
    {
        $include = [
            'details',
            'details.equipments'
        ];

        return $this->response($this->transform($this->equipmentReservationService->details($id, $include),
            EquipmentReservationTransformer::class, $include));
    }

    public function store(Request $request)
    {
        $input = $request::all();

        $result = $this->equipmentReservationService->store($input);

        return $this->response($result);
    }

    public function edit(Request $request, $id)
    {
        $input = $request::all();

        $result = $this->equipmentReservationService->edit($input, $id);

        return $this->response($result);
    }

    public function delete($id)
    {
        $result = $this->equipmentReservationService->delete($id);

        return $this->response($result);
    }

    public function cancel($id)
    {
        $result = $this->equipmentReservationService->cancel($id);

        return $this->response($result);
    }

    public function approved($id)
    {
        $result = $this->equipmentReservationService->approved($id);

        return $this->response($result);
    }

    public function lend($id)
    {
        $result = app(LendReturnEquipmentService::class)->approved($id);
        if($result == false)
        {
            return $this->response('Phiếu đặt trước này không có thiết bị','400');
        }
        $this->equipmentReservationService->lend($id);

        return $result;
    }
}
