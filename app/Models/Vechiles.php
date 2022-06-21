<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\MediaLibrary\HasMedia\HasMedia;
use Spatie\MediaLibrary\HasMedia\HasMediaTrait;
use Illuminate\Database\Eloquent\SoftDeletes;

class Vechiles extends Model implements HasMedia
{
    protected $fillable = ['model','type','number','color','YearOfReg','notes'];
    use HasFactory,SoftDeletes,HasMediaTrait;

    public function offer_ride(){
        return $this->hasOne(OfferRide::class,'vechile_id');
    }
}
