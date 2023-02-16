<?php

namespace App\Repositories\Eloquents\SpecifyTheNumberOfEquipments;

use App\Models\SpecifyTheNumberOfEquipments\SpecifyTheNumberOfEquipment;
use App\Repositories\BaseEloquentRepository;
use App\Repositories\Contracts\Equipment\IEquipmentRepo;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

class SpecifyTheNumberOfEquipmentsRepo extends BaseEloquentRepository implements IEquipmentRepo
{
    public function model(): string
    {
        // TODO: Implement model() method.
        return SpecifyTheNumberOfEquipment::class;
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

    public function getByCourseDetailId($id, array $include = []): Collection|array
    {
        $query = $this->model->newQuery();

        return $query->where('course_details_id', $id)->with($include)->get();
    }

    public function getByName($name, array $include = []): Builder|Model
    {
        $query = $this->model->newQuery();

        return $query->whereHas('equipment', function ($query) use ($name){
            return $query->where('name', '=', $name);
        })->with($include)->first();
    }

    public function getByCourseId($id, array $include = []): Collection|array
    {
        $query = $this->model->newQuery()
            ->whereHas('courseDetails.course', function ($query) use ($id){
                return $query->where('id', '=', $id);
            });

        return $query->with($include)->get();
    }

    public function detailsWithEquipment($equipmentId, $courseDetailId): Model|Builder|null
    {
        $query = $this->model->newQuery();

        return $query->where('equipment_id', $equipmentId)->where('course_details_id', $courseDetailId)->first();
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
        $query = $this->model->newQuery()->whereHas('equipment', function ($query) use ($input){
            return $query->where('name', 'iLIKE', '%' . $input['key'] . '%');
        })->with($include);

        return $query->orderBy('id' ,'desc')->with($include)->paginate(10);
    }
}
