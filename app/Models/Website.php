<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class Website extends Model
{
    protected $table = 'website';
    public $fillable = [
        'name'
    ];

    public function posts(){
        return $this->hasMany(Post::class);
    }

    public function subscriptions(){
        return $this->hasMany(Subscription::class);
    }
}
