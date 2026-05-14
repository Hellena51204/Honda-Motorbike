<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Database\Factories\UserFactory;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    /** @use HasFactory<UserFactory> */
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     * Các trường thông tin (cột) trong bảng Users được phép thêm/sửa hàng loạt bằng phương thức create() hoặc update()
     *
     * @var list<string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'phone',
        'address',
        'avatar',
        'membership',
        'membership_points',
    ];

    /**
     * The attributes that should be hidden for serialization.
     * Các trường bảo mật sẽ bị ẩn đi khi chuyển dữ liệu Model thành mảng hoặc JSON (tránh rò rỉ thông tin)
     *
     * @var list<string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }

    /**
     * Mối quan hệ với bảng Orders (Đơn hàng):
     * Một User (Người dùng) có thể có nhiều Order (Đơn hàng)
     */
    public function orders()
    {
        return $this->hasMany(\App\Models\Order::class);
    }
}
