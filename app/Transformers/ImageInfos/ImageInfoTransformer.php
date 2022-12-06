<?php

namespace App\Transformers\ImageInfos;

use App\Models\ImageInfos\ImageInfo;
use League\Fractal\TransformerAbstract;

class ImageInfoTransformer extends TransformerAbstract
{
    protected array $defaultIncludes = [

    ];

    protected array $availableIncludes = [

    ];

    public function transform(ImageInfo $model): array
    {
        return [
            'name' => $model->image_name,
            'references' => $model->image_references,
            'path' => $model->image_path,
            'disk' => $model->disk,
            'type' => $model->image_type,
            'size' => $model->image_size,
            'width' => $model->image_width,
            'height' => $model->image_height,
            'url' => $model->url,
        ];
    }
}
