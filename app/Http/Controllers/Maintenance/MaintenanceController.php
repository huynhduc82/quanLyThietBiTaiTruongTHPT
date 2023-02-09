<?php

namespace App\Http\Controllers\Maintenance;

use App\Http\Controllers\Class\ClassController;
use App\Http\Controllers\Controller;
use App\Http\Controllers\Course\CourseController;
use App\Http\Controllers\Course\CourseDetailController;
use App\Http\Controllers\Grades\GradeController;
use App\Services\LendReturnEquipments\LendReturnEquipmentService;
use App\Services\Maintenance\MaintenanceServices;
use App\Services\Rooms\RoomServices;
use App\Transformers\Reservations\EquipmentReservationTransformer;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Support\Facades\Request;

class MaintenanceController extends Controller
{
    public function __construct(
        protected MaintenanceServices $maintenanceServices
    )
    {
    }

    public function indexView()
    {
        $include = [
            'details',
            'details.equipments',
            'details.equipments.room',
            'user',
            'maintenancer',
        ];

        $data = $this->maintenanceServices->index($include);

        return view('maintenance/index')->with(compact('data'));
    }

    public function storeView(): Factory|View|Application
    {
        $gradeData = app(GradeController::class)->index();
        $classData = app(ClassController::class)->index();
        $roomData = app(RoomServices::class)->index();
        $courseData = app(CourseController::class)->indexData();
        $courseDetailData = app(CourseDetailController::class)->getNeedEquipment();

        return view('maintenance/store')->with(compact('roomData','gradeData', 'classData', 'courseData'
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
        $lendReturn = $this->maintenanceServices->details($include, $id);

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

        $data = $this->maintenanceServices->filter($input, $include);

        return view('reservation/index', compact('data'));
    }

    public function index()
    {
        $include = [
            'details',
            'details.equipments'
        ];

        return $this->response($this->transform($this->maintenanceServices->index($include),
            EquipmentReservationTransformer::class, $include));
    }

    public function details($id)
    {
        $include = [
            'details',
            'details.equipments'
        ];

        return $this->response($this->transform($this->maintenanceServices->details($id, $include),
            EquipmentReservationTransformer::class, $include));
    }

    public function store(Request $request)
    {
        $input = $request::all();

        $result = $this->maintenanceServices->store($input);

        return $this->response($result);
    }

    public function edit(Request $request, $id)
    {
        $input = $request::all();

        $result = $this->maintenanceServices->edit($input, $id);

        return $this->response($result);
    }

    public function delete($id)
    {
        $result = $this->maintenanceServices->delete($id);

        return $this->response($result);
    }

    public function cancel($id)
    {
        $result = $this->maintenanceServices->cancel($id);

        return $this->response($result);
    }

    public function startMaintenance($id)
    {
        $result = $this->maintenanceServices->startMaintenance($id);

        return $this->response($result);
    }

    public function endMaintenance($id)
    {
        $result = $this->maintenanceServices->endMaintenance($id);

        return $this->response($result);
    }
}
