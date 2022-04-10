@extends('layout.layout')

@section('css')

@endsection

@section('content')
<div class="nk-content nk-content-fluid">
    <div class="container-xl wide-xl">
        <div class="nk-content-inner">
            <div class="nk-content-body">
                <div class="nk-block-head nk-block-head-sm">
                    <div class="nk-block-between">
                        <div class="nk-block-head-content">
                            <div class="toggle-wrap nk-block-tools-toggle">
                                <a href="#" class="btn btn-icon btn-trigger toggle-expand mr-n1" data-target="pageMenu"><em class="icon ni ni-menu-alt-r"></em></a>
                                <div class="toggle-expand-content" data-content="pageMenu">
                                    <ul class="nk-block-tools g-3">
                                        <li class="nk-block-tools-opt">
                                            <div class="drodown">
                                                <a href="#" class="dropdown-toggle btn btn-icon btn-primary" data-toggle="dropdown"><em class="icon ni ni-plus"></em></a>
                                                <div class="dropdown-menu dropdown-menu-right">
                                                    <ul class="link-list-opt no-bdr font-helvetica-regular">
                                                        <li><a href="{{ route('actionProductsAdd') }}"><span>პროდუქტის დამატება</span></a></li>
                                                    </ul>
                                                </div>
                                            </div>
                                            <div class="dropdown">
                                                <a href="#" class="dropdown-toggle btn btn-light font-helvetica-regular ml-2" data-toggle="dropdown">ნაშთები</a>
                                                <div class="dropdown-menu" style="min-width: 300px;">
                                                    <ul class="link-check font-helvetica-regular">
                                                        <li><span>Excel</span></li>
                                                        <li><a href="javascript:;" onclick="ProductBalanceExport()">
                                                            <em class="icon ni ni-download"></em><span>არსებული ნაშთების ჩამოტვირთვა</span></a>
                                                        </li>
                                                        <li><a href="javascript:;" onclick="ProductBalanceUpload()">
                                                            <em class="icon ni ni-upload"></em><span>ახალი ნაშთების ატვირთვა</span></a>
                                                        </li>
                                                    </ul>
                                                    <ul class="link-check font-helvetica-regular">
                                                        <li class="font-neue"><span>სინქრონიზაცია</span></li>
                                                        <li><a href="#">
                                                            <em class="icon ni ni-reload-alt"></em><span>API NAME</span></a>
                                                        </li>
                                                    </ul>
                                                    <ul class="link-check font-helvetica-regular">
                                                        <li><a href="{{ route('actionProductsBalanceHistory') }}">
                                                            <em class="icon ni ni-file-plus"></em><span>ნაშთების ცვლილების ისტორია</span></a>
                                                        </li>
                                                    </ul>
                                                </div>
                                            </div>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="nk-block">
                    <div class="card card-bordered card-stretch">
                        <div class="card-inner-group">
                            <div class="card-inner position-relative card-tools-toggle">
                                <div class="card-title-group">
                                    <div class="card-tools">
                                        <div class="nk-block-head-content">
                                            <h3 class="nk-block-title page-title font-neue">პროდუქციის ჩამონათვალი</h3>
                                        </div>
                                    </div>
                                    <div class="card-tools mr-n1">
                                        <ul class="btn-toolbar gx-1">
                                            <li>
                                                <div class="toggle-wrap">
                                                    <a href="#" class="btn btn-icon btn-trigger toggle" data-target="cardTools"><em class="icon ni ni-menu-right"></em></a>
                                                    <div class="toggle-content" data-content="cardTools">
                                                        <ul class="btn-toolbar gx-1">
                                                            <li class="toggle-close">
                                                                <a href="#" class="btn btn-icon btn-trigger toggle" data-target="cardTools"><em class="icon ni ni-arrow-left"></em></a>
                                                            </li>
                                                            <li>
                                                                <div class="dropdown">
                                                                    <a href="#" class="btn btn-trigger btn-icon dropdown-toggle" data-toggle="dropdown">
                                                                        <div class="dot dot-primary"></div>
                                                                        <em class="icon ni ni-filter-alt"></em>
                                                                    </a>
                                                                    <div class="filter-wg dropdown-menu dropdown-menu-xl dropdown-menu-right">
                                                                        <div class="dropdown-head">
                                                                            <span class="sub-title dropdown-title font-neue">პროდუქციის ფილტრი</span>
                                                                            <div class="dropdown">
                                                                                <a href="#" class="btn btn-sm btn-icon">
                                                                                    <em class="icon ni ni-more-h"></em>
                                                                                </a>
                                                                            </div>
                                                                        </div>
                                                                        <div class="dropdown-body dropdown-body-rg">
                                                                            <form method="get" class="row gx-6 gy-3">
                                                                                <div class="col-6">
                                                                                    <div class="form-group">
                                                                                        <label class="font-helvetica-regular overline-title overline-title-alt">დასახელება<br></label>
                                                                                        <input type="text" class="form-control" name="search_query">
                                                                                    </div>
                                                                                </div>
                                                                                <div class="col-6">
                                                                                    <div class="form-group">
                                                                                        <label class="font-helvetica-regular overline-title overline-title-alt">კატეგორია</label>
                                                                                        <select class="form-control form-select-sm" name="product_category">
                                                                                            <option value="0"></option>
                                                                                            @foreach($product_category_list as $category_item)
                                                                                            <option value="{{ $category_item->id }}" @if(request()->product_category == $category_item->id) selected @endif>{{ json_decode($category_item->name)->ge }}</option>
                                                                                            @endforeach
                                                                                        </select>
                                                                                    </div>
                                                                                </div>
                                                                                <div class="col-6">
                                                                                    <div class="form-group">
                                                                                        <label class="font-helvetica-regular overline-title overline-title-alt">რაოდენობა<br></label>
                                                                                        <input type="number" class="form-control" name="product_count" value="{{ request()->product_count }}">
                                                                                    </div>
                                                                                </div>
                                                                                <div class="col-6">
                                                                                    <div class="form-group">
                                                                                        <label class="font-helvetica-regular overline-title overline-title-alt">სტატუსი</label>
                                                                                        <select class="form-control form-select-sm" name="product_status">
                                                                                            @foreach($product_statuses as $key => $status)
                                                                                            <option value="{{ $key }}" @if(request()->product_status == $key) selected @endif>{{ $status }}</option>
                                                                                            @endforeach
                                                                                        </select>
                                                                                    </div>
                                                                                </div>
                                                                                <div class="col-6">
                                                                                    <div class="form-group">
                                                                                        <label class="font-helvetica-regular overline-title overline-title-alt">მარაგშია</label>
                                                                                        <select class="form-control form-select-sm" name="in_stock">
                                                                                            @foreach($yes_no as $key => $value)
                                                                                            <option value="{{ $key }}" @if(request()->in_stock == $key) selected @endif>{{ $value }}</option>
                                                                                            @endforeach
                                                                                        </select>
                                                                                    </div>
                                                                                </div>
                                                                                <div class="col-6">
                                                                                    <div class="form-group">
                                                                                        <label class="font-helvetica-regular overline-title overline-title-alt">მდგომარეობა</label>
                                                                                        <select class="form-control form-select-sm" name="product_condition">
                                                                                            @foreach($product_condition as $key => $condition)
                                                                                            <option value="{{ $key }}" @if(request()->product_condition == $key) selected @endif>{{ $condition }}</option>
                                                                                            @endforeach
                                                                                        </select>
                                                                                    </div>
                                                                                </div>
                                                                                <div class="col-12">
                                                                                    <div class="form-group">
                                                                                        <label class="font-helvetica-regular overline-title overline-title-alt">სორტირება</label>
                                                                                        <select class="form-select form-select-sm" name="product_sort">
                                                                                            @foreach($product_sort as $key => $sort)
                                                                                            <option value="{{ $key }}" @if(request()->product_sort == $key) selected @endif>{{ $sort }}</option>
                                                                                            @endforeach
                                                                                        </select>
                                                                                    </div>
                                                                                </div>
                                                                                <div class="col-12">
                                                                                    <div class="form-group">
                                                                                        <button type="submit" class="btn btn-secondary font-neue">გაფილტვრა</button>
                                                                                        <a href="" class="btn btn-primary font-neue">ფილტრის გასუფთავება</a>
                                                                                    </div>
                                                                                </div>
                                                                            </form>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </li>
                                                        </ul>
                                                    </div>
                                                </div>
                                            </li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                            <div class="card-inner">
                                <div class="nk-block">
                                    <div class="card card-bordered card-stretch">
                                        <div class="card-inner p-0">
                                            <div class="nk-tb-list nk-tb-ulist">
                                                <div class="nk-tb-item nk-tb-head font-helvetica-regular">
                                                    <div class="nk-tb-col"><span># პროდუქტის დასახელება</span></div>
                                                    <div class="nk-tb-col tb-col-mb"><span>კატეგორია / ქვეკატეგორია</span></div>
                                                    <div class="nk-tb-col tb-col-md"><span>ბრენდი</span></div>
                                                    <div class="nk-tb-col tb-col-md"><span>ფასი</span></div>
                                                    <div class="nk-tb-col tb-col-lg"><span>დამატების თარიღი</span></div>
                                                    <div class="nk-tb-col tb-col-lg"><span>ნაშთი</span></div>
                                                    <div class="nk-tb-col tb-col-md"><span>სტატუსი</span></div>
                                                    <div class="nk-tb-col nk-tb-col-tools">&nbsp;</div>
                                                </div>
                                                @foreach($product_list as $product_item)
                                                <div class="nk-tb-item font-helvetica-regular">
                                                    <div class="nk-tb-col">
                                                        <div class="user-card">
                                                            <div class="user-info">
                                                                <span class="tb-lead">@if(count($product_item->getProductChild) > 0) <em style="cursor: pointer; font-size: 18px; position: relative; top: 3px;" class="icon ni ni-arrow-down-circle show-child-product" data-parent-id="{{ $product_item->id }}"></em> @endif #{{ $product_item->id }} - {{ $product_item->name_ge }}</span>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="nk-tb-col tb-col-mb">
                                                        <span class="tb-lead-sub">
                                                            {{ json_decode($product_item->getCategoryData->name)->ge }} / {{ json_decode($product_item->getChildCategoryData->name)->ge }}
                                                        </span>
                                                    </div>
                                                    <div class="nk-tb-col tb-col-md">
                                                        <span class="tb-date">
                                                            @if(!empty($product_item->brand_id))
                                                            {{ json_decode($product_item->getBrandData->name)->ge }}
                                                            @endif
                                                        </span>
                                                    </div>
                                                    <div class="nk-tb-col tb-col-lg">
                                                        <span class="tb-date">
                                                            @if(!empty($product_item->getProductPrice->price))
                                                            {{ $product_item->getProductPrice->price / 100 }} ₾
                                                            @endif
                                                            @if(!empty($product_item->discount_price))
                                                            <span class="badge badge-outline-primary" title="ფასდაკლებული თანხა">{{ $product_item->discount_price / 100 }} ₾</span>
                                                            @endif
                                                            @if(!empty($product_item->discount_percent))
                                                            <span class="badge badge-outline-primary" title="ფასდაკლების პროცენტი">{{ $product_item->discount_percent }} %</span>
                                                            @endif
                                                        </span>
                                                    </div>
                                                    <div class="nk-tb-col tb-col-md">
                                                        {{ \Carbon\Carbon::parse($product_item->created_at)->format('Y-m-d') }}
                                                    </div>
                                                    <div class="nk-tb-col tb-col-md">
                                                            <span class="badge badge-success" style="cursor: pointer;" onclick="UpdateProductCount({{ $product_item->id}}, this)">{{ $product_item->count }}</span>
                                                    </div>
                                                    <div class="nk-tb-col tb-col-lg">
                                                        <div class="custom-control custom-switch">
                                                            <input type="checkbox" class="custom-control-input" id="product_active_{{ $product_item->id }}" onclick="ProductActiveChange({{ $product_item->id }}, this)" @if($product_item->active == 1) checked @endif>
                                                            <label class="custom-control-label" for="product_active_{{ $product_item->id }}"></label>
                                                        </div>
                                                    </div>
                                                    <div class="nk-tb-col nk-tb-col-tools">
                                                        <ul class="nk-tb-actions gx-1">
                                                            <li>
                                                                <div class="drodown">
                                                                    <a href="#" class="dropdown-toggle btn btn-icon btn-trigger" data-toggle="dropdown"><em class="icon ni ni-more-h"></em></a>
                                                                    <div class="dropdown-menu dropdown-menu-right" style="min-width: 250px; width: 100%;">
                                                                        <ul class="link-list-opt no-bdr">
                                                                            <li>
                                                                                <a href="{{ route('actionProductsEdit', $product_item->id) }}">
                                                                                    <em class="icon ni ni-dot"></em>
                                                                                    <span>რედაქტირება</span>
                                                                                </a>
                                                                            </li>                                                                                   
                                                                            <li>
                                                                                <a href="javascript:;" onclick="GetProductPhotos({{ $product_item->id }})">
                                                                                    <em class="icon ni ni-dot"></em>
                                                                                    <span>დამატებითი სურათები</span>
                                                                                </a>
                                                                            </li>                                                                              
                                                                            <li>
                                                                                <a href="javascript:;" onclick="ChangeProductStatus({{ $product_item->id }})">
                                                                                    <em class="icon ni ni-dot"></em>
                                                                                    <span>სტატუსის შეცვლა</span>
                                                                                </a>
                                                                            </li>
                                                                            <li>
                                                                                <a href="javascript:;" onclick="ProductDelete({{ $product_item->id }})" class="text-danger">
                                                                                    <em class="icon ni ni-trash"></em>
                                                                                    <span>პროდუქტის წაშლა</span>
                                                                                </a>
                                                                            </li>
                                                                        </ul>
                                                                    </div>
                                                                </div>
                                                            </li>
                                                        </ul>
                                                    </div>
                                                </div>
                                                @if(count($product_item->getProductChild) > 0)
                                                    @foreach($product_item->getProductChild as $product_child_item)
                                                    <div class="nk-tb-item font-helvetica-regular view-child-item-{{ $product_item->id }}" style="background: #f5f5f5; display: none">
                                                        <div class="nk-tb-col">
                                                            <div class="user-card">
                                                                <div class="user-info">
                                                                    <span class="tb-lead"><em class="icon ni ni-arrow-right-circle"></em> #{{ $product_item->id }}-{{ $product_child_item->id }} {{ $product_child_item->name_ge }}</span>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="nk-tb-col tb-col-mb">
                                                            <span class="tb-lead-sub">
                                                                {{ json_decode($product_child_item->getCategoryData->name)->ge }} / {{ json_decode($product_child_item->getChildCategoryData->name)->ge }}
                                                            </span>
                                                        </div>
                                                        <div class="nk-tb-col tb-col-md">
                                                            <span class="tb-date">
                                                                @if(!empty($product_child_item->brand_id))
                                                                {{ json_decode($product_child_item->getBrandData->name)->ge }}
                                                                @endif
                                                            </span>
                                                        </div>
                                                        <div class="nk-tb-col tb-col-lg">
                                                            <span class="tb-date">
                                                                @if(!empty($product_child_item->getProductPrice->price))
                                                                {{ $product_child_item->getProductPrice->price / 100 }} ₾
                                                                @endif
                                                                @if(!empty($product_child_item->discount_price))
                                                                <span class="badge badge-outline-primary" title="ფასდაკლებული თანხა">{{ $product_child_item->discount_price / 100 }} ₾</span>
                                                                @endif
                                                                @if(!empty($product_child_item->discount_percent))
                                                                <span class="badge badge-outline-primary" title="ფასდაკლების პროცენტი">{{ $product_child_item->discount_percent }} %</span>
                                                                @endif
                                                            </span>
                                                        </div>
                                                        <div class="nk-tb-col tb-col-md">
                                                            {{ \Carbon\Carbon::parse($product_child_item->created_at)->format('Y-m-d') }}
                                                        </div>
                                                        <div class="nk-tb-col tb-col-md">
                                                                <span class="badge badge-success" style="cursor: pointer;" onclick="UpdateProductCount({{ $product_child_item->id}}, this)">{{ $product_child_item->count }}</span>
                                                        </div>
                                                        <div class="nk-tb-col tb-col-lg">
                                                            <div class="custom-control custom-switch">
                                                                <input type="checkbox" class="custom-control-input" id="product_active_{{ $product_child_item->id }}" onclick="ProductActiveChange({{ $product_child_item->id }}, this)" @if($product_child_item->active == 1) checked @endif>
                                                                <label class="custom-control-label" for="product_active_{{ $product_child_item->id }}"></label>
                                                            </div>
                                                        </div>
                                                        <div class="nk-tb-col nk-tb-col-tools">
                                                            <ul class="nk-tb-actions gx-1">
                                                                <li>
                                                                    <div class="drodown">
                                                                        <a href="#" class="dropdown-toggle btn btn-icon btn-trigger" data-toggle="dropdown"><em class="icon ni ni-more-h"></em></a>
                                                                        <div class="dropdown-menu dropdown-menu-right" style="min-width: 250px; width: 100%;">
                                                                            <ul class="link-check">
                                                                              <li><span>Show</span></li>
                                                                              <li class="active"><a href="#">10 Items</a></li>
                                                                              <li><a href="#">20 Items</a></li>
                                                                              <li><a href="#">50 Items</a></li>
                                                                            </ul>
                                                                            <ul class="link-check">
                                                                              <li><span class="font-neue">მოქმედება</span></li>
                                                                            </ul>
                                                                        </div>
                                                                    </div>
                                                                </li>
                                                            </ul>
                                                        </div>
                                                    </div>
                                                    @endforeach
                                                @endif
                                                @endforeach
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
</div>
<div class="modal fade" id="BalanceUploadModal" style="display: none;" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title font-neue">პროდუქციის ნაშთების ატვირთვა</h5>
                <a href="#" class="close" data-dismiss="modal" aria-label="Close">
                    <em class="icon ni ni-cross"></em>
                </a>
            </div>
            <div class="modal-body">
                <form action="#" class="form-validate is-alter" novalidate="novalidate" id="balance_upload_form">
                    <div class="form-group">
                        <label class="form-label font-helvetica-regular" for="excel_file">ექსელის ფაილი *</label>
                        <div class="form-control-wrap">
                            <input type="file" class="form-control check-input" name="excel_file" id="excel_file">
                            <small class="excel_file-error text-error text-danger mt-1"></small>
                        </div>
                    </div>
                    <button type="button" class="btn btn-success" onclick="ProductBalanceSubmit()">ატვირთვა</button>
                </form>
            </div>
        </div>
    </div>
