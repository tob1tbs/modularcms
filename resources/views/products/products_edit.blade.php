@extends('layout.layout')

@section('css')
<link rel="stylesheet" href="{{ url('assets/css/editors/summernote.css') }}" />
@endsection

@section('content')
<div class="nk-content nk-content-fluid">
    <div class="container-xl wide-xl">
        <div class="nk-content-inner">
            <div class="nk-block-head">
                <div class="nk-block-between">
                    <div class="nk-block-head-content">
                        <h4 class="nk-block-title font-neue">პროდუქტის რედაქტირება</h4>
                    </div>    
                </div>
            </div>
            <div class="nk-content-body card-bordered">
                <div class="card card-preview">
                    <form id="product_form" class="row">
                        <div class="col-lg-8">
                            <div class="card-inner">
                                <ul class="nav nav-tabs">
                                    <li class="nav-item"><a class="nav-link active font-neue" data-toggle="tab" href="#basic_parameters">ძირითადი პარამეტრები</a></li>
                                    <li class="nav-item"><a class="nav-link font-neue" data-toggle="tab" href="#product_gallery">პროდუქტის სურათები</a></li>
                                    <li class="nav-item"><a class="nav-link font-neue" data-toggle="tab" href="#product_parameters">პროდუქტის დამატებითი პარამეტრები</a></li>
                                    <li class="nav-item"><a class="nav-link font-neue" data-toggle="tab" href="#product_seo">SEO</a></li>
                                </ul>
                                <div class="tab-content">
                                    <div class="tab-pane active" id="basic_parameters">
                                        <div class="row">
                                            <div class="col-10 mt-2">
                                                <div class="form-group">
                                                    <label class="form-label" for="product_parent">მშობელი პროდუქტი</label>
                                                    <select class="form-control" name="product_parent" id="product_parent">
                                                        <option value="0"></option>
                                                        @foreach($product_list as $product_item)
                                                        <option value="{{ $product_item->id }}" @if($product_data->parent_id == $product_item->id) selected @endif>{{ $product_item->name_ge }}</option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="col-2">
                                                <button type="button" class="btn btn-success float-right font-helvetica-regular" style="font-size: 12px; margin-top: 43px;" onclick="ImportParentProduct()">მონაცემთა იმპორტი</button>
                                            </div>
                                            <div class="col-4 mt-2">
                                                <div class="form-group">
                                                    <label class="form-label" for="product_category">პროდუქტის კატეგორია</label>
                                                    <select class="form-control check-input" name="product_category" id="product_category" onchange="GetSubCategoryAndBrandList() ">
                                                        <option value="0"></option>
                                                        @foreach($product_category_list as $category_item)
                                                        <option value="{{ $category_item->id }}" @if($product_data->category_id == $category_item->id) selected @endif>{{ json_decode($category_item->name)->ge }}</option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="col-4 mt-2">
                                                <div class="form-group">
                                                    <label class="form-label" for="product_child_category">პროდუქტის ქვეკატეგორია</label>
                                                    <select class="form-control" name="product_child_category" id="product_child_category"  disabled onchange="GetBrandByChildCategory()">
                                                        <option value="0"></option>
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="col-4 mt-2">
                                                <div class="form-group">
                                                    <label class="form-label" for="product_brand">პროდუქტის ბრენდი</label>
                                                    <select class="form-control" name="product_brand" id="product_brand" disabled>
                                                        <option value="0"></option>
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="col-12 mt-2">
                                                <div class="form-group">
                                                    <label class="form-label" for="product_name_ge">პროდუქტის დასახელება (ქართულად)</label>
                                                    <input type="text" name="product_name_ge" id="product_name_ge" class="form-control check-input" value="{{ $product_item->name_ge }}">
                                                </div>
                                            </div>
                                            <div class="col-12 mt-2">
                                                <div class="form-group">
                                                    <label class="form-label" for="product_description_ge">პროდუქტის აღწერა (ქართულად)</label>
                                                    <textarea class="summernote check-input" name="product_description_ge" id="product_description_ge">{{ json_decode($product_item->description)->ge }}</textarea>
                                                </div>
                                            </div>
                                            <div class="col-12 mt-2">
                                                <div class="form-group">
                                                    <label class="form-label" for="product_brand">პროდუქტის დასახელება (ინგლისურად)</label>
                                                    <input type="text" name="product_name_en" id="product_name_en" class="form-control" value="{{ $product_item->name_en }}">
                                                </div>
                                            </div>
                                            <div class="col-12 mt-2">
                                                <div class="form-group">
                                                    <label class="form-label" for="product_description_en">პროდუქტის აღწერა (ინგლისურად)</label>
                                                    <textarea class="summernote" name="product_description_en" id="product_description_en">{{ json_decode($product_item->description)->en }}</textarea>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="tab-pane" id="product_gallery">
                                        <div class="row">
                                            <div class="col-12">
                                                <label class="form-label">პროდუქტის სურათი</label>
                                                <div class="form-group">
                                                    <input id="product_photo" name="product_photo" class="form-control" type="text" style="width: 85%; float: left;" value="{{ $product_data->photo }}">
                                                    <a id="lfm" data-input="product_photo" data-preview="holder" class="btn btn-light font-helvetica-regular" style="max-width: 15%; float: right;">სურათის არჩევა</a>
                                                </div>
                                            </div>
                                            <div class="col-sm-12 mt-2">
                                                <label class="form-label">დამატებითი რაოდენობა (მაქს 5)</label>
                                                <input id="gallery" name="gallery_photo" class="form-control" type="text" style="width: 85%; float: left;">
                                                <a id="lfm_gallery" data-input="gallery" data-preview="holder" class="btn btn-light font-helvetica-regular" style="max-width: 15%; float: right;">სურათის არჩევა</a>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="tab-pane" id="product_parameters">
                                        <div class="row">
                                            <div class="col-12">
                                                <div class="alert alert-fill alert-warning alert-icon font-helvetica-regular">
                                                    <em class="icon ni ni-alert-circle"></em> 
                                                    პარამეტრების სანახავად გთხოვთ აირჩით პროდუქტის კატეგორია.
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="tab-pane" id="product_seo">
                                        <div class="row">
                                            <div class="col-lg-6 mt-2">
                                                <div class="form-group">
                                                    <label class="form-label" for="product_meta_keywords_ge">პროდუქტის მეტა KEYWORDS (ქართულად)</label>
                                                    <input type="text" name="product_meta_keywords_ge" id="product_meta_keywords_ge" class="form-control check-input" value="{{ json_decode($product_data->productMeta->keywords)->ge }}">
                                                </div>
                                            </div>
                                            <div class="col-lg-6 mt-2">
                                                <div class="form-group">
                                                    <label class="form-label" for="product_meta_keywords_en">პროდუქტის მეტა KEYWORDS (ინგლისურად)</label>
                                                    <input type="text" name="product_meta_keywords_en" id="product_meta_keywords_en" class="form-control" value="{{ json_decode($product_data->productMeta->keywords)->en }}">
                                                </div>
                                            </div>
                                            <div class="col-lg-6 mt-2">
                                                <div class="form-group">
                                                    <label class="form-label" for="product_meta_description_ge">პროდუქტის მეტა DESCRIPTION (ქართულად)</label>
                                                    <input type="text" name="product_meta_description_ge" id="product_meta_description_ge" class="form-control check-input" value="{{ json_decode($product_data->productMeta->description)->ge }}">
                                                </div>
                                            </div>
                                            <div class="col-lg-6 mt-2">
                                                <div class="form-group">
                                                    <label class="form-label" for="product_meta_description_en">პროდუქტის მეტა DESCRIPTION (ინგლისურად)</label>
                                                    <input type="text" name="product_meta_description_en" id="product_meta_description_en" class="form-control" value="{{ json_decode($product_data->productMeta->description)->en }}">
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-4">
                            <div class="card-inner">
                                <div class="row">
                                    <div class="col-12">
                                        <div class="form-group">
                                            <label class="form-label" for="product_status">პროდუქტის სტატუსი</label>
                                            <select class="form-control" name="product_status" id="product_status">
                                                @foreach($product_status as $status_item)
                                                <option value="{{ $status_item->id }}" @if($product_data->status == $status_item->id) selected @endif>{{ $status_item->name }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-12 mt-2">
                                        <div class="form-group">
                                            <label class="form-label" for="product_vendor">პროდუქტის მომწოდებელი</label>
                                            <select class="form-control" name="product_vendor" id="product_vendor">
                                                @foreach($product_vendor_list as $vendor_item)
                                                <option value="{{ $vendor_item->id }}" @if($product_data->vendor_id == $vendor_item->id) selected @endif>{{ $vendor_item->name }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-12 mt-2">
                                        <div class="form-group">
                                            <label class="form-label" for="product_price">პროდუქტის ღირებულება</label>
                                            <input type="number" name="product_price" id="product_price" class="form-control check-input" value="@if(!empty($product_data->getProductPrice)){{ $product_data->getProductPrice['0']->price / 100 }}@else 0 @endif">
                                        </div>
                                    </div>
                                    <div class="col-6 mt-2">
                                        <div class="form-group">
                                            <label class="form-label" for="product_discount_price">პროდუქტის ფასდაკლების თანხა</label>
                                            <input type="number" name="product_discount_price" id="product_discount_price" class="form-control" value="{{ $product_data->discount_price / 100 }}">
                                        </div>
                                    </div>
                                    <div class="col-6 mt-2">
                                        <div class="form-group">
                                            <label class="form-label" for="product_discount_percent">პროდუქტის ფასდაკლების %</label>
                                            <input type="number" name="product_discount_percent" id="product_discount_percent" class="form-control" value="{{ $product_data->discount_percent }}">
                                        </div>
                                    </div>
                                    <div class="col-4 mt-2">
                                        <div class="custom-control custom-switch">
                                            <input type="checkbox" class="custom-control-input" name="product_in_stock" value="1" id="product_in_stock" @if($product_data->stock == 1) checked @endif>
                                            <label class="custom-control-label form-label" for="product_in_stock">მარაგშია</label>
                                        </div>
                                    </div>
                                    <div class="col-4 mt-2">
                                        <div class="custom-control custom-switch">
                                            <input type="checkbox" class="custom-control-input" name="product_preorder" value="1" id="product_preorder" @if($product_data->preorder == 1) checked @endif>
                                            <label class="custom-control-label form-label" for="product_preorder">წინასწარი შეკვეთით</label>
                                        </div>
                                    </div>
                                    <div class="col-4 mt-2">
                                        <div class="custom-control custom-switch">
                                            <input type="checkbox" class="custom-control-input" name="product_used" value="1" id="product_used" @if($product_data->used == 1) checked @endif>
                                            <label class="custom-control-label form-label" for="product_used">მეორადი</label>
                                        </div>
                                    </div>
                                    <div class="col-12 mt-2">
                                        <button class="btn btn-success font-neue" type="button" onclick="ProductSubmit()">შენახვა</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <input type="hidden" name="product_count" id="product_count" class="form-control" value="{{ $product_data->count }}">
                        <input type="hidden" name="product_id" id="product_id" value="{{ $product_data->id }}">
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>  
@endsection

@section('js')
<script type="text/javascript" src="{{ url('assets/js/jquery-ui.min.js') }}"></script>
<script src="{{ url('assets/scripts/products_scripts.js') }}"></script>
<script src="/vendor/laravel-filemanager/js/stand-alone-button.js"></script>
<script src="{{ url('assets/js/libs/editors/summernote.js') }}"></script>
<script src="{{ url('assets/js/editors.js') }}"></script>
<script type="text/javascript">
    var route_prefix = "{{ url('filemanager') }}";
    $('#lfm').filemanager('image', {prefix: route_prefix});
    $('#lfm_gallery').filemanager('image', {prefix: route_prefix});

    $(document).ready(function() {
        $('.summernote').summernote();
        $.ajax({
            dataType: 'json',
            url: "/products/ajax/get/subcategoriesbrands",
            type: "GET",
            data: {
                category_id: $("#product_category").val(),
            },
            success: function(data) {
                if(data['status'] == true) {
                    if(data['ProductBrandList'].length > 0) {
                        $("#product_brand").html('');
                        brand_html = '';
                        $.each(data['ProductBrandList'], function(key, value) {
                            @if(isset($product_item->brand_id) && !empty($product_item->brand_id))
                                if (value['id'] == {!! $product_item->brand_id !!}) {
                                    var selected_brand = 'selected';
                                } else {
                                    var selected_brand = '';
                                }
                            @else 
                                var selected_brand = '';
                            @endif
                            brand_html += `<option value="`+value['id']+`" `+selected_brand+`>`+JSON.parse(value['name'])['ge']+`</option>`;
                        });
                        $("#product_brand").append(brand_html);
                        $("#product_brand").removeAttr('disabled');
                    } else {
                        $("#product_brand").html('');
                        $("#product_brand").attr('disabled', 'true');
                    }

                    if(data['ProductChildCategoryList'].length > 0) {
                        $("#product_child_category").html('');
                        category_html = '';
                        $.each(data['ProductChildCategoryList'], function(key, value) {
                            @if(isset($product_item->child_category_id) && !empty($product_item->child_category_id))
                                if (value['id'] == {!! $product_item->child_category_id !!}) {
                                    var selected_child_category = 'selected';
                                } else {
                                    var selected_child_category = '';
                                }
                            @else 
                                var selected_child_category = '';
                            @endif
                            category_html += `<option value="`+value['id']+`" `+selected_child_category+`>`+JSON.parse(value['name'])['ge']+`</option>`;
                        });
                        $("#product_child_category").append(category_html);
                        $("#product_child_category").removeAttr('disabled');
                    } else {
                        $("#product_child_category").html('');
                        $("#product_child_category").attr('disabled', 'true');
                    }

                    if(Object.keys(data['ProductOptionArray']).length > 0) {
                        $("#product_parameters > .row").html('');
                        $.each(data['ProductOptionArray'], function(key, value) {
                            option_html = '';
                            switch (value['type']) {
                                case 'input':
                                    option_html += `
                                    <div class="col-4 mt-2">
                                        <div class="form-group">
                                            <label class="form-label" for="`+key+`">`+value['name']+`</label>
                                            <input type="text" name="product_option[`+key+`]" id="`+key+`" class="form-control">
                                            <input type="hidden" name="product_option_id[`+key+`]" value="`+value['id']+`">
                                        </div>
                                    </div>
                                    `;
                                break;
                                case 'select':
                                    select_html = '<option value="0"></option>';
                                    $.each(value['options'], function(select_key, select_value) {
                                        select_html += `
                                        <option value="`+select_key+`">`+select_value['name']+`</option>
                                        `;
                                    });
                                    option_html += `
                                    <div class="col-4 mt-2">
                                        <div class="form-group">
                                            <label class="form-label" for="`+key+`">`+value['name']+`</label>
                                            <select class="form-control" name="product_option[`+key+`]" id="`+key+`">
                                            `+select_html+`
                                            </select>
                                            <input type="hidden" name="product_option_id[`+key+`]" value="`+value['id']+`">
                                        </div>
                                    </div>
                                    `;
                                break;
                                default:
                                option_html += "";
                            }
                            $("#product_parameters > .row").append(option_html);
                        });
                    } else {
                        $("#product_parameters > .row").html(`
                            <div class="col-12">
                                <div class="alert alert-fill alert-warning alert-icon font-helvetica-regular">
                                    <em class="icon ni ni-alert-circle"></em> 
                                    აღნიშნულ კატეგორიაში არ არი პარამეტრები
                                </div>
                            </div>
                        `);    
                    }
                } else {
                    $("#product_brand, #product_child_category").html('');
                    $("#product_brand, #product_child_category").attr('disabled', 'true');
                    $("#product_parameters > .row").html(`
                        <div class="col-12">
                            <div class="alert alert-fill alert-warning alert-icon font-helvetica-regular">
                                <em class="icon ni ni-alert-circle"></em> 
                                პარამეტრების სანახავად გთხოვთ აირჩით პროდუქტის კატეგორია.
                            </div>
                        </div>
                    `);    
                }
            }
        });
    });
</script>
@endsection