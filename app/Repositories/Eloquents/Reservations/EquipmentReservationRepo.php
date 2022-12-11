<?php

namespace App\Repositories\Eloquents\Reservations;

use App\Models\EquipmentReservations\EquipmentReservation;
use App\Repositories\BaseEloquentRepository;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

class EquipmentReservationRepo extends BaseEloquentRepository
{
    public function model()
    {
        // TODO: Implement model() method.
        return EquipmentReservation::class;
    }

    public function index($include = []): Collection|array
    {
        $query = $this->model->newQuery();

        return $query->with($include)->get();
    }

    public function store($input): Model
    {
        $query = $this->model->newQuery();

        return $query->create($input);
    }

    public function updateStatus($id, $status)
    {
        $query = $this->model->newQuery();

        $query->where('id', $id)->update(['status' => $status]);
    }

    public function details($id = 0, $include = [])
    {
        $query = $this->model->newQuery();

        return $query->where('id', $id)->with($include)->get();
    }

    public function edit($input = [], $id = 0)
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
