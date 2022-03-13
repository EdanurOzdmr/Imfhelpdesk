<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Passport\HasApiTokens;

class Staff extends Authenticatable
{
    use Notifiable, HasApiTokens;
    protected $fillable = [
       'department_id', 'name', 'email', 'password',
    ];
    public function assignedDepartment()
    {
        return $this->belongsTo(Department::class, 'department_id', 'id');
    }
}
