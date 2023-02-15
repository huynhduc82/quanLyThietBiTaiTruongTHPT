<?php

namespace App\Repositories\Eloquents\Equipment;

use App\Models\Equipments\Equipment;
use App\Models\LendReturnEquipments\LendReturnEquipment;
use App\Repositories\BaseEloquentRepository;
use App\Repositories\Contracts\Equipment\IEquipmentRepo;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

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

    public function updateRentStatus($id, $rent)
    {
        $model = $this->model->newQuery()->where('id', '=', $id)->first();
        $model->can_rent = $rent;
        $model->save();
        return $model;
    }

    public function delete($id): int
    {
        $this->model->newQuery()->where('id', $id)->first()->status()->delete();
        return $this->model->newQuery()->where('id', $id)->delete();
    }

    public function getByRoomId($id, array $include = []): Collection|array
    {
        $query = $this->model->newQuery()
            ->where('room_id', '=', $id);

        return $query->with($include)->get();
    }

    public function getByName($name, $id, $include = []): Model
    {
        $query = $this->model->newQuery()
            ->where('name', 'like', '%' . $name . '%')
            ->where('room_id', '=', $id)
        ;

        return $query->with($include)->first();
    }

    public function countEquipment()
    {
        $query = $this->model->newQuery();

        return $query->count();
    }

    public function static($start, $end, $type = 'day')
    {
        $selectDate = '';
        $result = [];
        try {
            if ($type == "day") {
                $selectDate = "to_char(created_at, 'dd-mm-yyyy') AS date ";

            } else if ($type == "month") {
                $selectDate = "to_char(created_at, 'mm') AS date ";

            } else {
                $selectDate = "to_char(created_at, 'yyyy') AS date ";
            }
            $result = $this->model->newQuery()->whereBetween('created_at', array($start, $end))
                ->groupBy('date')
                ->orderBy('date')
                ->get(array(
                    DB::raw($selectDate),
                    DB::raw("COUNT(*) as result")
                ));
        } catch (\Exception $ex) {
            $result = [];
        }
        return $result;
    }
}
