<?php

namespace App\Modules\Orders\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;

    protected $table = "new_orders";

    protected $fillable = ['id'];

    public function getOrderStatus() {
        return $this->belongsTo('App\Modules\Orders\Models\OrderStatus', 'status', 'id');
    }

    public function getPayment() {
        return $this->belongsTo('App\Modules\Parameters\Models\ParameterPayment', 'payment_id', 'id');
    }
}
