<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Role extends Model
{
    use HasFactory;

    public $table = "user_roles";

    public function users()
    {
        return $this->belongsToMany(User::class);
    }
}
