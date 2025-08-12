<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PropertyChangeRequest extends Model
{
    use HasFactory;

    protected $fillable = ['property_id', 'requested_by', 'action', 'field_change', 'status', 'admin_note'];

    protected $casts = [
        'field_change' => 'array',
    ];

    public function property(){
        return $this->belongsTo(Properties::class);
    }

    public function requester(){
        return $this->belongsTo(User::class, 'requested_by');
    }
}
