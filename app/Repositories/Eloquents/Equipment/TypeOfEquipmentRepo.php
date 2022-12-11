<?php

namespace App\Repositories\Eloquents\Equipment;

use App\Models\Equipments\Equipment;
use App\Models\TypeOfEquipments\TypeOfEquipment;
use App\Repositories\BaseEloquentRepository;
use App\Repositories\Contracts\Equipment\ITypeOfEquipmentRepo;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

class TypeOfEquipmentRepo extends BaseEloquentRepository implements ITypeOfEquipmentRepo
{
    public function model()
    {
        // TODO: Implement model() method.
        return TypeOfEquipment::class;
    }

    public function index(array $withs = []): Collection
    {
        $query = $this->model->newQuery();

        return $query->with($withs)->orderBy('id')->get();
    }

    public function details($id = null, array $withs = []): Collection|array
    {
        $query = $this->model->newQuery();

        return $query->where('id', $id)->with($withs)->get();
    }

    public function store(array $input=[]): Model|Builder
    {
        $query = $this->model->newQuery();

        return $query->create($input);
    }

    public function updateQuantity($id)
    {
        $query = $this->model->newQuery()->where('id', $id);
        $equipmentQuery = Equipment::query();
        $quantity = $equipmentQuery->where('type_of_equipment_id' , '=' , $id)
            ->count();
        $quantityCanRent = $equipmentQuery->where('type_of_equipment_id' , '=' , $id)
            ->where('can_rent', '=', true)
            ->count();
        $query->update(['quantity' => $quantity, 'quantity_can_rent' => $quantityCanRent]);
    }

    public function edit($input, $id): int
    {
        $query = $this->model->newQuery();

        return $query->where('id', $id)->update($input);
    }

    public function delete($id)
    {
        $query = $this->model->newQuery();

        return $query->where('id', $id)->delete();
    }
}
