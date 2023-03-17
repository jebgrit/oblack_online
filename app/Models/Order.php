<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function region()
    {
        return $this->belongsTo(ShipRegion::class, 'ship_region_id', 'id');
    }

    public function department()
    {
        return $this->belongsTo(ShipDepartment::class, 'ship_department_id', 'id');
    }

    public function city()
    {
        return $this->belongsTo(ShipCity::class, 'ship_city_id', 'id');
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }

    /**
     * one to Many.
     */
    public function orderItems()
    {
        return $this->hasMany(OrderItem::class, 'order_id', 'id');
    }
}
