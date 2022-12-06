<?php

namespace App\Services\Equipment;

use App\Models\EquipmentStatus\EquipmentStatus;
use App\Repositories\Contracts\Equipment\IEquipmentRepo;
use App\Services\EquipmentStatus\EquipmentStatusServices;
use App\Services\Response\BaseService;
use App\Validators\Equipment\EquipmentValidator;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\DB;
use Prettus\Validator\Contracts\ValidatorInterface;

class EquipmentService extends BaseService
{
    public function repository(): string
    {
        return IEquipmentRepo::class;
    }

    public function index(array $withs = [])
    {
        return $this->repository->index($withs);
    }

    public function store($input)
    {
        $this->validatorCreateUpdate($input);

        DB::beginTransaction();
        $param = ['condition_details' => EquipmentStatus::STATUS_ALL_GOOD,
            'can_continue_to_use' => EquipmentStatus::CAN_CONTINUE_USE];
        $input['equipment_status_id'] = app(EquipmentStatusServices::class)->store($param);
        $result = $this->repository->store($input);
        app(TypeOfEquipmentService::class)->updateQuantity($input['type_of_equipment_id']);
        DB::commit();

        return $result;
    }

    public function edit($input)
    {
        return $this->repository->edit($input);
    }

    protected function validatorCreateUpdate(array $params = [], ?int $id = null): void
    {
        $validator = app(EquipmentValidator::class);
        $validator->with($params);
        if ($id) {
            $validator->setId($id);
        }
        $validator->passesOrFail($id === null ? ValidatorInterface::RULE_CREATE : ValidatorInterface::RULE_UPDATE);
    }

    public function updateRentQuantity($input = [], $rent = true)
    {
        $param = [];
        $ids = [];
        foreach ($input['equipment'] as $item)
        {
            $param[] = $item['equipment_details'];
            $ids[] = $item['type_of_equipment_id'];
        }
        $this->repository->updateRentQuantity(Arr::flatten($param), $rent);
        foreach ($ids as $id)
        {
            app(TypeOfEquipmentService::class)->updateQuantity($id);
        }
    }
}
