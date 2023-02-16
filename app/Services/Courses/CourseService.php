<?php

namespace App\Services\Courses;

use App\Models\EquipmentStatus\EquipmentStatus;
use App\Repositories\Contracts\Courses\ICourseRepo;
use App\Services\EquipmentStatus\EquipmentStatusServices;
use App\Services\Response\BaseService;
use App\Validators\Course\CourseValidator;
use App\Validators\Equipment\EquipmentValidator;
use Illuminate\Support\Facades\DB;
use Prettus\Validator\Contracts\ValidatorInterface;

class CourseService extends BaseService
{
    public function repository(): string
    {
        return ICourseRepo::class;
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
        $validator = app(CourseValidator::class);
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

    public function searchByName($input = [], $include = [])
    {
        return $this->repository->searchByName($input, $include);
    }
}
