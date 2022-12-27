<?php

namespace App\Repositories\Eloquents\Courses;

use App\Models\Courses\CoursesDetails;
use App\Repositories\BaseEloquentRepository;
use App\Repositories\Contracts\Equipment\IEquipmentRepo;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

class CourseDetailsRepo extends BaseEloquentRepository implements IEquipmentRepo
{
    public function model(): string
    {
        return CoursesDetails::class;
    }

    public function index(array $include = []): Collection
    {
        $query = $this->model->newQuery();

        return $query->with($include)->orderBy('id')->get();
    }

    public function getNeedEquipment(): Collection
    {
        $query = $this->model->newQuery();

        return $query->where('need_equipment', '=', 'true')->orderBy('id')->get();
    }

    public function details($id, array $include = []): Model|Builder|null
    {
        $query = $this->model->newQuery();

        return $query->where('id', $id)->with($include)->first();
    }

    public function store($input): Model|Builder
    {
        $query = $this->model->newQuery();

        return $query->create($input);
    }

    public function edit($input, $id): int
    {
        $query = $this->model->newQuery();

        return $query->where('id', $id)->update($input);
    }


    public function delete($id): int
    {
        return $this->model->newQuery()->where('id', $id)->delete();
    }
}
