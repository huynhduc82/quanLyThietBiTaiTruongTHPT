<?php

namespace App\Services\ImageInfos;

use App\Repositories\Contracts\ImageInfos\IImageInfoRepo;
use App\Services\Response\BaseService;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class ImageInfoService extends BaseService
{
    public function repository(): string
    {
        return IImageInfoRepo::class;
    }

    public function store(UploadedFile $images, $component): array
    {
        $param = [];
        $name = $images->getClientOriginalName();
        $path = Storage::putFileAs('public/images/'.$component,$images,$name);
        $url = asset(Storage::url($path));
        $data = getimagesize($images);
        $width = $data[0];
        $height = $data[1];

        $param['image_name'] = $name;
        $param['image_path'] = $path;
        $param['image_references'] = 'IMG' . Str::random(27);
        $param['disk'] = 'local';
        $param['image_type'] = $images->getClientMimeType();
        $param['image_size'] = $images->getSize();
        $param['image_width'] = $width;
        $param['image_height'] = $height;
        $param['url'] = $url;

        $model = $this->repository->store($param);

        $result['image_name'] = $model->image_name;
        $result['image_references'] = $model->image_references;

        return $result;
    }
}
