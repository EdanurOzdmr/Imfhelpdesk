<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    protected $fillable = ['staff_id', 'demand_id', 'comments'];

    public function assignedStaff()
    {
        return $this->belongsTo(Staff::class, 'staff_id', 'id');
    }

    public function assignedDemand()
    {
        return $this->belongsTo(Demand::class, 'demand_id', 'id');
    }
}
