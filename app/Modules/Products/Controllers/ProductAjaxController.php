<?php

namespace App\Modules\Products\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Modules\Products\Models\ProductCategory;
use App\Modules\Products\Models\ProductOption;
use App\Modules\Products\Models\ProductOptionValue;
use App\Modules\Products\Models\ProductBrand;

use Validator;
use Illuminate\Validation\Rule;
use Response;
use Carbon\Carbon;

class ProductAjaxController extends Controller
{
    //

    public function ajaxCategoriesAdd(Request $Request) {
        if($Request->isMethod('POST')) {
            $messages = array(
                'required' => 'გთხოვთ შეიყვანოთ ყველა აუცილებელი ველი',
            );
            $validator = Validator::make($Request->all(), [
                'category_name_ge' => 'required|max:255',
            ], $messages);

            if ($validator->fails()) {
                return Response::json(['status' => true, 'errors' => true, 'message' => $validator->getMessageBag()->toArray()], 200);
            } else {

                $Array = ['ge' => $Request->category_name_ge, 'en' => $Request->category_name_en];

                $ProductCategory = new ProductCategory();
                $ProductCategory::updateOrCreate(
                    ['id' => $Request->category_id],
                    [
                        'id' => $Request->category_id, 
                        'name' => json_encode($Array),
                        'parent_id' => 0,
                    ],
                );
                return Response::json(['status' => true, 'errors' => false, 'message' => 'კატეგორია წარმატებით დაემატა']);
            }
        } else {
            return Response::json(['status' => false, 'message' => 'დაფიქსირდა შეცდომა, გთხოვთ სცადოთ თავიდან !!!']);
        }
    }

    public function ajaxCategoriesSortable(Request $Request) {
        if($Request->isMethod('POST')) {
            foreach($Request->category_item as $key => $Item) {
                $Sortable = $key + 1;
                $ProductCategory = new ProductCategory();
                $ProductCategory::where('id', intval($Item))->update(['sortable' => intval($Sortable)]);
            }
            return Response::json(['status' => true]);
        } else {
            return Response::json(['status' => false]);
        }
    }

    public function ajaxCategoriesActive(Request $Request) {
        if($Request->isMethod('POST') && !empty($Request->category_id)) {

            if($Request->category_id != 1){
                $ProductCategory = new ProductCategory();
                $ProductCategory::find($Request->category_id)->update([
                    'active' => $Request->category_active,
                ]);

                return Response::json(['status' => true, 'errors' => false]);
            } else {
                return Response::json(['status' => false, 'message' => 'დაფიქსირდა შეცდომა გთხოვთ სცადოთ თავიდან !!!']);
            }

        } else {
            return Response::json(['status' => false, 'message' => 'დაფიქსირდა შეცდომა გთხოვთ სცადოთ თავიდან !!!']);
        }
    }

    public function ajaxCategoriesDelete(Request $Request) {
        if($Request->isMethod('POST') && !empty($Request->category_id)) {

            if($Request->category_id != 1) {
                $ProductCategory = new ProductCategory();
                $ProductCategory::find($Request->category_id)->update([
                    'active' => 0,
                    'deleted_at' => Carbon::now(),
                    'deleted_at_int' => 0,
                ]);

                return Response::json(['status' => true, 'errors' => false, 'message' => 'მომხმარებელი წარმატებით წაიშალა']);
            } else {
                return Response::json(['status' => false, 'message' => 'დაფიქსირდა შეცდომა გთხოვთ სცადოთ თავიდან !!!']);
            }

        } else {
            return Response::json(['status' => false, 'message' => 'დაფიქსირდა შეცდომა გთხოვთ სცადოთ თავიდან !!!']);
        }
    }

