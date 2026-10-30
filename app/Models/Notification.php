<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Notification extends Model
{
    use HasFactory;

    protected $fillable = [
        'title', 'message', 'type', 'link', 'is_read', 'order_id'
    ];

    protected $casts = [
        'is_read' => 'boolean',
    ];
}