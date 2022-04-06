<?php

namespace App\Modules\Parameters\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ParameterPayment extends Model
{
    use HasFactory;

    protected $table = "new_payments";

    protected $fillable = ['options', 'active', 'photo', 'description'];

    public function getPaymentCategory() {
        return $this->belongsTo('App\Modules\Parameters\Models\ParameterPaymentCategory', 'category_id', 'id');
    }
}
