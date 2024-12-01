<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\File;
use Illuminate\Notifications\Notifiable;

class product extends Model
{
    use HasFactory, Notifiable;
    protected $table = 'products';
    protected $primaryKey = 'prod_id';
    protected $fillable = [
        'prod_name',
        'prod_code',
        'prod_category',
        'prod_desc',
        'prod_amount',
        'prod_collection',
    ];
    //
    public function firstImage()
    {
        return $this->hasOne(Image::class, 'image_prod_id', 'prod_id');
    }
    //
    public function AllImages()
    {
        return $this->hasMany(Image::class, 'image_prod_id', 'prod_id');
    }
    //
    protected static function booted()
    {
        //
        static::deleting(function ($product) {  
            //     
            foreach ($product->AllImages as $image) {
                $imagePath = 'images/prod_image/' . $image->image_name;
                if (File::exists($imagePath)) {
                    File::delete($imagePath);
                }
            } 
            //
            $product->AllImages()->delete();
            //
        });
        //
    }
}
