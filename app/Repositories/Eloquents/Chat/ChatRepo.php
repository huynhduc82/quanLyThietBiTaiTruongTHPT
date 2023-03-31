<?php

namespace App\Repositories\Eloquents\Chat;

use App\Models\Chat\ChatMessage;
use App\Repositories\BaseEloquentRepository;
use App\Repositories\Contracts\Equipment\IEquipmentRepo;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

class ChatRepo extends BaseEloquentRepository implements IEquipmentRepo
{
    public function model(): string
    {
        // TODO: Implement model() method.
        return ChatMessage::class;
    }

    public function index(array $include = [], $limit): Collection
    {
        $query = $this->model->newQuery();
        $count = $this->model->count();
        return $query->with($include)->skip($count-$limit)->take($limit)->orderBy('id')->get();
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

    public function searchByName($input = [], $include = []): LengthAwarePaginator
    {
        $query = $this->model->newQuery()->where('name', 'iLIKE', '%' . $input['key'] . '%');

        return $query->orderBy('id' ,'desc')->with($include)->paginate(10);
    }
}