    public function ajaxCategoriesEdit(Request $Request) {
        if($Request->isMethod('GET')) {
            if($Request->category_id != 1) {
                $ProductCategory = new ProductCategory();
                $ProductCategoryData = $ProductCategory::findOrFail($Request->category_id);

                return Response::json(['status' => true, 'errors' => false, 'ProductCategoryData' => $ProductCategoryData]);
            } else {
                return Response::json(['status' => false, 'message' => 'დაფიქსირდა შეცდომა გთხოვთ სცადოთ თავიდან !!!']);
            }
        } else {
                return Response::json(['status' => false, 'message' => 'დაფიქსირდა შეცდომა გთხოვთ სცადოთ თავიდან !!!']);
        }
    }

    public function ajaxCategoriesChild(Request $Request) {
        if($Request->isMethod('GET') && !empty($Request->category_id)) {
            $ProductCategory = new ProductCategory();
            $ProductChildCategoryList = $ProductCategory::where('parent_id', $Request->category_id)
                                                    ->where('deleted_at_int', '!=', 0)
                                                    ->orderBy('sortable', 'ASC')
                                                    ->get();

            return Response::json(['status' => true, 'ProductChildCategoryList' => $ProductChildCategoryList]);
        } else {
            return Response::json(['status' => false]);
        }
    }

    public function ajaxCategoriesChildAdd(Request $Request) {
        if($Request->isMethod('POST')) {
            $messages = array(
                'required' => 'გთხოვთ შეიყვანოთ ყველა აუცილებელი ველი',
            );
            $validator = Validator::make($Request->all(), [
                'child_category_name_ge' => 'required|max:255',
            ], $messages);

            if ($validator->fails()) {
                return Response::json(['status' => true, 'errors' => true, 'message' => $validator->getMessageBag()->toArray()], 200);
            } else {
                $Array = ['ge' => $Request->child_category_name_ge, 'en' => $Request->child_category_name_en];

                $ProductCategory = new ProductCategory();
                $ProductCategory::updateOrCreate(
                    ['id' => $Request->child_category_id],
                    [
                        'id' => $Request->child_category_id, 
                        'name' => json_encode($Array),
                        'parent_id' => $Request->child_category_parent_id,
                    ],
                );

                $ProductChildCategoryList = $ProductCategory::where('parent_id', $Request->child_category_parent_id)->where('deleted_at_int', '!=', 0)->get();

                return Response::json(['status' => true, 'errors' => false, 'ProductChildCategoryList' => $ProductChildCategoryList, 'message' => 'კატეგორია წარმატებით დაემატა']);
            }
        } else {
            return Response::json(['status' => false, 'message' => 'დაფიქსირდა შეცდომა გთხოვთ სცადოთ თავიდან !!!']);
        }
    }

    public function ajaxCategoriesChildDelete(Request $Request) {
        if($Request->isMethod('POST') && !empty($Request->child_category_id)) {

            $ProductCategory = new ProductCategory();
            $ProductCategoryData = $ProductCategory::find($Request->child_category_id);

            $ProductCategoryData->update([
                'active' => 0,
                'deleted_at' => Carbon::now(),
                'deleted_at_int' => 0,
            ]);

            $ProductChildCategoryList = $ProductCategory::where('parent_id', $ProductCategoryData->parent_id)->where('deleted_at_int', '!=', 0)->get();

            return Response::json(['status' => true, 'errors' => false, 'message' => 'მომხმარებელი წარმატებით წაიშალა', 'ProductChildCategoryList' => $ProductChildCategoryList]);

        } else {
            return Response::json(['status' => false, 'message' => 'დაფიქსირდა შეცდომა გთხოვთ სცადოთ თავიდან !!!']);
        }
    }

    public function ajaxCategoriesChildSortable(Request $Request) {
        if($Request->isMethod('POST')) {
            foreach($Request->child_category_item as $key => $Item) {
                $Sortable = $key + 1;
                $ProductCategory = new ProductCategory();
                $ProductCategory::where('id', intval($Item))->update(['sortable' => intval($Sortable)]);
            }
        } else {
            return Response::json(['status' => false]);
        }
    }

