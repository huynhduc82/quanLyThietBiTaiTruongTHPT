<?php

namespace App\Models\ImageInfos;

use App\Models\BaseModel;
use Illuminate\Database\Eloquent\SoftDeletes;

class ImageInfo extends BaseModel
{
    const IMAGE_MIMES = [
            'svg',
            'png',
            'jpg',
            'jpeg',
            'gif',
        ];
    const IMAGE_MAX_SIZE = 5120;
    const COMPONENT_EQUIPMENT = 'equipment';
    const COMPONENT_AVATAR = 'avatar';

    use SoftDeletes;

    protected $table = 'image_info';

    protected $fillable = [
        'image_name',
        'image_references',
        'image_path',
        'disk',
        'image_type',
        'image_size',
        'image_width',
        'image_height',
        'url'
    ];
}
