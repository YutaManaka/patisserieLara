<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Fortify\TwoFactorAuthenticatable;
use Laravel\Jetstream\HasProfilePhoto;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens;
    use HasFactory;
    use HasProfilePhoto;
    use Notifiable;
    use TwoFactorAuthenticatable;

    // 権限
    public const PERMISSION_ROOT   = 99;
    public const PERMISSION_SYSTEM = 80;
    public const PERMISSION_ADMIN  = 70;

    // 権限名
    public const PERMISSION_NAMES = [
        self::PERMISSION_ROOT   => 'root',
        self::PERMISSION_SYSTEM => 'システム',
        self::PERMISSION_ADMIN  => 'Admin',
    ];

    public const USER_LABELS = [
        'index_title' => 'アカウント一覧',
        'form_title'  => 'アカウント設定',
        'name'        => 'ユーザ名',
        'email'       => 'ログインID',
        'permission'  => '権限',
    ];

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'permission',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
        'two_factor_recovery_codes',
        'two_factor_secret',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    /**
     * The accessors to append to the model's array form.
     *
     * @var array<int, string>
     */
    protected $appends = [
        'profile_photo_url',
    ];

    public static function getPermissionNames(): array
    {
        return self::PERMISSION_NAMES;
    }
}
