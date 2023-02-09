<?php

namespace App\Services\Dashboard;

use App\Models\EquipmentStatus\EquipmentStatus;
use App\Models\TypeOfEquipments\TypeOfEquipment;
use App\Repositories\Contracts\Courses\ICourseRepo;
use App\Repositories\Contracts\Equipment\ITypeOfEquipmentRepo;
use App\Services\Equipment\EquipmentService;
use App\Services\EquipmentStatus\EquipmentStatusServices;
use App\Services\LendReturnEquipments\LendReturnEquipmentService;
use App\Services\Liquidation\LiquidationService;
use App\Services\Maintenance\MaintenanceServices;
use App\Services\Response\BaseService;
use App\Validators\Course\CourseValidator;
use App\Validators\Equipment\EquipmentValidator;
use Carbon\Carbon;
use Carbon\CarbonPeriod;
use Illuminate\Support\Facades\DB;
use Prettus\Validator\Contracts\ValidatorInterface;

class DashboardService extends BaseService
{
    public function repository(): string
    {
        // TODO: Implement repository() method.
        return ITypeOfEquipmentRepo::class;
    }

    public function index()
    {
        $dataReturn = [];
        $dataReturn['equipment_quantity'] = app(EquipmentService::class)->countEquipment();
        $dataReturn['lend_return_time'] = app(LendReturnEquipmentService::class)->countLendReturn();
        $dayStart = Carbon::now()->startOfYear()->toDateTimeString();
        $dayEnd = Carbon::now()->endOfYear()->toDateTimeString();
        $dataReturn['lend_return_static'] = app(LendReturnEquipmentService::class)->static('month', $dayStart, $dayEnd);
//        dd($dataReturn);
        return $dataReturn;
    }

    public function static($start, $end)
    {
        $dataReturn['lend_return_static'] = app(LendReturnEquipmentService::class)->static($start, $end);
        $dataReturn['equipment_static'] = app(EquipmentService::class)->static($start, $end);
        $dataReturn['liquidation_static'] = app(LiquidationService::class)->static($start, $end);
        $dataReturn['maintenance_static'] = app(MaintenanceServices::class)->static($start, $end);

        return $dataReturn;
    }


}
