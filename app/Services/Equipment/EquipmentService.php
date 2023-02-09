<?php

namespace App\Services\Equipment;

use App\Helpers;
use App\Models\EquipmentStatus\EquipmentStatus;
use App\Models\TypeOfEquipments\TypeOfEquipment;
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

    public function index(array $include = [])
    {
        return $this->repository->index($include);
    }

    public function details($id = 0, $include = [])
    {
        return $this->repository->details($id, $include);
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

    public function edit($input, $id)
    {
        $this->validatorCreateUpdate($input, $id);

        return $this->repository->edit($input, $id);
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
        foreach ($input as $item)
        {
            if (!is_array($item['equipment_details']))
            {
                $item['equipment_details'] = explode(Helpers::SEPARATOR, $item['equipment_details']);
            }
            $param[] = $item['equipment_details'];
            $ids[] = $item['type_of_equipment_id'];
        }
        $this->repository->updateRentQuantity(Arr::flatten($param), $rent);
        foreach ($ids as $id)
        {
            app(TypeOfEquipmentService::class)->updateQuantity($id);
        }
    }

    public function updateEquipmentRentQuantity($input = [], $rent = true)
    {
        $param = [];
        $ids = [];
        foreach ($input as $item)
        {
            $ids[] = $item['id'];
        }
        $this->repository->updateRentQuantity(Arr::flatten($param), $rent);
        app(TypeOfEquipmentService::class)->updateAllQuantity();
    }

    public function updateEquipmentStatus($input = [], $rent = true)
    {
        foreach ($input as $item)
        {
            $equipment = $this->repository->updateRentStatus($item, $rent);
            app(TypeOfEquipmentService::class)->updateQuantity($equipment->type->id);
        }
    }

    public function delete($id): int
    {
        return $this->repository->delete($id);
    }

    public function updateRentQuantityOld($id, $ids, $rent)
    {
        $this->repository->updateRentQuantity($ids, $rent);

        app(TypeOfEquipmentService::class)->updateQuantity($id);
    }

    public function getByRoomId($id = 0, $include = [])
    {
        return $this->repository->getByRoomId($id, $include);
    }

    public function getById($id = 0, $include = [])
    {
        return $this->repository->details($id, $include);
    }

    public function getByName($name = 0, $id = 0, $include)
    {
        return $this->repository->getByName($name, $id, $include);
    }

    public function countEquipment()
    {
        return $this->repository->countEquipment();
    }

    public function static($start, $end, $type = 'day')
    {
        return $this->repository->static($start, $end, $type);
    }
}
