<?php

namespace App\Services\Liquidation;

use App\Helpers;
use App\Models\EquipmentLiquidations\EquipmentLiquidation;
use App\Models\EquipmentReservations\EquipmentReservation;
use App\Models\Equipments\Equipment;
use App\Models\Maintenance\Maintenance;
use App\Repositories\Contracts\Liquidation\ILiquidationRepo;
use App\Repositories\Contracts\Maintenance\IMaintenanceRepo;
use App\Services\Equipment\EquipmentService;
use App\Services\Equipment\TypeOfEquipmentService;
use App\Services\Response\BaseService;
use App\Validators\Liquidation\LiquidationValidator;
use App\Validators\Maintenance\MaintenanceValidators;
use Carbon\Carbon;
use Illuminate\Support\Arr;
use Exception;
use Illuminate\Support\Facades\DB;
use Prettus\Validator\Contracts\ValidatorInterface;

class LiquidationService extends BaseService
{
    public function repository(): string
    {
        // TODO: Implement repository() method.
        return ILiquidationRepo::class;
    }

    public function filter($input = [], $include = [])
    {
        if(!empty($input['day_from']) && !empty($input['day_to'])) {
            $input['day_from'] = Carbon::createFromDate($input['day_from'])->toDateTimeString();
            $input['day_to'] = Carbon::createFromDate($input['day_to'])->endOfDay()->toDateTimeString();
        }

        return $this->repository->filter($input, $include);
    }

    public function static($start, $end, $type = 'day')
    {
        return $this->repository->static($start, $end, $type);
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
            $input['status'] = EquipmentLiquidation::STATUS_NEW;
            $result = $this->repository->store(Arr::only($input, EquipmentLiquidation::ATTRIBUTE));

            $input['liquidation_id'] = $result->id;
            app(LiquidationDetailsService::class)->store($input);

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
        $validator = app(LiquidationValidator::class);
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
            $model = EquipmentLiquidation::with('details')->find($id);
            app(LiquidationDetailsService::class)->edit($input, $id, $model);
        }

        return $result;
    }

    public function cancel($id = 0)
    {
        return $this->repository->updateStatus(Maintenance::STATUS_CANCEL, $id);
    }

    public function approved($id = 0)
    {
        $input = [];
        $input['approved_by'] = Helpers::getUserLoginId() ?? null;
        $input['approved_time'] = Carbon::now()->toDateTimeString();
        $this->repository->edit($input, $id);
        return $this->repository->updateStatus(EquipmentLiquidation::STATUS_APPROVED, $id);
    }

    public function success($id = 0)
    {
        DB::beginTransaction();
        $result = $this->repository->updateStatus(EquipmentLiquidation::STATUS_SUCCESS, $id);

        if($result) {
            $model = $this->repository->newQuery()->with(['details'])->where('id', '=', $id)->first();
            foreach ($model->details as $item)
            {
                app(EquipmentService::class)->delete($item->equipment_id);
            }
        }
        app(TypeOfEquipmentService::class)->updateAllQuantity();
        DB::commit();

        return $result;
    }

    public function delete($id = 0)
    {
        return $this->repository->delete($id);
    }

    public function countLiquidation()
    {
        return $this->repository->countLiquidation();
    }
}