    public function ajaxBrandFormSubmit(Request $Request) {
        if($Request->isMethod('POST')) {
            $messages = array(
                'required' => 'გთხოვთ შეიყვანოთ ყველა აუცილებელი ველი',
            );
            $validator = Validator::make($Request->all(), [
                'brand_name_ge' => 'required|max:255',
            ], $messages);

            if ($validator->fails()) {
                return Response::json(['status' => true, 'errors' => true, 'message' => $validator->getMessageBag()->toArray()], 200);
            } else {
                $Array = ['ge' => $Request->brand_name_ge, 'en' => $Request->brand_name_en];

                $ProductBrand = new ProductBrand();
                $ProductBrand::updateOrCreate(
                    ['id' => $Request->brand_id],
                    [
                        'id' => $Request->brand_id,
                        'name' => json_encode($Array),
                        'category_id' => $Request->brand_category_id,
                        'child_category_id' => $Request->brand_child_category_id,
                    ],
                );

                return Response::json(['status' => true, 'errors' => false, 'message' => 'ბრენდი წარმატებით დაემატა']);
            }
        } else {
            return Response::json(['status' => false, 'message' => 'დაფიქსირდა შეცდომა გთხოვთ სცადოთ თავიდან !!!']);
        }
    }

    public function ajaxGetSubCategoryList(Request $Request) {
        if($Request->isMethod('GET') && !empty($Request->category_id)) {
            $ProductCategory = new ProductCategory();
            $ProductChildCategoryList = $ProductCategory::where('parent_id', $Request->category_id)
                                                    ->where('deleted_at_int', '!=', 0)
                                                    ->orderBy('sortable', 'ASC')
                                                    ->get();

            return Response::json(['status' => true, 'ProductChildCategoryList' => $ProductChildCategoryList]);
        } else {
            return Response::json(['status' => false]);
        }
    }


    public function ajaxBrandActiveChange(Request $Request) {
        if($Request->isMethod('POST') && !empty($Request->brand_id)) {

            $ProductBrand = new ProductBrand();
            $ProductBrand::find($Request->brand_id)->update([
                'active' => $Request->brand_active,
            ]);

            return Response::json(['status' => true, 'errors' => false]);

        } else {
            return Response::json(['status' => false, 'message' => 'დაფიქსირდა შეცდომა გთხოვთ სცადოთ თავიდან !!!']);
        }
    }

    public function ajaxBrandDelete(Request $Request) {
        if($Request->isMethod('POST') && !empty($Request->brand_id)) {

            $ProductBrand = new ProductBrand();
            $ProductBrand::find($Request->brand_id)->update([
                'active' => 0,
                'deleted_at' => Carbon::now(),
                'deleted_at_int' => 0,
            ]);

            return Response::json(['status' => true, 'errors' => false, 'message' => 'ბრენდი წარმატებით წაიშალა !!!']);

        } else {
            return Response::json(['status' => false, 'message' => 'დაფიქსირდა შეცდომა გთხოვთ სცადოთ თავიდან !!!']);
        }
    }

    public function ajaxBrandSort(Request $Request) {
        if($Request->isMethod('POST')) {
            foreach($Request->brand_item as $key => $Item) {
                $Sortable = $key + 1;
                $ProductBrand = new ProductBrand();
                $ProductBrand::where('id', intval($Item))->update(['sortable' => intval($Sortable)]);
            }
        } else {
            return Response::json(['status' => false]);
        }
    }

    public function ajaxBrandEdit(Request $Request) {
        if($Request->isMethod('GET') && !empty($Request->brand_id)) {
            $ProductBrand = new ProductBrand();
            $ProductBrandData = $ProductBrand::findOrFail($Request->brand_id);

            $ProductCategory = new ProductCategory();
            $ChildCategoryList = $ProductCategory::where('parent_id', $ProductBrandData->category_id)->where('deleted_at_int', '!=', 0)->where('active', 1)->get();

            return Response::json(['status' => true, 'errors' => false, 'ProductBrandData' => $ProductBrandData, 'ChildCategoryList' => $ChildCategoryList]);
        } else {
            return Response::json(['status' => false, 'message' => 'დაფიქსირდა შეცდომა გთხოვთ სცადოთ თავიდან !!!']);
        }
    }


