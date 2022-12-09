<?php

namespace App\Services\LendReturnEquipments;

use App\Helpers;
use App\Repositories\Contracts\LendReturnEquipment\ILendReturnEquipmentDetailsRepo;
use App\Services\Response\BaseService;
use phpDocumentor\Reflection\Types\Array_;

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
            if (!$item['equipment_details'] instanceof Array_)
            {
                $item['equipment_details'] = explode(Helpers::SEPARATOR, $item['equipment_details']);
            }
            $lendDetails = [];
            $lendDetails['lend_return_equipment_id'] = $input['lend_return_equipment_id'];
            $lendDetails['type_of_equipment_id'] =  $item['type_of_equipment_id'];

            $lendDetails['quantity'] = count($item['equipment_details']);
//            if(!empty($item['recoup_id'])) {
//                $lendDetails['recoup_id'] = implode(Helpers::SEPARATOR, $item['recoup_id']);
//            }
//            else {
//                $lendDetails['recoup_id'] = null;
//            }
            $lendDetails['equipment_id'] = implode(Helpers::SEPARATOR, $item['equipment_details']);
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
}
