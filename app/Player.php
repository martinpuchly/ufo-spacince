<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Player extends Model
{
    protected $primaryKey = 'slug';
    protected $keyType = 'string';
    protected $fillable = [
        'id',
        'first_name', 'last_name', 'slug', 'nickname', 'shirt_number', 'photo', 'about',
        'sex', 'birth_date', 'team_id', 'user_id', 'show_profile', 'show_birth_date', 'show_photo', 'status', 'created_at', 'updated_at'
    ];
    use SoftDeletes;

    public const SEX = [
        1     => 'žena',
        2    => 'muž',
        3    => 'ešte som si to nerozmyslelo'
    ];
    public const PRIVACY_OPTIONS = [
        0     => 'nikto',
        1    => 'hráči',
        2    => 'prihlásení užívatelia',
        3    => 'všetci'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
    public function team()
    {
        return $this->belongsTo(Team::class);
    }

    public function getFullNameAttribute()
    {
        return "{$this->first_name} {$this->last_name}";
    }

    public function getImgPhotoAttribute()
    {
        if ($this->photo != null or file_exists($this->photo)) {
            return asset('storage/' . $this->photo);
        }
        return asset("storage/images/web/no_photo.png");
    }
}
