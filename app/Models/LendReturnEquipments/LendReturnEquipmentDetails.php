<?php

namespace App\Models\LendReturnEquipments;

use App\Models\BaseModel;
use Illuminate\Database\Eloquent\SoftDeletes;

class LendReturnEquipmentDetails extends BaseModel
{
    use SoftDeletes;

    protected $table = 'lend_return_equipment_details';

    protected $fillable = [
        'lend_return_equipment_id',
        'equipment_id',
        'quantity',
        'equipment_status_id',
        'recoup_id',
        'type_of_equipment_id',
    ];
}
