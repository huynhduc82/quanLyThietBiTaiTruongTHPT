<?php

namespace App\Models\EquipmentLiquidations;

use App\Models\BaseModel;
use App\Models\Maintenance\MaintenanceDetails;
use App\Models\User;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;

class EquipmentLiquidation extends BaseModel
{
    use SoftDeletes;

    const STATUS_NEW = 1;
    const STATUS_CANCEL = 2;
    const STATUS_APPROVED = 3;
    const STATUS_SUCCESS = 4;

    const ATTRIBUTE = [
        'user_id',
        'approved_by',
        'status',
    ];

    protected $table = 'equipment_liquidation';

    protected $fillable = [
        'user_id',
        'approved_by',
        'status',
    ];

    public function details() : HasMany
    {
        return $this->hasMany(EquipmentLiquidationDetails::class, 'equipment_liquidation_id', 'id');
    }

    public function user() : BelongsTo
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }

    public function approved() : BelongsTo
    {
        return $this->belongsTo(User::class, 'approved_by', 'id');
    }
}
