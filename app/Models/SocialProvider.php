<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SocialProvider extends Model
{
    use HasFactory;

    const FACEBOOK = "facebook";
    const APPLE = "apple";
    const GOOGLE = "google";

    const PROVIDERS = [self::FACEBOOK, self::APPLE, self::GOOGLE];

    protected $fillable = ['provider', 'provider_id', 'user_id', 'avatar'];

    protected $hidden = [
        'created_at',
        'updated_at'
    ];
}
