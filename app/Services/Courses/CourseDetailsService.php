<?php

namespace App\Services\Courses;

use App\Repositories\Contracts\Courses\ICourseDetailRepo;
use App\Services\Response\BaseService;
use App\Validators\Course\CourseDetailValidator;
use Prettus\Validator\Contracts\ValidatorInterface;

class CourseDetailsService extends BaseService
{
    public function repository(): string
    {
        return ICourseDetailRepo::class;
    }

    public function index(array $include = [])
    {
        return $this->repository->index($include);
    }

    public function getNeedEquipment()
    {
        return $this->repository->getNeedEquipment();
    }

    public function details($id = 0, $include = [])
    {
        return $this->repository->details($id, $include);
    }

    public function store($input)
    {
        $this->validatorCreateUpdate($input);

        $result = $this->repository->store($input);

        return $result;
    }

    public function edit($input, $id)
    {
        $this->validatorCreateUpdate($input, $id);

        return $this->repository->edit($input, $id);
    }

    protected function validatorCreateUpdate(array $params = [], ?int $id = null): void
    {
        $validator = app(CourseDetailValidator::class);
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

    public function getByName($name = 0, $id = 0, $include)
    {
        return $this->repository->getByName($name, $id, $include);
    }

}
