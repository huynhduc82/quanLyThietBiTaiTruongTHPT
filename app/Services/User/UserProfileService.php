<?php

namespace App\Services\User;

use App\Helpers;
use App\Models\ImageInfos\ImageInfo;
use App\Models\TypeOfEquipments\TypeOfEquipment;
use App\Models\User;
use App\Repositories\Contracts\User\IUserProfileRepo;
use App\Services\ImageInfos\ImageInfoService;
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

        if (!empty($input['avatar'])) {
            $model = User::query()->where('id', $id)->with('avatarInfo')->first();
            if($model->avatarInfo)
            {
                app(ImageInfoService::class)->deleteUnusedImage($model->avatarInfo->image_path);
            }
            $images = $input['avatar'];

            $param = app(ImageInfoService::class)->uploadDrive($images, ImageInfo::COMPONENT_EQUIPMENT);

            $input['avatar'] = $param['image_references'];
        }
        if (!empty($input['background'])) {
            $model = User::query()->where('id', $id)->with('backgroundInfo')->first();
            if($model->backgroundInfo) {
                app(ImageInfoService::class)->deleteUnusedImage($model->backgroundInfo->image_path);
            }
            $images = $input['background'];

            $param = app(ImageInfoService::class)->uploadDrive($images, ImageInfo::COMPONENT_EQUIPMENT);

            $input['background'] = $param['image_references'];
        }


        if (!empty($input['course'])) {
            $this->repository->getModel()::find($id)->courses()->sync(explode(',', $input['course']));
        }
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
