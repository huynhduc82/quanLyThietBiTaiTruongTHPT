<?php

namespace App\Models\EquipmentDetails;

use App\Models\BaseModel;
use Illuminate\Database\Eloquent\SoftDeletes;

class EquipmentDetails extends BaseModel
{
    const LEND_AND_RETURN_TYPE = 1;
    const RESERVATION_TYPE = 2;
    const LIQUIDATION_TYPE = 3;
    const IMPORT_TYPE = 4;

    use SoftDeletes;

    protected $table = 'equipment_details';

    protected $fillable = [
        'type_of_equipment_id',
        'equipment_id',
        'type',
        'type_id',
    ];
}
