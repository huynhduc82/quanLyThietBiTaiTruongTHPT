<?php

namespace App\Services\EquipmentStatus;

use App\Models\EquipmentStatus\EquipmentStatus;
use App\Repositories\Contracts\EquipmentStatus\IEquipmentStatusRepo;
use App\Services\Equipment\EquipmentService;
use App\Services\Response\BaseService;
use App\Validators\EquipmentStatus\EquipmentStatusValidators;
use Prettus\Validator\Contracts\ValidatorInterface;

class EquipmentStatusServices extends BaseService
{
    public function repository(): string
    {
        // TODO: Implement repository() method.
        return IEquipmentStatusRepo::class;
    }

    public function store($input)
    {
        $this->validatorCreateUpdate($input);

        return $this->repository->store($input)->id;
    }

    protected function validatorCreateUpdate(array $params = [], ?int $id = null): void
    {
        $validator = app(EquipmentStatusValidators::class);
        $validator->with($params);
        if ($id) {
            $validator->setId($id);
        }
        $validator->passesOrFail($id === null ? ValidatorInterface::RULE_CREATE : ValidatorInterface::RULE_UPDATE);
    }

    public function updateStatusDetails($input, $id, $status)
    {
        return $this->repository->updateStatusDetails($input, $id, $status);
    }

    public function updateStatus($id, $status)
    {
        $this->repository->updateStatus($id, $status);

        if ($status != EquipmentStatus::STATUS_OK) {
            $isTrue = true;
        } else {
            $isTrue = false;
        }

        app(EquipmentService::class)->updateEquipmentStatus([$id], $isTrue);
    }
}
