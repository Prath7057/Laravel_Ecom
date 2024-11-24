<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;

class product extends Model
{
    use HasFactory, Notifiable;
    protected $fillable = [
        'prod_name',
        'prod_category',
        'prod_desc',
        'prod_amount',
        'prod_collection',
    ];
}
