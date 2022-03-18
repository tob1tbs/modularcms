<?php

namespace App\Modules\Products\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProductGallery extends Model
{
    use HasFactory;

    protected $table = "new_product_gallery";

    protected $fillable = ['product_id', 'path', 'active', 'deleted_at', 'deleted_at_int'];

}