</div>
<div class="modal fade" id="CountUploadModal" style="display: none;" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title font-neue">პროდუქციის ნაშთების შეცვლა</h5>
                <a href="#" class="close" data-dismiss="modal" aria-label="Close">
                    <em class="icon ni ni-cross"></em>
                </a>
            </div>
            <div class="modal-body">
                <form action="#" class="form-validate is-alter" novalidate="novalidate" id="product_count_form">
                    <div class="form-group">
                        <label class="form-label font-helvetica-regular" for="product_count">რაოდენობა</label>
                        <div class="form-control-wrap">
                            <input type="number" class="form-control check-input" name="product_count" id="product_count">
                            <input type="hidden" class="form-control check-input" name="product_count_id" id="product_count_id">
                            <small class="product_count-error text-error text-danger mt-1"></small>
                        </div>
                    </div>
                    <button type="button" class="btn btn-success font-helvetica-regular" onclick="ProductCountSubmit()">განახლება</button>
                </form>
            </div>
        </div>
    </div>
</div>
<div class="modal fade" id="ProductPhotoModal" style="display: none;" aria-hidden="true">
    <div class="modal-dialog modal-xl" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title font-neue">ატვირთული დამატებითი სურათები</h5>
                <a href="#" class="close" data-dismiss="modal" aria-label="Close">
                    <em class="icon ni ni-cross"></em>
                </a>
            </div>
            <div class="modal-body">
                <div class="nk-files nk-files-view-grid">
                    <div class="nk-files-list product-photo-body">

                    </div>
                </div>
                <form id="gallery_photo_upload_form" class="row mt-2">
                    <div class="col-sm-12 mt-2">
                        <label class="form-label w-100">დამატებითი რაოდენობა (მაქს 5)</label>
                        <input id="gallery" name="gallery_photo" class="form-control" type="text" style="width: 80%; float: left;">
                        <a id="lfm_gallery" data-input="gallery" data-preview="holder" class="btn btn-light font-helvetica-regular" style="max-width: 20%; float: right;">სურათის არჩევა</a>
                    </div>
                    <div class="col-12 mt-2">
                        <button class="btn btn-success font-helvetica-regular" type="button" onclick="GalleryPhotoUploadSubmit()">სურათების ატვირთვა</button>
                    </div>
                    <input type="hidden" name="gallery_product_id" id="gallery_product_id">
                </form>
            </div>
        </div>
    </div>
</div><div class="modal fade" id="ProductStatusModal" style="display: none;" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title font-neue">პროდუქციის სტატუსის</h5>
                <a href="#" class="close" data-dismiss="modal" aria-label="Close">
                    <em class="icon ni ni-cross"></em>
                </a>
            </div>
            <div class="modal-body">
                <form action="#" class="form-validate is-alter" novalidate="novalidate" id="product_status_form">
                    <div class="form-group">
                        <label class="form-label font-helvetica-regular" for="product_status">სტატუსი</label>
                        <div class="form-control-wrap">
                            <select class="form-control form-select-sm" name="product_status" id="product_status">
                                <option value="0"></option>
                            </select>
                        </div>
                    </div>
                    <button type="button" class="btn btn-success font-helvetica-regular" onclick="ChangeProductStatusSubmit()">განახლება</button>
                </form>
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
    $('#lfm_gallery').filemanager('image', {prefix: route_prefix});
</script>
@endsection