<?php

namespace App\Services\User;

use App\Helpers;
use App\Repositories\Contracts\User\IUserProfileRepo;
use App\Services\Response\BaseService;
use App\Validators\User\UserProfileValidator;
use Prettus\Validator\Contracts\ValidatorInterface;

class UserProfileService extends BaseService
{
    public function repository(): string
    {
        return IUserProfileRepo::class;
    }

    public function addCourse($input = [])
    {
        $id = $input['user_id'];
        $param = ['course' =>implode(Helpers::SEPARATOR, $input['courses'])];

        $this->repository->edit($param,$id);
        $model = $this->repository->getModel()::find($id);
        $model->courses()->attach($input['courses']);
    }

    public function index(array $include = [])
    {
        return $this->repository->index($include);
    }

    public function details($id = 0, $include = [])
    {
        return $this->repository->details($id, $include);
    }

    public function edit($input, $id)
    {
        $this->validatorCreateUpdate($input, $id);

        $this->repository->getModel()::find($id)->courses()->sync(explode(',', $input['course']));

        return $this->repository->edit($input, $id);
    }

    protected function validatorCreateUpdate(array $params = [], ?int $id = null): void
    {
        $validator = app(UserProfileValidator::class);
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
