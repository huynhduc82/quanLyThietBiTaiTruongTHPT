<?php

namespace App\Services\LendReturnEquipments;

use App\Helpers;
use App\Repositories\Contracts\LendReturnEquipment\ILendReturnEquipmentDetailsRepo;
use App\Services\Equipment\EquipmentService;
use App\Services\Response\BaseService;

class LendEquipmentDetailsService extends BaseService
{
    public function repository(): string
    {
        // TODO: Implement repository() method.
        return ILendReturnEquipmentDetailsRepo::class;
    }

    public function store($input)
    {
        foreach ($input['equipment'] as $item)
        {
            if (!is_array($item['equipment_details']))
            {
                $item['equipment_details'] = explode(Helpers::SEPARATOR, $item['equipment_details']);
            }
            $lendDetails = [];
            $lendDetails['lend_return_equipment_id'] = $input['lend_return_equipment_id'];
            $lendDetails['type_of_equipment_id'] =  $item['type_of_equipment_id'];
            $lendDetails['course_details_id'] =  $input['course_details_id'];

            $lendDetails['quantity'] = count($item['equipment_details']);
//            if(!empty($item['recoup_id'])) {
//                $lendDetails['recoup_id'] = implode(Helpers::SEPARATOR, $item['recoup_id']);
//            }
//            else {
//                $lendDetails['recoup_id'] = null;
//            }
            $lendDetails['equipment_details'] = implode(Helpers::SEPARATOR, $item['equipment_details']);
//            if(!empty($item['equipment_status_id'])) {
//                $lendDetails['equipment_status_id'] = implode(Helpers::SEPARATOR, $item['equipment_status_id']);
//            }
//            else {
//                $lendDetails['equipment_status_id'] = null;
//            }
            $result = $this->repository->store($lendDetails);
            $result->equipments()->attach(array_values($item['equipment_details']));
        }
    }

    public function edit($model = null, $input = [])
    {
        foreach ($input['equipment'] as $item)
        {
            $details = $model->details->where('type_of_equipment_id', $item['type_of_equipment_id'])->first();
            $diffOld = array_diff(explode(Helpers::SEPARATOR, $details->equipment_details), $item['equipment_details']);

            $lendDetails = [];
            $lendDetails['lend_return_equipment_id'] = $model->id;
            $lendDetails['type_of_equipment_id'] =  $item['type_of_equipment_id'];

            $lendDetails['quantity'] = count($item['equipment_details']);
//            if(!empty($item['recoup_id'])) {
//                $lendDetails['recoup_id'] = implode(Helpers::SEPARATOR, $item['recoup_id']);
//            }
//            else {
//                $lendDetails['recoup_id'] = null;
//            }
            $lendDetails['equipment_details'] = implode(Helpers::SEPARATOR, $item['equipment_details']);
//            if(!empty($item['equipment_status_id'])) {
//                $lendDetails['equipment_status_id'] = implode(Helpers::SEPARATOR, $item['equipment_status_id']);
//            }
//            else {
//                $lendDetails['equipment_status_id'] = null;
//            }
            $this->repository->edit($model->id, $lendDetails, $item['type_of_equipment_id']);
            $details->equipments()->sync(array_values($item['equipment_details']));

            if (!empty($diffOld)) {
                app(EquipmentService::class)->updateRentQuantityOld($item['type_of_equipment_id'], $diffOld,false);
            }
        }
        app(EquipmentService::class)->updateRentQuantity($input['equipment'], true);
    }

    public function approved($input)
    {
        foreach ($input['equipment'] as $item)
        {
            if (!is_array($item['equipment_details']))
            {
                $item['equipment_details'] = explode(Helpers::SEPARATOR, $item['equipment_details']);
            }
            $lendDetails = [];
            $lendDetails['lend_return_equipment_id'] = $input['lend_return_equipment_id'];
            $lendDetails['type_of_equipment_id'] =  $item['type_of_equipment_id'];
            $lendDetails['course_details_id'] =  $input['course_details_id'];

            $lendDetails['quantity'] = count($item['equipment_details']);
//            if(!empty($item['recoup_id'])) {
//                $lendDetails['recoup_id'] = implode(Helpers::SEPARATOR, $item['recoup_id']);
//            }
//            else {
//                $lendDetails['recoup_id'] = null;
//            }
            $lendDetails['equipment_details'] = implode(Helpers::SEPARATOR, $item['equipment_details']);
//            if(!empty($item['equipment_status_id'])) {
//                $lendDetails['equipment_status_id'] = implode(Helpers::SEPARATOR, $item['equipment_status_id']);
//            }
//            else {
//                $lendDetails['equipment_status_id'] = null;
//            }
            dd($item['equipment_details'],$lendDetails);
            $result = $this->repository->store($lendDetails);
            $result->equipments()->attach(array_values($item['equipment_details']));
        }
    }

    public function delete($model = null)
    {
        $details = $model->details;
        foreach ($details as $item)
        {
            $item->equipments()->detach();
            $this->repository->destroy($model->id, $item->type_of_equipment_id);
        }

        app(EquipmentService::class)->updateRentQuantity($details, false);
    }
}
