<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Filament\Panel;
use App\Models\Reviews;
use App\Models\Bookings;
use App\Models\Properties;
use Illuminate\Support\Facades\Storage;
use Filament\Models\Contracts\HasAvatar;
use Illuminate\Notifications\Notifiable;
use Filament\Models\Contracts\FilamentUser;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable implements FilamentUser, HasAvatar
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

    public function canAccessPanel(Panel $panel): bool
    {
        return match ($panel->getId()) {
            'admin' => $this->role === 'admin',
            'penyewa' => $this->role === 'penyewa',
            default => false,
        };
    }

    public function getFilamentAvatarUrl(): ?string
    {
        return $this->avatar? asset('storage/' . $this->avatar) : null;
    }

    protected static function boot()
    {
        parent::boot();

        // Hapus file kalau record dihapus
        static::deleting(function ($image) {
            if ($image->avatar && Storage::disk('public')->exists($image->avatar)) {
                Storage::disk('public')->delete($image->avatar);
            }
        });

        // Hapus file lama kalau update gambar
        static::updating(function ($image) {
            if ($image->isDirty('avatar')) { // Cek kalau avatar berubah
                $oldPath = $image->getOriginal('avatar');
                if ($oldPath && Storage::disk('public')->exists($oldPath)) {
                    Storage::disk('public')->delete($oldPath);
                }
            }
        });
    }


}


