<?php

namespace App\Services\Maintenance;

use App\Helpers;
use App\Models\EquipmentReservations\EquipmentReservation;
use App\Models\Maintenance\Maintenance;
use App\Repositories\Contracts\Maintenance\IMaintenanceRepo;
use App\Services\Response\BaseService;
use App\Validators\Maintenance\MaintenanceValidators;
use Carbon\Carbon;
use Illuminate\Support\Arr;
use Exception;
use Illuminate\Support\Facades\DB;
use Prettus\Validator\Contracts\ValidatorInterface;

class MaintenanceServices extends BaseService
{
    public function repository(): string
    {
        // TODO: Implement repository() method.
        return IMaintenanceRepo::class;
    }

    public function filter($input = [], $include = [])
    {
        if(!empty($input['day_from']) && !empty($input['day_to'])) {
            $input['day_from'] = Carbon::createFromDate($input['day_from'])->toDateTimeString();
            $input['day_to'] = Carbon::createFromDate($input['day_to'])->endOfDay()->toDateTimeString();
        }

        return $this->repository->filter($input, $include);
    }

    public function index($include = [])
    {
        return $this->repository->index($include);
    }

    public function store($input = [])
    {
        $this->validatorCreateUpdate($input);
        try {
            DB::beginTransaction();
            $input['user_id'] = Helpers::getUserLoginId();
            $input['status'] = Maintenance::STATUS_NEW;
            $result = $this->repository->store(Arr::only($input, Maintenance::ATTRIBUTE));

            $input['maintenance_id'] = $result->id;
            app(MaintenanceDetailsServices::class)->store($input);
//
//            app(EquipmentService::class)->updateRentQuantity($input['equipment'], true);

            DB::commit();
            return 'OK';
        } catch (Exception $e)
        {
            DB::rollBack();
            throw new Exception($e);
        }
    }

    protected function validatorCreateUpdate(array $params = [], ?int $id = null): void
    {
        $validator = app(MaintenanceValidators::class);
        $validator->with($params);
        if ($id) {
            $validator->setId($id);
        }
        $validator->passesOrFail($id === null ? ValidatorInterface::RULE_CREATE : ValidatorInterface::RULE_UPDATE);
    }

    public function updateStatus($id, $status)
    {
        $this->repository->updateStatus($id, $status);
    }

    public function details($id = 0, $include = [])
    {
        return $this->repository->details($id, $include);
    }

    public function edit($input = [], $id = 0)
    {
        $this->validatorCreateUpdate($input);

        $result = $this->repository->edit(Arr::only($input, EquipmentReservation::ATTRIBUTE));

        if(!empty($input['equipment'])) {
            $model = EquipmentReservation::with('details')->find($id);
            app(EquipmentReservationDetailService::class)->edit($input, $id, $model);
        }

        return $result;
    }

    public function cancel($id = 0)
    {
        return $this->repository->updateStatus(Maintenance::STATUS_CANCEL, $id);
    }

    public function startMaintenance($id = 0)
    {
        return $this->repository->updateStatus(Maintenance::STATUS_MAINTAINING, $id);
    }

    public function endMaintenance($id = 0)
    {
        return $this->repository->updateStatus(Maintenance::STATUS_MAINTAINED, $id);
    }

    public function delete($id = 0)
    {
        return $this->repository->delete($id);
    }
}
