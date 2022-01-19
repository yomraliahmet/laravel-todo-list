<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TodoLog extends Model
{
    use HasFactory;

    protected $fillable = [
        'detail',
        'action',
        'user_id',
        'todo_id'
    ];
}
