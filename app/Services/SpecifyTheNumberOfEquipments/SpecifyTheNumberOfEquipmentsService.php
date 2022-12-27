<?php

namespace App\Services\SpecifyTheNumberOfEquipments;

use App\Repositories\Contracts\SpecifyTheNumberOfEquipments\ISpecifyTheNumberOfEquipmentsRepo;
use App\Services\Class\ClassService;
use App\Services\Response\BaseService;
use App\Validators\Equipment\EquipmentValidator;
use Illuminate\Support\Facades\DB;
use Prettus\Validator\Contracts\ValidatorInterface;

class SpecifyTheNumberOfEquipmentsService extends BaseService
{
    public function repository(): string
    {
        return ISpecifyTheNumberOfEquipmentsRepo::class;
    }

    public function index(array $include = [])
    {
        return $this->repository->index($include);
    }

    public function details($id = 0, $include = [])
    {
        return $this->repository->details($id, $include);
    }

    public function getByCourseDetailId($id = 0, $include = [])
    {
        return $this->repository->getByCourseDetailId($id, $include);
    }

    public function store($input)
    {
        $this->validatorCreateUpdate($input);

        $result = $this->repository->store($input);

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

    public function delete($id): int
    {
        return $this->repository->delete($id);
    }

    public function calEquipmentQuantity($input = [])
    {
        $numberOfPupils = app(ClassService::class)->details($input['class'])->number_of_pupils;

        $numberEquipment = $this->repository->details($input['equipment'])->quantity;

        return ceil($numberOfPupils/$numberEquipment);
    }
}
