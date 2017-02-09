<?php

namespace App;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

class Episode extends Model
{
    //
    protected $guarded = [];
    protected $casts = ['number' => 'integer'];
    protected $dates = ['air_date'];

    public function topics()
    {
        return $this->hasMany(Topic::class);
    }

    public function scopeAired($query)
    {
        return $query->where('air_date', '<', Carbon::now());
    }
}
