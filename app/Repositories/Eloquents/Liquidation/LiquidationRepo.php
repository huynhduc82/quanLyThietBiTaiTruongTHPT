<?php

namespace App\Repositories\Eloquents\Liquidation;

use App\Models\EquipmentLiquidations\EquipmentLiquidation;
use App\Repositories\BaseEloquentRepository;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

class LiquidationRepo extends BaseEloquentRepository
{
    public function model()
    {
        // TODO: Implement model() method.
        return EquipmentLiquidation::class;
    }

    public function index($include = []): Collection|array
    {
        $query = $this->model->newQuery();

        return $query->with($include)->orderBy('id', 'desc')->get();
    }

    public function filter($input = [], $include = []): LengthAwarePaginator
    {
        $query = $this->model->newQuery();
        if (!empty($input['day_from']) && !empty($input['day_to'])) {
            $query->where('created_at', '>=', $input['day_from'] )
                ->where('created_at', '<=', $input['day_to']);
        }
        $statusForFilter = [];
        if (!empty($input['new']) && $input['new']) {
            $statusForFilter[] = EquipmentLiquidation::STATUS_NEW;
        }
        if (!empty($input['cancel']) && $input['cancel']) {
            $statusForFilter[] = EquipmentLiquidation::STATUS_CANCEL;

        }
        if (!empty($input['approved']) && $input['approved']) {
            $statusForFilter[] = EquipmentLiquidation::STATUS_APPROVED;
        }
        if  (!empty($statusForFilter)){
            $query->whereIn('status', $statusForFilter);
        }

        return $query->orderBy('id')->with($include)->paginate(10);
    }

    public function store($input): Model
    {
        $query = $this->model->newQuery();

        return $query->create($input);
    }

    public function updateStatus($status, $id)
    {
        $query = $this->model->newQuery();

        return $query->where('id', $id)->update(['status' => $status]);
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

    public function changeStatus($status = null, $id = 0)
    {
        $query = $this->model->newQuery();

        return $query->where('id', $id)->update(['status', $status]);
    }

    public function delete($id)
    {
        $query = $this->model->newQuery();

        return $query->where('id', $id)->delete();
    }
}
