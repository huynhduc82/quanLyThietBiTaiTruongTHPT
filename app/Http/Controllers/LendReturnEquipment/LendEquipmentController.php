<?php

namespace App\Http\Controllers\LendReturnEquipment;

use App\Http\Controllers\Controller;
use App\Services\LendReturnEquipments\LendEquipmentService;
use Illuminate\Support\Facades\Request;

class LendEquipmentController extends Controller
{
    public function __construct(
        protected LendEquipmentService $lendEquipmentService
    )
    {
    }

    public function index()
    {
        $include = [

        ];

        $this->lendEquipmentService->index($include);
    }

    public function store(Request $request)
    {
        $input = $request::all();

        $this->lendEquipmentService->store($input);


        return $this->response($input);
    }

    public function show($id)
    {
        $this->response('ok');
    }


    public function update()
    {

    }

    public function destroy($id)
    {

    }


}
