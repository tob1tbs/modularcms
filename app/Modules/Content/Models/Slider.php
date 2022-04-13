<?php

namespace App\Modules\Content\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Slider extends Model
{
    use HasFactory;

    protected $table = "new_slider";

    protected $fillable = ['id', 'path', 'text', 'url', 'is_banner', 'active', 'deleted_at', 'deleted_at_int'];
}
