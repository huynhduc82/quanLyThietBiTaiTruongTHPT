<?php

namespace App\Http\Controllers\EquipmentStatus;

use App\Http\Controllers\Controller;
use App\Services\EquipmentStatus\EquipmentStatusServices;

class EquipmentStatusController extends Controller
{
    public function __construct(
        protected EquipmentStatusServices $equipmentStatusService
    )
    {
    }

    public function store()
    {
        $this->equipmentStatusService;
    }
}
