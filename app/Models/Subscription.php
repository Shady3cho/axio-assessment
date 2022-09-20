<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class Subscription extends Model
{
    protected $table = 'subscription';
    public $fillable = [
        'user_id',
        'website_id',
    ];

    public function user(){
        return $this->belongsTo(User::class);
    }

    public function website(){
        return $this->belongsTo(Website::class);
    }

    public function post_subscriptions(){
        return $this->hasMany(PostSubscription::class);
    }
}
