<?php

namespace App\Modules\Products\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    protected $table = "new_products";

    protected $fillable = ['id', 'name_ge', 'name_en', 'category_id', 'child_category_id', 'description','brand_id', 'parent_id', 'discount_price', 'discount_percent', 'photo', 'count', 'stock', 'used', 'preorder', 'vendor_id', 'status', 'active', 'facebook', 'deleted_at', 'deleted_at_int'];

    public function productStatuses() {
        return $product_statuses = [
            '' => '',
            '1' => 'აქტიური',
            '2' => 'არააქტიური',
        ];
    }

    public function yesNo() {
        return $yes_no = [
            '' => '',
            '1' => 'კი',
            '2' => 'არა',
        ];
    }

    public function productCondition() {
        return $product_condition = [
            '' => '',
            '1' => 'მეორადი',
            '2' => 'ახალი',
        ];
    }

    public function productSort() {
        return $product_sort = [
            'DESC' => 'ახლიდან ძველისკენ',
            'ASC' => 'ძველიდან ახლისკენ',
        ];
    }

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
        return $this->hasMany('App\Modules\Products\Models\ProductPrice', 'product_id', 'id')->orderBy('id', 'DESC');
    }

    public function getProductChild() {
        return $this->hasMany('App\Modules\Products\Models\Product', 'parent_id', 'id');
    }

    public function productStatus() {
        return $this->hasOne('App\Modules\Products\Models\ProductStatus', 'id', 'status');
    }

    public function productMeta() {
        return $this->hasOne('App\Modules\Products\Models\ProductMeta', 'product_id', 'id');
    }
}
