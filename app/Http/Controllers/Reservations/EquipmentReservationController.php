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

    public function store(Request $request)
    {
        $input = $request::all();

        $result = $this->equipmentReservationService->store($input);

        return $this->response($result);
    }

    public function show($id)
    {

    }


    public function update()
    {

    }

    public function destroy($id)
    {

    }
}
