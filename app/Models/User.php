<?php

namespace App\Models;

use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Auth;

class User extends Authenticatable
{
    use Notifiable, SoftDeletes;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'email',
        'password',
        'first_name',
        'last_name',
        'country',
        'city',
        'phone',
        'role_id'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    public static function boot()
    {

        parent::boot();

        static::creating(function ($table) {
            if($table->role_id==NULL)
                $table->role_id = 1;
        });
    }

    /**
     * Generate random unique token.
     *
     * @return string $token
     */
    public function generateToken()
    {
        $this->api_token = str_random(60);
        while (User::where('api_token', $this->api_token)->first()) {
            $this->api_token = str_random(60);
        }
        $this->save();

        return $this->api_token;
    }

    public function roles() {
        return $this->belongsTo(Roles::class);
    }

    public function organizations () {
        return $this->hasMany(Organization::class,'creator_id');
    }
    public function vacancies () {
        return $this->hasMany(Vacancy::class,'creator_id');
    }
    public function order () {
        return $this->hasMany(Order::class);
    }
}
