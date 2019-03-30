<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Auth;
class Vacancy extends Model
{
    use SoftDeletes;

    protected $fillable = ['name_vacancy',
        'amount_workers',
        'organization_id',
        'salary',
        'status',
        'creator_id'
    ];

    public static function boot()
    {

        parent::boot();

        static::creating(function ($table) {
            if(Auth::user()) {
                $table->creator_id = Auth::user()->id;
            }
            $table->status = 0;
        });
    }

    public function organization () {
        return $this->hasMany(Organization::class);
    }

    public function user () {
        return $this->hasMany(User::class);
    }

    public function order(){
        return $this->hasMany(Order::class);
    }
}