    // OPTIONS
    public function ajaxOptionSubmit(Request $Request) {
        if($Request->isMethod('POST')) {
            $messages = array(
                'required' => 'გთხოვთ შეიყვანოთ ყველა აუცილებელი ველი',
                'option_key.unique' => 'მოცემული KEY დაკავებულია',
            );
            $validator = Validator::make($Request->all(), [
                'option_name_ge' => 'required|max:255',
                'option_key' => 'required|unique:new_product_options,key,'.$Request->option_id.'|max:50',
                'option_category' => 'required|max:255',
                'option_type' => 'required|max:255',
            ], $messages);

            if ($validator->fails()) {
                return Response::json(['status' => true, 'errors' => true, 'message' => $validator->getMessageBag()->toArray()], 200);
            } else {
                $Array = ['ge' => $Request->option_name_ge, 'en' => $Request->option_name_en];

                $ProductOption = new ProductOption();
                $ProductOption::updateOrCreate(
                    ['id' => $Request->option_id],
                    [
                        'id' => $Request->option_id,
                        'name' => json_encode($Array),
                        'key' => $Request->option_key,
                        'category_id' => $Request->option_category,
                        'child_category_id' => $Request->option_child_category,
                        'type' => $Request->option_type,
                    ],
                );

                return Response::json(['status' => true, 'message' => 'პარამეტრი წარმატებით დაემატა']);
            }
        } else {
            return Response::json(['status' => false, 'message' => 'დაფიქსირდა შეცდომა გთხოვთ სცადოთ თავიდან !!!']);
        }
    }

    public function ajaxOptionActive(Request $Request) {
        if($Request->isMethod('POST') && $Request->option_id > 0) {
            $ProductOption = new ProductOption();
            $ProductOption::find($Request->option_id)->update([
                'active' => $Request->option_active,
            ]);

            return Response::json(['status' => true, 'errors' => false]);
        } else {
            return Response::json(['status' => false, 'message' => 'დაფიქსირდა შეცდომა გთხოვთ სცადოთ თავიდან !!!']);
        }
    }

    public function ajaxOptionDelete(Request $Request) {
        if($Request->isMethod('POST') && !empty($Request->option_id)) {

            $ProductOption = new ProductOption();
            $ProductOption::find($Request->option_id)->update([
                'active' => 0,
                'deleted_at' => Carbon::now(),
                'deleted_at_int' => 0,
            ]);

            return Response::json(['status' => true, 'errors' => false, 'message' => 'ბრენდი წარმატებით წაიშალა !!!']);

        } else {
            return Response::json(['status' => false, 'message' => 'დაფიქსირდა შეცდომა გთხოვთ სცადოთ თავიდან !!!']);
        }
    }

    public function ajaxOptionOptions(Request $Request) {
        if($Request->isMethod('GET') && !empty($Request->option_id)) {

            $ProductOption = new ProductOption();
            $ProductOptionData = $ProductOption::find($Request->option_id);

            $ProductCategory = new ProductCategory();
            $ProductChildCategoryList = $ProductCategory::where('parent_id', $ProductOptionData->category_id)
                                                    ->where('deleted_at_int', '!=', 0)
                                                    ->where('active', 1)
                                                    ->orderBy('sortable', 'ASC')
                                                    ->get();

            return Response::json(['status' => true, 'errors' => false, 'ProductOptionData' => $ProductOptionData, 'ProductChildCategoryList' => $ProductChildCategoryList]);

        } else {
            return Response::json(['status' => false, 'message' => 'დაფიქსირდა შეცდომა გთხოვთ სცადოთ თავიდან !!!']);
        }
    }

