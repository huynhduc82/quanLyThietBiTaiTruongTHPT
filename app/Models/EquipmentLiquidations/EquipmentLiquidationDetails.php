<?php

namespace App\Models\EquipmentLiquidations;

use App\Models\BaseModel;
use App\Models\Equipments\Equipment;
use App\Models\Rooms\Room;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;

class EquipmentLiquidationDetails extends BaseModel
{
    use SoftDeletes;

    protected $table = 'equipment_liquidation_details';

    protected $fillable = [
        'equipment_liquidation_id',
        'equipment_id',
        'liquidation_reason',
        'liquidation_method',
        'room_id'
    ];

    public function equipments() : BelongsTo
    {
        return $this->BelongsTo(Equipment::class, 'equipment_id', 'id')->withTrashed();
    }

    public function room() : BelongsTo
    {
        return $this->BelongsTo(Room::class, 'room_id', 'id');
    }
}
