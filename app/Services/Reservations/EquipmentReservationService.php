<?php

namespace App\Services\Reservations;

use App\Events\ReservationEvent;
use App\Helpers;
use App\Models\EquipmentReservations\EquipmentReservation;
use App\Models\Equipments\Equipment;
use App\Repositories\Contracts\Reservations\IEquipmentReservationRepo;
use App\Services\Equipment\EquipmentService;
use App\Services\Response\BaseService;
use App\Validators\Reservations\EquipmentReservationValidators;
use Carbon\Carbon;
use Illuminate\Support\Arr;
use Exception;
use Illuminate\Support\Facades\DB;
use Prettus\Validator\Contracts\ValidatorInterface;

class EquipmentReservationService extends BaseService
{
    public function repository(): string
    {
        // TODO: Implement repository() method.
        return IEquipmentReservationRepo::class;
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
//            DB::beginTransaction();
            $input['user_id'] = Helpers::getUserLoginId() ?? 14;
            $list = [];
            foreach ($input['equipment'] as $equip) {
                $ids = [];
                $temp = [];
                $query = Equipment::query()->where('type_of_equipment_id', $equip['type_of_equipment_id'])
                    ->where('can_rent', '=', true)->limit($equip['quantity'])->orderBy('id')->get();
                $temp["type_of_equipment_id"] = $equip['type_of_equipment_id'];
                foreach ($query as $equi) {
                    $ids[] = $equi->id;
                }
                $temp["equipment_details"] = $ids;
                $list[] = $temp;
            }
            $input['equipment'] = $list;
            $input['status'] = EquipmentReservation::STATUS_NEW;
            $result = $this->repository->store(Arr::only($input, EquipmentReservation::ATTRIBUTE));

            $input['equipment_reservation_id'] = $result->id;
            app(EquipmentReservationDetailService::class)->store($input);

            app(EquipmentService::class)->updateRentQuantity($input['equipment'], true);
            event(new ReservationEvent($result));

//            DB::commit();
            return 'OK';
        } catch (Exception $e)
        {
//            DB::rollBack();
            throw new Exception($e);
        }
    }

    protected function validatorCreateUpdate(array $params = [], ?int $id = null): void
    {
        $validator = app(EquipmentReservationValidators::class);
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
        return $this->repository->updateStatus(EquipmentReservation::STATUS_CANCEL, $id);
    }

    public function approved($id = 0)
    {
        return $this->repository->updateStatus(EquipmentReservation::STATUS_APPROVED, $id);
    }

    public function lend($id = 0)
    {
        return $this->repository->updateStatus(EquipmentReservation::STATUS_LEND, $id);
    }

    public function delete($id = 0)
    {
        $model = EquipmentReservation::with('details')->find($id);
        app(EquipmentReservationDetailService::class)->delete($model);
        return $this->repository->delete($id);
    }
}
