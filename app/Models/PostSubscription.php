<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class PostSubscription extends Model
{
    protected $table = 'post_subscription';
    public $fillable = [
        'subscription_id',
        'post_id',
    ];

    public function subscription(){
        return $this->belongsTo(Subscription::class);
    }
}
