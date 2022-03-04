<?php

namespace App\Modules\Products\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    protected $table = "new_products";

    protected $fillable = ['id', 'name_ge', 'category_id', 'child_category_id', 'brand_id', 'parent_id', 'discount_price', 'discount_percent', 'photo', 'count', 'stock', 'preorder', 'active', 'deleted_at', 'deleted_at_int'];

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
