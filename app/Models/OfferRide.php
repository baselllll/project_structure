<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Spatie\MediaLibrary\HasMedia\HasMedia;
use Spatie\MediaLibrary\HasMedia\HasMediaTrait;

class OfferRide extends Model implements HasMedia
{
    use HasFactory,SoftDeletes,HasMediaTrait;
    protected $fillable=
    [
        'user_id','vechile_id','location_from','location_to','WhenToGo','offering_seats','Max_Speed'
        ,'needs_desciption','Accept_Offer','date_offer_ride','time_offer_ride','In_Between_Date'
    ];

    public function user(){
        return $this->belongsTo(User::class,'user_id');
    }

    public function vechile(){
        return $this->belongsTo(Vechiles::class,'vechile_id');
    }
}
