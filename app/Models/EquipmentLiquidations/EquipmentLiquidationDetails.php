<?php

namespace App\Models\EquipmentLiquidations;

use App\Models\BaseModel;
use Illuminate\Database\Eloquent\SoftDeletes;

class EquipmentLiquidationDetails extends BaseModel
{
    use SoftDeletes;

    protected $table = 'equipment_liquidation_details';

    protected $fillable = [
        'equipment_liquidation_id',
        'equipment_id',
        'quantity',
        'liquidation_reason',
        'liquidation_method',
    ];
}
