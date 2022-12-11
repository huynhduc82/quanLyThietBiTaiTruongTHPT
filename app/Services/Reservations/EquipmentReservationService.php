<?php

namespace App\Services\Reservations;

use App\Models\EquipmentReservations\EquipmentReservation;
use App\Repositories\Contracts\Reservations\IEquipmentReservationRepo;
use App\Services\Equipment\EquipmentService;
use App\Services\Response\BaseService;
use App\Validators\Reservations\EquipmentReservationValidators;
use Illuminate\Support\Arr;
use Exception;
use Prettus\Validator\Contracts\ValidatorInterface;

class EquipmentReservationService extends BaseService
{
    public function repository(): string
    {
        // TODO: Implement repository() method.
        return IEquipmentReservationRepo::class;
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
            $input['status'] = EquipmentReservation::STATUS_NEW;
            $result = $this->repository->store(Arr::only($input, EquipmentReservation::ATTRIBUTE));

            $input['equipment_reservation_id'] = $result->id;
            app(EquipmentReservationDetailService::class)->store($input);

            app(EquipmentService::class)->updateRentQuantity($input, true);

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
            app(EquipmentReservationDetailService::class)->edit($input, $id);
        }

        return $result;
    }

    public function delete($id = 0)
    {
        app(EquipmentReservationDetailService::class)->delete($id);
        return $this->repository->delete($id);
    }
}
