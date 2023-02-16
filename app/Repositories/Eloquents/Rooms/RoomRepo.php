<?php

namespace App\Repositories\Eloquents\Rooms;

use App\Models\Rooms\Room;
use App\Repositories\BaseEloquentRepository;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;

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
    public function details($id, $include)
    {
        $query = $this->model->newQuery();

        return $query->where('id', '=', $id)->with($include)->orderBy('id')->first();
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

    public function searchByName($input = [], $include = []): LengthAwarePaginator
    {
        $query = $this->model->newQuery()->where('name', 'iLIKE', '%' . $input['key'] . '%');

        return $query->orderBy('id' ,'desc')->with($include)->paginate(10);
    }
}
