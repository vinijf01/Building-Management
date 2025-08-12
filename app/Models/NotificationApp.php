<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class NotificationApp extends Model
{
    use HasFactory;

    protected $fillable = ['user_id', 'type', 'title', 'message'];

    public function user(){
        return $this->belongsTo(User::class);
    }
}
