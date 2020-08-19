<?php

namespace App\Models;

use DateTimeInterface;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id')->withTrashed();
    }

    public function food()
    {
        return $this->belongsTo(Foodmenu::class, 'foodmenu_id');
    }

    public function schedule()
    {
        return $this->belongsTo(Schedule::class, 'schedule_date');
    }

    protected function serializeDate(DateTimeInterface $date)
    {
        return $date->format('Y-m-d H:i:s');
    }
}