    public function ajaxOptionSortable(Request $Request) {
        if($Request->isMethod('POST')) {
            foreach($Request->option_item as $key => $Item) {
                $Sortable = $key + 1;
                $ProductOption = new ProductOption();
                $ProductOption::where('id', intval($Item))->update(['sortable' => intval($Sortable)]);
            }
            return Response::json(['status' => true]);
        } else {
            return Response::json(['status' => false]);
        }
    }

    public function ajaxOptionValue(Request $Request) {
        if($Request->isMethod('GET') && !empty($Request->option_id)) {
            $ProductOptionValue = new ProductOptionValue();
            $ProductOptionValueList = $ProductOptionValue::where('deleted_at_int', '!=', 0)->where('option_id', $Request->option_id)->orderBy('sortable', 'ASC')->get();

            return Response::json(['status' => true, 'ProductOptionValueList' => $ProductOptionValueList]);
        } else {
            return Response::json(['status' => false, 'message' => 'დაფიქსირდა შეცდომა გთხოვთ სცადოთ თავიდან !!!']);
        }
    }

    public function ajaxOptionValueSubmit(Request $Request) {
        if($Request->isMethod('POST') && !empty($Request->value_option_id)) {
            $messages = array(
                'required' => 'გთხოვთ შეიყვანოთ ყველა აუცილებელი ველი',
                'option_value_key.unique' => 'აღნიშნული KEY დაკავებულია',
            );
            $validator = Validator::make($Request->all(), [
                'option_value_name_ge' => 'required|max:255',
                'option_value_key' => Rule::unique('new_product_option_value', 'key')->where(function ($query) use ($Request) {
                   return $query->where('option_id', $Request->value_option_id)
                                ->where('deleted_at_int', 1)
                                ->whereNull('deleted_at');
                }),
            ], $messages);

            if ($validator->fails()) {
                return Response::json(['status' => true, 'errors' => true, 'message' => $validator->getMessageBag()->toArray()], 200);
            } else {
                $Array = ['ge' => $Request->option_value_name_ge, 'en' => $Request->option_value_name_en];

                $ProductOption = new ProductOption();
                $ProductOptionData = $ProductOption::find($Request->value_option_id);

                $ProductOptionValue = new ProductOptionValue();
                $ProductOptionValueData = $ProductOptionValue::updateOrCreate(
                    ['id' => $Request->option_value_id],
                    [
                        'id' => $Request->option_value_id,
                        'name' => json_encode($Array),
                        'key' => $Request->option_value_key,
                        'option_key' => $ProductOptionData->key,
                        'option_id' => $ProductOptionData->id,
                    ],
                );

                $ProductOptionValueList = $ProductOptionValue::where('option_id', $ProductOptionValueData->option_id)
                                                                ->where('deleted_at_int', '!=', 0)
                                                                ->orderBy('sortable', 'ASC')
                                                                ->get();

                return Response::json(['status' => true, 'errors' => false, 'ProductOptionValueList' => $ProductOptionValueList]);
            }
        } else {
            return Response::json(['status' => false, 'message' => 'დაფიქსირდა შეცდომა გთხოვთ სცადოთ თავიდან !!!']);
        }
    }

    public function ajaxOptionValueActive(Request $Request) {
        if($Request->isMethod('POST') && !empty($Request->option_value_id)) {

            $ProductOptionValue = new ProductOptionValue();
            $ProductOptionValue::find($Request->option_value_id)->update([
                'active' => $Request->option_value_active,
            ]);

            return Response::json(['status' => true, 'errors' => false]);

        } else {
            return Response::json(['status' => false, 'message' => 'დაფიქსირდა შეცდომა გთხოვთ სცადოთ თავიდან !!!']);
        }
    }

