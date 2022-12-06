<?php

namespace App\Repositories\Eloquents\Equipment;

use App\Models\Equipments\Equipment;
use App\Repositories\BaseEloquentRepository;
use App\Repositories\Contracts\Equipment\IEquipmentRepo;
use Illuminate\Database\Eloquent\Collection;

class EquipmentRepo extends BaseEloquentRepository implements IEquipmentRepo
{
    public function model()
    {
        // TODO: Implement model() method.
        return Equipment::class;
    }

    public function index(array $with=[]): Collection
    {
        $query = $this->model->newQuery();

        return $query->with($with)->orderBy('id')->get();
    }

    public function store($input)
    {
        $query = $this->model->newQuery();

        $model = $query->create($input);

        return $model;
    }

    public function edit($input)
    {
        return $this->model->newQuery()->with(['equipments', 'equipments.status'])->get();
    }


    public function updateRentQuantity($input = [], $rent = true)
    {
        $query = $this->model->newQuery();

        $query->whereIn('id', $input);

        $query->update(['can_rent' => !$rent]);
    }
}
