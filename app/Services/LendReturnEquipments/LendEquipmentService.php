<?php

namespace App\Services\LendReturnEquipments;

use App\Models\LendReturnEquipments\LendReturnEquipment;
use App\Repositories\Contracts\LendReturnEquipment\ILendReturnEquipmentRepo;
use App\Services\Equipment\EquipmentService;
use App\Services\Response\BaseService;
use App\Validators\LendReturnEquipments\LendEquipmentValidators;
use Exception;
use Illuminate\Support\Arr;
use Prettus\Validator\Contracts\ValidatorInterface;

class LendEquipmentService extends BaseService
{
    public function repository(): string
    {
        // TODO: Implement repository() method.
        return ILendReturnEquipmentRepo::class;
    }

    public function index($include = [])
    {
        return $this->repository->index($include);
    }

    /**
     * @throws Exception
     */
    public function store($input = [])
    {
        $this->validatorCreateUpdate($input);

        try {
//            DB::beginTransaction();
            $result = $this->repository->store(Arr::only($input, LendReturnEquipment::ATTRIBUTE_TO_LEND));

            $input['lend_return_equipment_id'] = $result->id;
            app(LendEquipmentDetailsService::class)->store($input);

            app(EquipmentService::class)->updateRentQuantity($input, true);
//
//            DB::commit();
        } catch (Exception $e)
        {
//            DB::rollBack();
            throw new Exception($e);
        }
    }

    protected function validatorCreateUpdate(array $params = [], ?int $id = null): void
    {
        $validator = app(LendEquipmentValidators::class);
        $validator->with($params);
        if ($id) {
            $validator->setId($id);
        }
        $validator->passesOrFail($id === null ? ValidatorInterface::RULE_CREATE : ValidatorInterface::RULE_UPDATE);
    }
}
