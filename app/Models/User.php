<?php

namespace App\Models;

use App\Models\Courses\Courses;
use App\Models\ImageInfos\ImageInfo;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Spatie\Permission\Traits\HasRoles;

/**
 *
 * @property ?Courses courses
 * @property ?ImageInfo avatarInfo
 */


class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable, SoftDeletes, HasRoles;

    const NAME_MIN_LENGTH = 3;
    const NAME_MAX_LENGTH = 254;

    const PHONE_NUMBER_MIN_LENGTH = 8;
    const PHONE_NUMBER_MAX_LENGTH = 12;

    const IDENTIFICATION_MIN_LENGTH = 3;
    const IDENTIFICATION_MAX_LENGTH = 254;

    const ADDRESS_MIN_LENGTH = 3;
    const ADDRESS_MAX_LENGTH = 254;

    const LINK_MIN_LENGTH = 3;
    const LINK_MAX_LENGTH = 254;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'date_of_birth',
        'access_token',
        'phone_number',
        'avatar',
        'background',
        'course',
        'facebook',
        'twitter',
        'instagram',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function avatarInfo() : BelongsTo
    {
        return $this->belongsTo(ImageInfo::class, 'avatar', 'image_references');
    }

    public function courses() : BelongsToMany
    {
        return $this->belongsToMany(
            Courses::class,
            'user_course_pivot',
            'user_id',
            'course_id');
    }
}
