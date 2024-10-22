<?php

namespace App\Services\Rooms;

use App\Repositories\Contracts\Rooms\IRoomRepo;
use App\Services\Response\BaseService;
use App\Validators\Rooms\RoomValidator;
use Prettus\Validator\Contracts\ValidatorInterface;

class RoomServices extends BaseService
{
    public function repository(): string
    {
        // TODO: Implement repository() method.
        return IRoomRepo::class;
    }

    public function index($with = [])
    {
        return $this->repository->index($with);
    }

    public function store($input)
    {
        $this->validatorCreateUpdate($input);

        return $this->repository->store($input);
    }

    public function show($id)
    {

    }
    public function details($id, $include)
    {
        return $this->repository->details($id, $include);
    }


    public function edit($input, $id)
    {
        $this->validatorCreateUpdate($input, $id);

        return $this->repository->edit($input, $id);
    }

    public function delete($id)
    {
        return $this->repository->delete($id);
    }

    protected function validatorCreateUpdate(array $params = [], ?int $id = null): void
    {
        $validator = app(RoomValidator::class);
        $validator->with($params);
        if ($id) {
            $validator->setId($id);
        }
        $validator->passesOrFail($id === null ? ValidatorInterface::RULE_CREATE : ValidatorInterface::RULE_UPDATE);
    }

    public function searchByName($input = [], $include = [])
    {
        return $this->repository->searchByName($input, $include);
    }
}
