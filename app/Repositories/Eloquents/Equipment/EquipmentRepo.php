<?php

namespace App\Repositories\Eloquents\Equipment;

use App\Models\Equipments\Equipment;
use App\Repositories\BaseEloquentRepository;
use App\Repositories\Contracts\Equipment\IEquipmentRepo;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

class EquipmentRepo extends BaseEloquentRepository implements IEquipmentRepo
{
    public function model(): string
    {
        // TODO: Implement model() method.
        return Equipment::class;
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


    public function updateRentQuantity($input = [], $rent = true)
    {
        $query = $this->model->newQuery();
        foreach ($input as $key => $item)
        {
            if (is_string($item)) {
                unset($input[$key]);
            }
        }
        if (!empty($input) && !is_string($input)) {
            $query->whereIn('id', $input);
        }

        $query->update(['can_rent' => !$rent]);
    }

    public function delete($id): int
    {
        $this->model->newQuery()->where('id', $id)->first()->status()->delete();
        return $this->model->newQuery()->where('id', $id)->delete();
    }
}
