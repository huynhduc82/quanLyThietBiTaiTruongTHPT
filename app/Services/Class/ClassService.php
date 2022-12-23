<?php

namespace App\Services\Class;

use App\Repositories\Contracts\Classes\IClassRepo;
use App\Services\Response\BaseService;
use App\Validators\Classes\ClassValidator;
use Prettus\Validator\Contracts\ValidatorInterface;

class ClassService extends BaseService
{
    public function repository(): string
    {
        return IClassRepo::class;
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

        return $this->repository->store($input);
    }

    public function edit($input, $id)
    {
        $this->validatorCreateUpdate($input, $id);

        return $this->repository->edit($input, $id);
    }

    protected function validatorCreateUpdate(array $params = [], ?int $id = null): void
    {
        $validator = app(ClassValidator::class);
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
}
