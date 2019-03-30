<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Auth;

class Organization extends Model
{
    //
    use SoftDeletes;
    protected $fillable = ['name_organization',
        'city',
        'country',
        'creator_id',
    ];

    public static function boot()
    {

        parent::boot();

        static::creating(function ($table) {
            if(Auth::user()) {
                $table->creator_id = Auth::user()->id;
            }
        });
    }

    public function user() {
        return $this->hasMany(User::class);
    }
    public function vacancy() {
        return $this->hasMany(Vacancy::class);
    }

}
