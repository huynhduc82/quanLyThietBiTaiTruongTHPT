<?php

namespace App\Transformers\User;

use App\Models\User;
use App\Transformers\Course\CourseTransformer;
use App\Transformers\ImageInfos\ImageInfoTransformer;
use League\Fractal\Resource\Collection;
use League\Fractal\Resource\Item;
use League\Fractal\Resource\NullResource;
use League\Fractal\TransformerAbstract;

class UserProfileTransformer extends TransformerAbstract
{
    protected array $defaultIncludes = [

    ];

    protected array $availableIncludes = [
        'courses',
        'avatarInfo',
    ];

    public function transform(User $model): array
    {
        return [
            'id' => $model->id,
            'name' => $model->name,
            'phone_number' => $model->phone_number,
            'date_of_birth' => $model->date_of_birth,
            'identification' => $model->identification ?? null,
            'address' => $model->address ?? null,
            'email' => $model->email,
            'information' => $model->information ?? null,
            'avatar' => $model->avatar ?? null,
            'background' => $model->background ?? null,
            'facebook' => $model->facebook ?? null,
            'twitter' => $model->twitter ?? null,
            'instagram' => $model->instagram ?? null,
        ];
    }

    public function includeCourses(User $model) :  Collection|NullResource
    {
        $data = $model->relationLoaded('courses') ? $model->courses : null;

        return ($data && $data->isNotEmpty()) ? $this->collection($data, new CourseTransformer())
            : $this->null();
    }

    public function includeAvatarInfo(User $model): Item|NullResource
    {
        $data = $model->relationLoaded('avatarInfo') ? $model->avatarInfo : null;

        return $data ? $this->item($data, new ImageInfoTransformer()) : $this->null();
    }
}
