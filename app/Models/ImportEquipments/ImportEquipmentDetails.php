<?php

namespace App\Models\ImportEquipments;

use App\Models\BaseModel;
use Illuminate\Database\Eloquent\SoftDeletes;

class ImportEquipmentDetails extends BaseModel
{
    use SoftDeletes;

    protected $table = 'import_equipment_details';

    protected $fillable = [
        'import_equipment_id',
        'equipment_id',
        'quantity',
    ];
}
