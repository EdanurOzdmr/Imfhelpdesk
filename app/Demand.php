<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Demand extends Model
{
    protected $fillable = ['user_id', 'department_id', 'product_id', 'status', 'title', 'description'];

    public function assignedUser()
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }
    public function assignedDepartment()
    {
        return $this->belongsTo(Department::class, 'department_id', 'id');
    }
    public function assignedProduct()
    {
        return $this->belongsTo(Product::class, 'product_id', 'id');
    }

}
