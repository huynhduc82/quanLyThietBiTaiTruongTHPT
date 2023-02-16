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

    const STATUS_OK = 0;
    const STATUS_BROKEN = 1;
    const STATUS_MAINTAINING = 2;
    const STATUS_CANNOT_CONTINUE_TO_USE = 3;

    use SoftDeletes;

    protected $table = 'equipment_status';

    protected $fillable = [
        'condition_details',
        'can_continue_to_use',
        'number_of_repairs',
        'status',
    ];

    public function equipments() : BelongsTo
    {
        return $this->belongsTo(Equipment::class, 'id', 'equipment_status_id');
    }
}
