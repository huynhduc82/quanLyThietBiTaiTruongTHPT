<?php

namespace App\Http\Controllers\LendReturnEquipment;

use App\Http\Controllers\Controller;
use App\Services\LendReturnEquipments\LendEquipmentService;
use App\Transformers\LendReturnEquipment\LendReturnEquipmentTransformer;
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
            'details',
            'details.equipments'
        ];

        return $this->response($this->transform($this->lendEquipmentService->index($include),
            LendReturnEquipmentTransformer::class, $include));
    }

    public function store(Request $request)
    {
        $input = $request::all();

        $this->lendEquipmentService->store($input);


        return $this->response($input);
    }

    public function show()
    {
        $this->response('ok');
    }

    public function approved($id)
    {
        $this->lendEquipmentService->approved($id);

        return $this->response('',200);
    }


    public function update()
    {

    }

    public function destroy($id)
    {

    }


}
