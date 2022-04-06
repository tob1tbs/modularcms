<?php

namespace App\Modules\Parameters\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ParameterSeo extends Model
{
    use HasFactory;

    protected $table = "new_seo_parameters";

    protected $fillable = ['value'];
}
