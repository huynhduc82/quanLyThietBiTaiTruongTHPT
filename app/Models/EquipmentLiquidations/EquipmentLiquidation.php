<?php

namespace App\Models\EquipmentLiquidations;

use App\Models\BaseModel;
use Illuminate\Database\Eloquent\SoftDeletes;

class EquipmentLiquidation extends BaseModel
{
    use SoftDeletes;

    protected $table = 'equipment_liquidation';

    protected $fillable = [
        'user_id',
        'approved_by',
    ];
}
