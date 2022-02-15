@extends('layout.layout')

@section('css')

@endsection

@section('content')
<div class="nk-content nk-content-fluid">
    <div class="container-xl wide-xl">
        <div class="nk-content-inner">
            <div class="nk-block-head">
                <div class="nk-block-between">
                    <div class="nk-block-head-content">
                        <h4 class="nk-block-title font-neue">ახალი პროდუქტის დამატება</h4>
                    </div>    
                </div>
            </div>
            <div class="nk-content-body">
                <div class="card card-preview">
                    <div class="row">
                        <div class="col-8">
                            <div class="card-inner">
                                <ul class="nav nav-tabs">
                                    <li class="nav-item"><a class="nav-link active font-neue" data-toggle="tab" href="#basic_parameters">ძირითადი პარამეტრები</a></li>
                                    <li class="nav-item"><a class="nav-link font-neue" data-toggle="tab" href="#product_gallery">პროდუქტის სურათები</a></li>
                                </ul>
                                <form id="product_form" class="tab-content">
                                    <div class="tab-pane active" id="basic_parameters">
                                        <div class="row">
                                            <div class="col-12">
                                                <div class="row">
                                                    <div class="col-12">
                                                        <div class="form-group">
                                                            <label class="form-label" for="product_parent">მშობელი პროდუქტი</label>
                                                            <select class="form-select form-control" data-search="on" name="product_parent" id="product_parent">
                                                                <option value="0"></option>
                                                            </select>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-4 mt-2">
                                                <div class="row">
                                                    <div class="col-12">
                                                        <div class="form-group">
                                                            <label class="form-label" for="product_category">პროდუქტის კატეგორია</label>
                                                            <select class="form-control" name="product_category" id="product_category" onchange="GetSubCategoryAndBrandList()">
                                                                <option value="0"></option>
                                                                @foreach($product_category_list as $category_item)
                                                                <option value="{{ $category_item->id }}">{{ json_decode($category_item->name)->ge }}</option>
                                                                @endforeach
                                                            </select>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-4 mt-2">
                                                <div class="row">
                                                    <div class="col-12">
                                                        <div class="form-group">
                                                            <label class="form-label" for="product_child_category">პროდუქტის ქვეკატეგორია</label>
                                                            <select class="form-control" name="product_child_category" id="product_child_category" disabled onchange="GetBrandByChildCategory()">
                                                                <option value="0"></option>
                                                            </select>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-4 mt-2">
                                                <div class="row">
                                                    <div class="col-12">
                                                        <div class="form-group">
                                                            <label class="form-label" for="product_brand">პროდუქტის ბრენდი</label>
                                                            <select class="form-control" name="product_brand" id="product_brand" disabled>
                                                                <option value="0"></option>
                                                            </select>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="tab-pane" id="product_gallery">
                                         <div class="row">
                                            <div class="col-12">
                                                <div class="row">
                                                    <div class="col-12">
                                                        <div class="form-group">
                                                           <input id="thumbnail" class="form-control" type="text" name="filepath" style="width: 85%; float: left;">
                                                            <a id="lfm" data-input="thumbnail" data-preview="holder" class="btn btn-light font-helvetica-regular" style="max-width: 15%; float: right;">სურათის არჩევა</a>
                                                        </div>
                                                    </div>
                                                    <div class="col-12 mt-2">
                                                        <div class="nk-fmg-quick-list nk-block">
                                                            <div class="toggle-expand-content expanded" data-content="quick-access">
                                                                <div class="nk-files nk-files-view-grid">
                                                                    <div class="nk-files-list">
                                                                        <div class="nk-file-item nk-file">
                                                                            <div class="nk-file-info" id="holder">
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                         </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
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
<script type="text/javascript">
    var route_prefix = "{{ url('filemanager') }}";
    $('#lfm').filemanager('image', {prefix: route_prefix});
</script>
@endsection