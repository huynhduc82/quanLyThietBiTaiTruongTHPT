<?php

namespace App\Services\Recoup;

use App\Repositories\Contracts\Grades\IGradeRepo;
use App\Repositories\Contracts\Recoup\IRecoupRepo;
use App\Services\Response\BaseService;
use App\Validators\Grades\GradeValidators;
use Prettus\Validator\Contracts\ValidatorInterface;

class RecoupService extends BaseService
{
    public function repository(): string
    {
        return IRecoupRepo::class;
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
//        $this->validatorCreateUpdate($input);

        $result = $this->repository->store($input);

        return $result;
    }

    public function edit($input, $id)
    {
        $this->validatorCreateUpdate($input, $id);

        return $this->repository->edit($input, $id);
    }

//    protected function validatorCreateUpdate(array $params = [], ?int $id = null): void
//    {
//        $validator = app(GradeValidators::class);
//        $validator->with($params);
//        if ($id) {
//            $validator->setId($id);
//        }
//        $validator->passesOrFail($id === null ? ValidatorInterface::RULE_CREATE : ValidatorInterface::RULE_UPDATE);
//    }

    public function delete($id): int
    {
        return $this->repository->delete($id);
    }

    public function searchByName($input = [], $include = [])
    {
        return $this->repository->searchByName($input, $include);
    }

}
