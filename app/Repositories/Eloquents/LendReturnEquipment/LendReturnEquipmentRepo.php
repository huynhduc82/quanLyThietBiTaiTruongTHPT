<?php

namespace App\Repositories\Eloquents\LendReturnEquipment;

use App\Models\LendReturnEquipments\LendReturnEquipment;
use App\Repositories\BaseEloquentRepository;
use App\Repositories\Contracts\LendReturnEquipment\ILendReturnEquipmentRepo;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class LendReturnEquipmentRepo extends BaseEloquentRepository implements ILendReturnEquipmentRepo
{
    public function model()
    {
        // TODO: Implement model() method.
        return LendReturnEquipment::class;
    }

    public function index($include = []): LengthAwarePaginator
    {
        $query = $this->model->newQuery();

        return $query->with($include)->orderBy('id','desc')->paginate(10);
    }

    public function getLendReturnByDay($input = [], $include = []): LengthAwarePaginator
    {
        $query = $this->model->newQuery();
        if (!empty($input['day_from']) && !empty($input['day_to'])) {
            $query->where('created_at', '>=', $input['day_from'] )
                ->where('created_at', '<=', $input['day_to']);
        }
        $statusForFilter = [];
        if (!empty($input['lending']) && $input['lending']) {
            $statusForFilter[] = LendReturnEquipment::STATUS_LENDING;
        }
        if (!empty($input['returned']) && $input['returned']) {
            $statusForFilter[] = LendReturnEquipment::STATUS_RETURNED;

        }
        if (!empty($input['out_of_date']) && $input['out_of_date']) {
            $statusForFilter[] = LendReturnEquipment::STATUS_OUT_OF_DATE;
        }
        if  (!empty($statusForFilter)){
            $query->whereIn('status', $statusForFilter);
        }
        if(!empty($input['key']))
        {
            $query->whereHas('details.typeOfEquipment', function (Builder $query) use ($input) {
                $query->where('name', 'iLIKE', '%' . $input['key'] . '%');
            });
        }

        return $query->orderBy('id' ,'desc')->with($include)->paginate(10);
    }

    public function lend($input = []): Model|Builder
    {
        $query = $this->model->newQuery();

        return $query->create($input);
    }

    public function return($input = [], $id = 0)
    {
        $query = $this->model->newQuery();

        $query->where('id', $id)->update($input);
    }

    public function details($include, $id)
    {
        $query = $this->model->newQuery();

        return $query->where('id', $id)->with($include)->first();
    }

    public function delete($id)
    {
        $query = $this->model->newQuery();

        return $query->where('id', $id)->delete();
    }

    public function edit($id, $input)
    {
        $query = $this->model->newQuery();

        return $query->where('id', $id)->update($input);
    }

    public function countLendReturn()
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
