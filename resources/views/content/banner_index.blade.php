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
                        <h4 class="nk-block-title font-neue">სურათების ჩამონათვალი</h4>
                    </div>    
                    <div class="nk-block-head-content">
                        <ul class="nk-block-tools g-3">
                            <li>
                                <a href="javascript:;" onclick="AddNewPhoto()" class="btn btn-white btn-outline-light">
                                    <em class="icon ni ni-plus"></em>
                                    <span class="font-helvetica-regular">ახალი სურათი</span>
                                </a>
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
                                    <div class="nk-tb-col"><span># სურათი</span></div>
                                    <div class="nk-tb-col tb-col-md"><span>სტატუსი</span></div>
                                    <div class="nk-tb-col nk-tb-col-tools">&nbsp;</div>
                                </div>
                                @foreach($banner_list as $banner_item)
                                <div class="nk-tb-item font-helvetica-regular">
                                    <div class="nk-tb-col">
                                        <div class="user-avatar sq xl">
                                            <img src="{{ $banner_item->path }}" alt="">
                                        </div>
                                    </div>
                                    <div class="nk-tb-col tb-col-lg">
                                        <div class="custom-control custom-switch">
                                            <input type="checkbox" class="custom-control-input" id="product_active_{{ $banner_item->id }}" onclick="BannerActiveChange({{ $banner_item->id }}, this)" @if($banner_item->active == 1) checked @endif>
                                            <label class="custom-control-label" for="product_active_{{ $banner_item->id }}"></label>
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
                                                                <a href="javascript:;" onclick="ViewBannerPhoto({{ $banner_item->id }})">
                                                                    <em class="icon ni ni-dot"></em>
                                                                    <span>სურათის ნახვა</span>
                                                                </a>
                                                            </li>
                                                            <li>
                                                                <a href="javascript:;" onclick="DeleteBannerPhoto({{ $banner_item->id }})" class="text-danger">
                                                                    <em class="icon ni ni-trash"></em>
                                                                    <span>სურათის წაშლა</span>
                                                                </a>
                                                            </li>
                                                        </ul>
                                                    </div>
                                                </div>
                                            </li>
                                        </ul>
                                    </div>
                                </div>
                                @endforeach
                            </div>
                        </div>
                    </div>
                </div>                         
            </div>                         
        </div>
    </div>
</div>  
<style type="text/css">
    .nk-files-view-grid .nk-file {
        width: calc(33.33% - 16px);
    }
</style>
<div class="modal fade" id="BannerPhotoUpload" style="display: none;" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title font-neue">პროდუქციის ნაშთების ატვირთვა</h5>
                <a href="#" class="close" data-dismiss="modal" aria-label="Close">
                    <em class="icon ni ni-cross"></em>
                </a>
            </div>
            <div class="modal-body">
                <ul class="nav nav-tabs">
                    <li class="nav-item"><a class="nav-link active font-neue" data-toggle="tab" href="#basic_parameters">ზოგადი პარამეტრები</a></li>
                    <li class="nav-item"><a class="nav-link font-neue" data-toggle="tab" href="#contact_info">საკონტაქტო ინფორმაცია</a></li>
                    <li class="nav-item"><a class="nav-link font-neue" data-toggle="tab" href="#social_network">სოციალური ქსელები</a></li>
                    <li class="nav-item"><a class="nav-link font-neue" data-toggle="tab" href="#plugins">პლაგინები</a></li>
                    <li class="nav-item"><a class="nav-link font-neue" data-toggle="tab" href="#seo">SEO</a></li>
                </ul>
                <div class="tab-content">
                    <div class="tab-pane active">
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('js')
<script type="text/javascript" src="{{ url('assets/js/jquery-ui.min.js') }}"></script>
<script src="{{ url('assets/scripts/slider_scripts.js') }}"></script>
<script src="/vendor/laravel-filemanager/js/stand-alone-button.js"></script>
<script type="text/javascript">
    var route_prefix = "{{ url('filemanager') }}";
    $('#lfm').filemanager('image', {prefix: route_prefix});
</script>
@endsection