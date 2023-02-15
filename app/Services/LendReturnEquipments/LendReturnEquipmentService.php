<?php

namespace App\Services\LendReturnEquipments;

use App\Helpers;
use App\Models\EquipmentReservations\EquipmentReservation;
use App\Models\Equipments\Equipment;
use App\Models\EquipmentStatus\EquipmentStatus;
use App\Models\LendReturnEquipments\LendReturnEquipment;
use App\Models\LendReturnEquipments\LendReturnEquipmentDetails;
use App\Models\Recoups\Recoup;
use App\Repositories\Contracts\LendReturnEquipment\ILendReturnEquipmentRepo;
use App\Services\Equipment\EquipmentService;
use App\Services\EquipmentStatus\EquipmentStatusServices;
use App\Services\Maintenance\MaintenanceServices;
use App\Services\Recoup\RecoupService;
use App\Services\Reservations\EquipmentReservationService;
use App\Services\Response\BaseService;
use App\Validators\LendReturnEquipments\LendEquipmentValidators;
use App\Validators\LendReturnEquipments\ReturnEquipmentValidators;
use Carbon\Carbon;
use Exception;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\DB;
use Prettus\Validator\Contracts\ValidatorInterface;
use function League\Uri\UriTemplate\toString;

class LendReturnEquipmentService extends BaseService
{
    public function repository(): string
    {
        // TODO: Implement repository() method.
        return ILendReturnEquipmentRepo::class;
    }

    public function index($include = [])
    {
        return $this->repository->index($include);
    }

    /**
     * @throws Exception
     */
    public function getLendReturnByDay($input = [], $include = [])
    {
        if(!empty($input['day_from']) && !empty($input['day_to'])) {
            $input['day_from'] = Carbon::createFromDate($input['day_from'])->toDateTimeString();
            $input['day_to'] = Carbon::createFromDate($input['day_to'])->endOfDay()->toDateTimeString();
        }

        return $this->repository->getLendReturnByDay($input, $include);
    }

    /**
     * @throws Exception
     */
    public function lend($input = [])
    {
        $this->validatorCreateUpdateLend($input);

        try {
            $input['lender_id'] = Helpers::getUserLoginId();
            $list = [];
            foreach ($input['equipment'] as $equip) {
                $ids = [];
                $temp = [];
                $query = Equipment::query()->where('type_of_equipment_id', $equip['type_of_equipment_id'])
                    ->where('can_rent', '=', true)->limit($equip['quantity'])->get();
                $temp["type_of_equipment_id"] = $equip['type_of_equipment_id'];
                foreach ($query as $equi) {
                    $ids[] = $equi->id;
                }
                $temp["equipment_details"] = $ids;
                $list[] = $temp;
            }
            $input['pick_up_time'] = Carbon::now();

            $input['equipment'] = $list;

            $input['status'] = LendReturnEquipment::STATUS_LENDING;

            $result = $this->repository->lend(Arr::only($input, LendReturnEquipment::ATTRIBUTE_TO_LEND));

            $input['lend_return_equipment_id'] = $result->id;

            app(LendEquipmentDetailsService::class)->store($input);

            app(EquipmentService::class)->updateRentQuantity($input['equipment'], true);
        } catch (Exception $e)
        {
            throw new Exception($e);
        }
    }

    protected function validatorCreateUpdateLend(array $params = [], ?int $id = null): void
    {
        $validator = app(LendEquipmentValidators::class);
        $validator->with($params);
        if ($id) {
            $validator->setId($id);
        }
        $validator->passesOrFail($id === null ? ValidatorInterface::RULE_CREATE : ValidatorInterface::RULE_UPDATE);
    }

    public function approved($id = 0)
    {
        $reservation = EquipmentReservation::with('details')->find($id)->toArray();
        if(!empty($reservation->detials->equipment_details))
        {
            return false;
        }

        $reservation['status'] = LendReturnEquipment::STATUS_LENDING;
        $reservation['lender_id'] = Helpers::getUserLoginId();
        $result = $this->repository->lend(Arr::only($reservation, LendReturnEquipment::ATTRIBUTE_TO_LEND));

        $input['lend_return_equipment_id'] = $result->id;
        $input['equipment'] = $reservation['details'];
        $input['course_details_id'] = $reservation['course_details_id'];
        app(LendEquipmentDetailsService::class)->store($input);

        app(EquipmentService::class)->updateRentQuantity($input['equipment'], true);

        app(EquipmentReservationService::class)->updateStatus($id, EquipmentReservation::STATUS_APPROVED);
        return true;
    }

