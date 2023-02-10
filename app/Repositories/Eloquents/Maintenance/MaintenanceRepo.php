<?php

namespace App\Repositories\Eloquents\Maintenance;

use App\Models\EquipmentReservations\EquipmentReservation;
use App\Models\Equipments\Equipment;
use App\Models\Maintenance\Maintenance;
use App\Repositories\BaseEloquentRepository;
use App\Services\Equipment\EquipmentService;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class MaintenanceRepo extends BaseEloquentRepository
{
    public function model()
    {
        // TODO: Implement model() method.
        return Maintenance::class;
    }

    public function index($include = []): Collection|array
    {
        $query = $this->model->newQuery();

        return $query->with($include)->orderBy('id')->get();
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
            $statusForFilter[] = EquipmentReservation::STATUS_NEW;
        }
        if (!empty($input['cancel']) && $input['cancel']) {
            $statusForFilter[] = EquipmentReservation::STATUS_CANCEL;

        }
        if (!empty($input['approved']) && $input['approved']) {
            $statusForFilter[] = EquipmentReservation::STATUS_APPROVED;
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

    public function updateEquipment($id)
    {
        $model = $this->model->newQuery()->where('id', $id)->with('details')->first();
        foreach ($model->details as $detail)
        {
            app(EquipmentService::class)->updateEquipmentStatus([$detail->equipment_id], true);
        }

    }

    public function countMaintenance()
    {
        $query = $this->model->newQuery();

        return $query->count();
    }
}
