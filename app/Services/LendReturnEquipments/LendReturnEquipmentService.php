<?php

namespace App\Services\LendReturnEquipments;

use App\Models\EquipmentReservations\EquipmentReservation;
use App\Models\LendReturnEquipments\LendReturnEquipment;
use App\Repositories\Contracts\LendReturnEquipment\ILendReturnEquipmentRepo;
use App\Services\Equipment\EquipmentService;
use App\Services\Reservations\EquipmentReservationService;
use App\Services\Response\BaseService;
use App\Validators\LendReturnEquipments\LendEquipmentValidators;
use App\Validators\LendReturnEquipments\ReturnEquipmentValidators;
use Exception;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\DB;
use Prettus\Validator\Contracts\ValidatorInterface;

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
    public function lend($input = [])
    {
        $this->validatorCreateUpdateLend($input);

        try {
//            DB::beginTransaction();
            $result = $this->repository->lend(Arr::only($input, LendReturnEquipment::ATTRIBUTE_TO_LEND));

            $input['lend_return_equipment_id'] = $result->id;
            app(LendEquipmentDetailsService::class)->store($input);

            app(EquipmentService::class)->updateRentQuantity($input['equipment'], true);
//
//            DB::commit();
        } catch (Exception $e)
        {
//            DB::rollBack();
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

        $result = $this->repository->store(Arr::only($reservation, LendReturnEquipment::ATTRIBUTE_TO_LEND));

        $input['lend_return_equipment_id'] = $result->id;
        $input['equipment'] = $reservation['details'];

        app(LendEquipmentDetailsService::class)->store($input);

        app(EquipmentService::class)->updateRentQuantity($input['equipment'], true);

        app(EquipmentReservationService::class)->updateStatus($id, EquipmentReservation::STATUS_APPROVED);
    }

    public function return($input, $id)
    {
        $this->validatorCreateUpdateReturn($input);

        try {
            DB::beginTransaction();
            $this->repository->return(Arr::only($input, LendReturnEquipment::ATTRIBUTE_TO_RETURN), $id);

//            $input['lend_return_equipment_id'] = $result->id;
//            app(LendEquipmentDetailsService::class)->store($input);

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
}
