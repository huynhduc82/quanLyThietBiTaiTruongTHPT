<?php

namespace App\Repositories\Eloquents\ImageInfos;

use App\Models\ImageInfos\ImageInfo;
use App\Repositories\BaseEloquentRepository;
use Illuminate\Database\Eloquent\Model;

class ImageInfoRepo extends BaseEloquentRepository
{
    public function model()
    {
        // TODO: Implement model() method.
        return ImageInfo::class;
    }

    public function store($param = []): Model
    {
        $query = $this->model->newQuery();

        return $query->create($param);
    }

    public function delete($path = null)
    {
        $query = $this->model->newQuery();

        return $query->where('image_path', $path)->delete();
    }
}
