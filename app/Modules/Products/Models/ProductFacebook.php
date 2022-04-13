<?php

namespace App\Modules\Products\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProductFacebook extends Model
{
    use HasFactory;

    protected $table = "new_facebook_products";

    public function getCategoryData() {
        return $this->hasOne('App\Modules\Products\Models\ProductCategory', 'id', 'category_id');
    }

    public function getChildCategoryData() {
        return $this->hasOne('App\Modules\Products\Models\ProductCategory', 'id', 'child_category_id');
    }

    public function getBrandData() {
        return $this->hasOne('App\Modules\Products\Models\ProductBrand', 'id', 'brand_id');
    }

    public function getProductPrice() {
        return $this->hasOne('App\Modules\Products\Models\ProductPrice', 'product_id', 'id');
    }

    public function getProductChild() {
        return $this->hasMany('App\Modules\Products\Models\Product', 'parent_id', 'id');
    }
}
