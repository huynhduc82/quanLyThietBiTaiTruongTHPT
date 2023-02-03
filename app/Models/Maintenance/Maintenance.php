<?php

namespace App\Models\Maintenance;

use App\Models\BaseModel;
use App\Models\User;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 *
 * @property ?MaintenanceDetails $details
 */

class Maintenance extends BaseModel
{
    const STATUS_NEW = 1;
    const STATUS_MAINTAINING = 2;
    const STATUS_MAINTAINED = 3;

    const ATTRIBUTE = [
        'user_id',
        'maintenance_day',
        'status',
        'room_id'
    ];

    use SoftDeletes;

    protected $table = 'maintenance';

    protected $fillable = [
        'user_id',
        'maintenance_day',
        'status',
        'room_id',
    ];

    public function details() : HasMany
    {
        return $this->hasMany(MaintenanceDetails::class, 'equipment_reservation_id', 'id');
    }

    public function user() : BelongsTo
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }
}
