<?php

namespace App\Services\Equipment;

use App\Models\ImageInfos\ImageInfo;
use App\Repositories\Contracts\Equipment\ITypeOfEquipmentRepo;
use App\Services\ImageInfos\ImageInfoService;
use App\Services\Response\BaseService;
use App\Validators\Equipment\TypeOfEquipmentValidator;
use Prettus\Validator\Contracts\ValidatorInterface;

class TypeOfEquipmentService extends BaseService
{
    public function repository(): string
    {
        // TODO: Implement repository() method.
        return ITypeOfEquipmentRepo::class;
    }

    public function index(array $withs = [])
    {
        return $this->repository->index($withs);
    }

    public function details($id = null, array $withs = [])
    {
        return $this->repository->details($id, $withs);
    }

    public function store($input)
    {
        $this->validatorCreateUpdate($input);

        $images = $input['images'];

        $param = app(ImageInfoService::class)->uploadDrive($images, ImageInfo::COMPONENT_EQUIPMENT);

        $input['images'] = $param['image_name'];
        $input['image_references'] = $param['image_references'];

        return $this->repository->store($input);
    }

    protected function validatorCreateUpdate(array $params = [], ?int $id = null): void
    {
        $validator = app(TypeOfEquipmentValidator::class);
        $validator->with($params);
        if ($id) {
            $validator->setId($id);
        }
        $validator->passesOrFail($id === null ? ValidatorInterface::RULE_CREATE : ValidatorInterface::RULE_UPDATE);
    }

    public function updateQuantity($id)
    {
        return $this->repository->updateQuantity($id);
    }
}
