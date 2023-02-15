<?php

namespace App\Models\Maintenance;

use App\Models\BaseModel;
use App\Models\Rooms\Room;
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
    const STATUS_CANCEL = 2;
    const STATUS_MAINTAINING = 3;
    const STATUS_MAINTAINED = 4;

    const ATTRIBUTE = [
        'user_id',
        'maintenance_day',
        'status',
        'room_id',
        'maintenancer_id',
        'maintenance_time',
    ];

    use SoftDeletes;

    protected $table = 'maintenance';

    protected $fillable = [
        'user_id',
        'maintenance_day',
        'status',
        'room_id',
        'maintenancer_id',
        'maintenance_time',
    ];

    public function details() : HasMany
    {
        return $this->hasMany(MaintenanceDetails::class, 'maintenance_id', 'id');
    }

    public function user() : BelongsTo
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }

    public function maintenancer() : BelongsTo
    {
        return $this->belongsTo(User::class, 'maintenancer_id', 'id');
    }

    public function room() : BelongsTo
    {
        return $this->belongsTo(Room::class, 'room_id', 'id');
    }
}
