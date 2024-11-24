<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;

class image extends Model
{
    use HasFactory, Notifiable;
    protected $table = 'images';
    protected $primaryKey = 'image_id';
    protected $fillable = [
        'image_name',
        'image_prod_id',
        'image_data',
    ];
    public $timestamps = false;
}
