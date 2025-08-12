<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use App\Models\Properties;
use App\Models\Bookings;
use App\Models\Reviews;

class User extends Authenticatable
{
    /** @use HasFactory<\Database\Factories\UserFactory> */
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'phone_number',
        'role',
        'avatar',
    ];

    /**
     * The attributes that should be hidden for serialization.
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

    public function isAdmin() { return $this->role === 'admin'; }
    public function isPenyewa() { return $this->role === 'penyewa'; }
    public function isCustomer() { return $this->role === 'customer'; }

    public function properties(){
        return $this->hasMany(Properties::class, 'penyewa_id');
    }

    public function bookings() {
        return $this->hasMany(Bookings::class, 'customer_id');
    }
    
    public function reviews() {
        return $this->hasMany(Reviews::class, 'customer_id');
    }

}
