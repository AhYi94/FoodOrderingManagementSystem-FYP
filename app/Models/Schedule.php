<?php

namespace App\Models;

use DateTimeInterface;
use Illuminate\Database\Eloquent\Model;

class Schedule extends Model
{
    protected $fillable = [
        'date','start_time','end_time','fooditem'
    ];

    public function food()
    {
        return $this->belongsTo('App\Models\FoodMenu', 'foodmenu_id');
    }

    protected function serializeDate(DateTimeInterface $date)
    {
        return $date->format('Y-m-d H:i:s');
    }
}
