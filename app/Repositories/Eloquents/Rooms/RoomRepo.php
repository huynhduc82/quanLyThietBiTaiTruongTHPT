<?php

namespace App\Repositories\Eloquents\Rooms;

use App\Models\Rooms\Room;
use App\Repositories\BaseEloquentRepository;

class RoomRepo extends BaseEloquentRepository
{
    public function model()
    {
        // TODO: Implement model() method.
        return Room::class;
    }

    public function index($with = [])
    {
        $query = $this->model->newQuery();

        return $query->with($with)->orderBy('id')->get();
    }

    public function store($input = [])
    {
        $query = $this->model->newQuery();

        return $query->create($input);
    }

    public function show($id)
    {

    }


//    public function update()
//    {
//
//    }

    public function destroy($id)
    {

    }
}
