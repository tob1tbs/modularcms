<?php

namespace App\Modules\Main\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Notification extends Model
{
    use HasFactory;

    protected $table = "new_notifications";

    protected $fillable = ['seen'];
}
