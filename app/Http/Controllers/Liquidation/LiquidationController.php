<?php

namespace App\Http\Controllers\Liquidation;

use App\Http\Controllers\Class\ClassController;
use App\Http\Controllers\Controller;
use App\Http\Controllers\Course\CourseController;
use App\Http\Controllers\Course\CourseDetailController;
use App\Http\Controllers\Grades\GradeController;
use App\Services\LendReturnEquipments\LendReturnEquipmentService;
use App\Services\Liquidation\LiquidationService;
use App\Services\Reservations\EquipmentReservationService;
use App\Services\Rooms\RoomServices;
use App\Transformers\Reservations\EquipmentReservationTransformer;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Support\Facades\Request;

class LiquidationController extends Controller
{
    public function __construct(
        protected LiquidationService $liquidationService
    )
    {
    }

    public function indexView()
    {
        $include = [
            'details',
            'details.equipments',
            'user',
            'approved',
            'details.room'
        ];

        $data = $this->liquidationService->index($include);
        return view('liquidation/index')->with(compact('data'));
    }

    public function storeView(): Factory|View|Application
    {
        $roomData = app(RoomServices::class)->index();

        return view('liquidation/store')->with(compact('roomData'));
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
        $lendReturn = $this->liquidationService->details($include, $id);

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

        $data = $this->liquidationService->filter($input, $include);

        return view('reservation/index', compact('data'));
    }

    public function index()
    {
        $include = [
            'details',
            'details.equipments',
            'details.equipments.status'
        ];

        return $this->response($this->transform($this->liquidationService->index($include),
            EquipmentReservationTransformer::class, $include));
    }

    public function details($id)
    {
        $include = [
            'details',
            'details.equipments'
        ];

        return $this->response($this->transform($this->liquidationService->details($id, $include),
            EquipmentReservationTransformer::class, $include));
    }

    public function store(Request $request)
    {
        $input = $request::all();

        $result = $this->liquidationService->store($input);

        return $this->response($result);
    }

    public function edit(Request $request, $id)
    {
        $input = $request::all();

        $result = $this->liquidationService->edit($input, $id);

        return $this->response($result);
    }

    public function delete($id)
    {
        $result = $this->liquidationService->delete($id);

        return $this->response($result);
    }

    public function cancel($id)
    {
        $result = $this->liquidationService->cancel($id);

        return $this->response($result);
    }

    public function approved($id)
    {
        $result = $this->liquidationService->approved($id);

        return $this->response($result);
    }

    public function success($id)
    {
        return $this->response($this->liquidationService->success($id));
    }
}
