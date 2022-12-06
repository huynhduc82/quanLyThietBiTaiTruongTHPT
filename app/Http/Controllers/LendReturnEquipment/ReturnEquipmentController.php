<?php

namespace App\Http\Controllers\LendReturnEquipment;

use App\Http\Controllers\Controller;
use App\Services\LendReturnEquipments\ReturnEquipmentService;
use Illuminate\Support\Facades\Request;

class ReturnEquipmentController extends Controller
{
    public function __construct(
        protected ReturnEquipmentService $returnEquipmentService
    )
    {
    }

    public function index()
    {
        $include = [

        ];

        $this->returnEquipmentService->index($include);
    }

    public function store(Request $request, $id)
    {
        $input = $request::all();

        $this->returnEquipmentService->store($input, $id);

        return $this->response();
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
