<?php

namespace App\Repositories\Eloquents\Classes;

use App\Models\Class\Classes;
use App\Models\Class\ClassTimeRegulations;
use App\Repositories\BaseEloquentRepository;
use App\Repositories\Contracts\Equipment\IEquipmentRepo;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

class ClassTimeRegulationRepo extends BaseEloquentRepository implements IEquipmentRepo
{
    public function model(): string
    {
        // TODO: Implement model() method.
        return ClassTimeRegulations::class;
    }

    public function index(array $include = []): Collection
    {
        $query = $this->model->newQuery();

        return $query->with($include)->orderBy('id')->get();
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
