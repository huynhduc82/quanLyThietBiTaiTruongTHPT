<?php

namespace App\Http\Controllers\Reservations;

use App\Http\Controllers\Controller;
use App\Services\Reservations\EquipmentReservationService;
use App\Transformers\Reservations\EquipmentReservationTransformer;
use Illuminate\Support\Facades\Request;

class EquipmentReservationController extends Controller
{
    public function __construct(
        protected EquipmentReservationService $equipmentReservationService
    )
    {
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
}
