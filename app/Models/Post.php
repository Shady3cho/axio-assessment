<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class Post extends Model
{
    protected $table = 'post';
    public $fillable = [
        'website_id',
        'title',
        'description',
        'scheduled_at',
        'is_sent',
    ];

    public function website(){
        return $this->belongsTo(Website::class);
    }
}
