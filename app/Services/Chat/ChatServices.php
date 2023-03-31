<?php

namespace App\Services\Chat;

use App\Helpers;
use App\Repositories\Contracts\Chat\IChatRepo;
use App\Services\Response\BaseService;
use App\Validators\Chat\ChatValidator;
use Prettus\Validator\Contracts\ValidatorInterface;

class ChatServices extends BaseService
{
    public function repository(): string
    {
        return IChatRepo::class;
    }

    public function index(array $include, $limit)
    {
        return $this->repository->index($include, $limit);
    }

    public function details($id = 0, $include = [])
    {
        return $this->repository->details($id, $include);
    }

    public function store($input)
    {
        $this->validatorCreateUpdate($input);
        $input['user_id'] = Helpers::getUserLoginId();

        return $this->repository->store($input);
    }

    public function edit($input, $id)
    {
        $this->validatorCreateUpdate($input, $id);

        return $this->repository->edit($input, $id);
    }

    protected function validatorCreateUpdate(array $params = [], ?int $id = null): void
    {
        $validator = app(ChatValidator::class);
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
