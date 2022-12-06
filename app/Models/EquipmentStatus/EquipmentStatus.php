<?php

namespace App\Models\EquipmentStatus;

use App\Models\BaseModel;
use App\Models\Equipments\Equipment;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;

class EquipmentStatus extends BaseModel
{
    const STATUS_ALL_GOOD = 'All good';
    const CAN_CONTINUE_USE = true;

    const DETAILS_MIN_LENGTH = 3;
    const DETAILS_MAX_LENGTH = 254;

    use SoftDeletes;

    protected $table = 'equipment_status';

    protected $fillable = [
        'condition_details',
        'can_continue_to_use',
        'number_of_repairs',
    ];

    public function equipments() : BelongsTo
    {
        return $this->belongsTo(Equipment::class, 'equipment_status_id', 'id');
    }
}
