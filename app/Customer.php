<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Customer extends Model
{
    use SoftDeletes;

    public $table = 'customers';

    protected $dates = [
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    protected $fillable = [
        'name',
        'area',
        'phone',
        'phone2',
        'state',
        'email',
        'address',
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    public function customerOrders()
    {
        return $this->hasMany(Order::class, 'customer_id', 'id');
    }
}
