<?php

namespace App\Entity\User;

use App\Entity\Shop\Cart\CartItem;
use App\Entity\Shop\Order\Order;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Str;
use DomainException;
use Psr\Log\InvalidArgumentException;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Orchid\Platform\Models\User as Authenticatable;
use Laravel\Fortify\TwoFactorAuthenticatable;
use Laravel\Jetstream\HasProfilePhoto;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable {
    use Notifiable;

    use HasApiTokens;
    use HasFactory;
    use HasProfilePhoto;
    use Notifiable;
    use TwoFactorAuthenticatable;

    protected $fillable = [
        'name',
        'email',
        'password',
        'permissions',
    ];

    protected $hidden = [
        'password',
        'remember_token',
        'permissions',
        'two_factor_recovery_codes',
        'two_factor_secret',
    ];

    protected $casts = [
        'permissions'          => 'array',
        'email_verified_at'    => 'datetime',
    ];

    protected $allowedFilters = [
        'id',
        'name',
        'email',
        'permissions',
    ];

    protected $allowedSorts = [
        'id',
        'name',
        'email',
        'updated_at',
        'created_at',
    ];

    protected $appends = [
        'profile_photo_url',
    ];

    public function profile() {
        return $this->belongsTo(Profile::class, 'id', 'user_id');
    }

    public function orders() {
        return $this->hasMany(Order::class, 'user_id', 'id');
    }

    public function cartItems() {
        return $this->hasMany(CartItem::class, 'user_id', 'id');
    }

    public function comparisonItems() {
        return $this->hasMany(ComparisonItem::class, 'user_id', 'id');
    }

    public function hasFilledProfile(): bool {
        return
            !empty($this->profile->surname) &&
            !empty($this->profile->patronymic) &&
            !empty($this->profile->phone) &&
            !empty($this->profile->code);
    }
}
