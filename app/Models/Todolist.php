<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Todo;
use App\Models\User;

class Todolist extends Model
{
    use HasFactory;

    public function todos()
    {
        return $this->hasMany(Todo::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
