<?php

namespace App\Transformers\Chat;

use App\Models\Chat\ChatMessage;
use App\Models\User;;

use App\Transformers\ImageInfos\ImageInfoTransformer;
use App\Transformers\User\UserProfileTransformer;
use League\Fractal\Resource\Item;
use League\Fractal\Resource\NullResource;
use League\Fractal\TransformerAbstract;

class ChatTransformer extends TransformerAbstract
{
    protected array $defaultIncludes = [

    ];

    protected array $availableIncludes = [
        'user',
    ];

    public function transform(ChatMessage $model): array
    {
        return [
            'message' => $model->message,
            'user_id' => $model->user_id,
        ];
    }

    public function includeUser(ChatMessage $model): Item|NullResource
    {
        $data = $model->relationLoaded('user') ? $model->user : null;

        return $data ? $this->item($data, new UserProfileTransformer()) : $this->null();
    }
}
