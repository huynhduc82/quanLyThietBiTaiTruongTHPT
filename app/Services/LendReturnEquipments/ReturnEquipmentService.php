<?php

namespace App\Services\LendReturnEquipments;

use App\Models\LendReturnEquipments\LendReturnEquipment;
use App\Repositories\Contracts\LendReturnEquipment\ILendReturnEquipmentRepo;
use App\Services\Equipment\EquipmentService;
use App\Services\Response\BaseService;
use App\Validators\LendReturnEquipments\ReturnEquipmentValidators;
use Exception;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\DB;
use Prettus\Validator\Contracts\ValidatorInterface;

class ReturnEquipmentService extends BaseService
{
    public function repository(): string
    {
        // TODO: Implement repository() method.
        return ILendReturnEquipmentRepo::class;
    }

    public function store($input, $id)
    {
        $this->validatorCreateUpdate($input);

        try {
            DB::beginTransaction();
            $this->repository->return(Arr::only($input, LendReturnEquipment::ATTRIBUTE_TO_RETURN), $id);

//            $input['lend_return_equipment_id'] = $result->id;
//            app(LendEquipmentDetailsService::class)->store($input);

            app(EquipmentService::class)->updateRentQuantity($input['equipment'], false);
            DB::commit();
        } catch (Exception $e)
        {
            DB::rollBack();
            throw new Exception($e);
        }
    }

    protected function validatorCreateUpdate(array $params = [], ?int $id = null): void
    {
        $validator = app(ReturnEquipmentValidators::class);
        $validator->with($params);
        if ($id) {
            $validator->setId($id);
        }
        $validator->passesOrFail($id === null ? ValidatorInterface::RULE_CREATE : ValidatorInterface::RULE_UPDATE);
    }
}