    public function ajaxOptionValueDelete(Request $Request) {
        if($Request->isMethod('POST') && !empty($Request->option_value_id)) {

            $ProductOptionValue = new ProductOptionValue();
            $ProductOptionValueData = $ProductOptionValue::find($Request->option_value_id);

            $ProductOptionValueData->update([
                'active' => 0,
                'deleted_at' => Carbon::now(),
                'deleted_at_int' => 0,
            ]);

            $ProductOptionValueList = $ProductOptionValue::where('option_id', $ProductOptionValueData->option_id)->where('deleted_at_int', '!=', 0)->get();

            return Response::json(['status' => true, 'errors' => false, 'message' => 'მომხმარებელი წარმატებით წაიშალა', 'ProductOptionValueList' => $ProductOptionValueList]);

        } else {
            return Response::json(['status' => false, 'message' => 'დაფიქსირდა შეცდომა გთხოვთ სცადოთ თავიდან !!!']);
        }
    }

    public function ajaxOptionValueSortable(Request $Request) {
        if($Request->isMethod('POST')) {
            foreach($Request->option_value_item as $key => $Item) {
                $Sortable = $key + 1;
                $ProductOptionValue = new ProductOptionValue();
                $ProductOptionValue::where('id', intval($Item))->update(['sortable' => intval($Sortable)]);
            }

            return Response::json(['status' => true]);
        } else {
            return Response::json(['status' => false]);
        }
    }

    public function ajaxOptionValueEdit(Request $Request) {
        if($Request->isMethod('GET') && !empty($Request->option_value_id)) {
            $ProductOptionValue = new ProductOptionValue();
            $ProductOptionValueData = $ProductOptionValue::find($Request->option_value_id);

            return Response::json(['status' => true, 'ProductOptionValueData' => $ProductOptionValueData]);
        } else {
            return Response::json(['status' => false, 'message' => 'დაფიქსირდა შეცდომა გთხოვთ სცადოთ თავიდან !!!']);
        }
    }

    public function ajaxOptionValueUpdate(Request $Request) {
        if($Request->isMethod('POST') && !empty($Request->option_value_id)) {
            $messages = array(
                'required' => 'გთხოვთ შეიყვანოთ ყველა აუცილებელი ველი',
            );
            $validator = Validator::make($Request->all(), [
                'name_ge' => 'required|max:255',
            ], $messages);

            if ($validator->fails()) {
                return Response::json(['status' => true, 'errors' => true, 'message' => $validator->getMessageBag()->toArray()], 200);
            } else {
                $Array = ['ge' => $Request->name_ge, 'en' => $Request->name_en];

                $ProductOptionValue = new ProductOptionValue();
                $ProductOptionValue::find($Request->option_value_id)->update([
                    'name' => json_encode($Array),
                ]);
                return Response::json(['status' => true, 'errors' => false, 'message' => 'სახელი წარმატებით შეიცვალა !!!']);
            }
        } else {
            return Response::json(['status' => false, 'message' => 'დაფიქსირდა შეცდომა გთხოვთ სცადოთ თავიდან !!!']);
        }
    }

    public function ajaxGetSubCategoryAndBrandList(Request $Request) {
        if($Request->isMethod('GET') && !empty($Request->category_id)) {
            $ProductCategory = new ProductCategory();
            $ProductChildCategoryList = $ProductCategory::where('parent_id', $Request->category_id)
                                                    ->where('deleted_at_int', '!=', 0)
                                                    ->orderBy('sortable', 'ASC')
                                                    ->get();

            $ProductBrand = new ProductBrand();
            $ProductBrandList = $ProductBrand::where('category_id', $Request->category_id)->where('active', 1)->where('deleted_at_int', '!=', 0)->get();

            return Response::json([
                'status' => true, 
                'ProductChildCategoryList' => $ProductChildCategoryList, 
                'ProductBrandList' => $ProductBrandList
            ]);
        }
    }

    public function ajaxGetBrandByChildCategory(Request $Request) {
        if($Request->isMethod('GET') && !empty($Request->child_category_id)) {
            $ProductBrand = new ProductBrand();
            $ProductBrandList = $ProductBrand::where('child_category_id', $Request->child_category_id)->where('active', 1)->where('deleted_at_int', '!=', 0)->get();

            return Response::json([
                'status' => true, 
                'ProductBrandList' => $ProductBrandList
            ]);
        }
    }
}
