<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Report extends Model
{
    use HasFactory;

    protected static function booted()
    {
        static::addGlobalScope('user', function (Builder $builder) {
            if(auth()->user()?->role != 'Admin'){
                $builder->where('user_id', auth()->id() ?? NULL);
            }
        });
    }
}
