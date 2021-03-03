<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;

class Order extends Model
{
    use HasFactory, Notifiable;

    public $table = "orders";

    protected $fillable = [
        'user_own_id',
        'comment',
        'email',
        'phone',
        'address_city',
        'address_zip',
        'address_street',
        'address_house',
        'address_floor',
        'address_apart',
        'address_np_number',
        'guest_ip',
        'guest_useragent',
    ];



}