    public function return($input, $id)
    {
        $this->validatorCreateUpdateReturn($input);

        $list = [];
        foreach ($input['equipment'] as $equip) {
            $ids = [];
            $temp = [];
            $query = Equipment::query()->where('type_of_equipment_id', $equip['type_of_equipment_id'])
                ->limit($equip['quantity'])->get();
            $temp["type_of_equipment_id"] = $equip['type_of_equipment_id'];
            foreach ($query as $equi) {
                $ids[] = $equi->id;
            }
            $temp["equipment_details"] = $ids;
            $list[] = $temp;
        }

        try {
            DB::beginTransaction();
            $input['returner_id'] = Helpers::getUserLoginId();
            $input['return_time'] = Carbon::now();
            $input['status'] = LendReturnEquipment::STATUS_RETURNED;
            $this->repository->return(Arr::only($input, LendReturnEquipment::ATTRIBUTE_TO_RETURN), $id);
            $input['equipment'] = $list;
            $model = LendReturnEquipment::query()->where('id', $id)->with('details')->first();
            app(LendEquipmentDetailsService::class)->edit($model, $input);

            app(EquipmentService::class)->updateRentQuantity($input['equipment'], false);
            DB::commit();
        } catch (Exception $e)
        {
            DB::rollBack();
            throw new Exception($e);
        }
    }

    protected function validatorCreateUpdateReturn(array $params = [], ?int $id = null): void
    {
        $validator = app(ReturnEquipmentValidators::class);
        $validator->with($params);
        if ($id) {
            $validator->setId($id);
        }
        $validator->passesOrFail($id === null ? ValidatorInterface::RULE_CREATE : ValidatorInterface::RULE_UPDATE);
    }

    public function details($include, $id)
    {
        return $this->repository->details($include, $id);
    }

    public function countLendReturn()
    {
        return $this->repository->countLendReturn();
    }

    public function static($start, $end, $type = 'day')
    {
        return $this->repository->static($start, $end, $type);
    }

    public function edit($id, $input)
    {
        $this->validatorCreateUpdateLend($input);
        $model = LendReturnEquipment::query()->where('id', $id)->with('details')->first();
        if (!empty($model->return_time)) {
            $this->validatorCreateUpdateReturn($input);
        }
        app(LendEquipmentDetailsService::class)->edit($model, $input);
        $this->repository->edit($id, Arr::only($input, Arr::flatten(LendReturnEquipment::ATTRIBUTE_TO_UPDATE)));
    }

    public function delete($id)
    {
        $model = LendReturnEquipment::query()->where('id', $id)->with('details')->first();
        app(LendEquipmentDetailsService::class)->delete($model);
        return $this->repository->delete($id);
    }

    public function brokenReport($input, $id)
    {
        $equipment = Equipment::find($input['equipment_id'])->first();

        DB::beginTransaction();
        app(EquipmentStatusServices::class)->updateStatusDetails($input['status'], $equipment->id, EquipmentStatus::STATUS_BROKEN);
        $param['equipment_id'] = $equipment->id;
        $param['reason'] = $input['reason'];
        $param['recoup_method'] = $input['method'];
        if ($input['method'] === Recoup::MONEY_METHOD)
        {
            $param['amount_of_money'] = $input['quantity'];
        } else {
            $param['quantity'] = $input['quantity'];
        }
        app(RecoupService::class)->store($param);

        $dataToMaintenance = [];
        $dataToMaintenance['equipment'] = [['id' => $equipment->id]];
        $dataToMaintenance['room_id'] = (string)$equipment->room->id ?? null;

        app(MaintenanceServices::class)->store($dataToMaintenance);

        app(EquipmentService::class)->updateEquipmentStatus([$equipment->id], false);

        DB::commit();
//        return $result;
    }
}
