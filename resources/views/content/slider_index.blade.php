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
                                    <div class="nk-tb-col tb-col-md"><span>ბანერი</span></div>
                                    <div class="nk-tb-col tb-col-md"><span>სტატუსი</span></div>
                                    <div class="nk-tb-col nk-tb-col-tools">&nbsp;</div>
                                </div>
                                @foreach($slider_list as $slider_item)
                                <div class="nk-tb-item font-helvetica-regular">
                                    <div class="nk-tb-col">
                                        <div class="user-avatar sq xl">
                                            <img src="{{ $slider_item->path }}" alt="">
                                        </div>
                                    </div>
                                    <div class="nk-tb-col tb-col-lg">
                                        <div class="custom-control custom-switch">
                                            <input type="checkbox" class="custom-control-input" id="photo_is_banner_{{ $slider_item->id }}" onclick="ProductActiveChange({{ $slider_item->id }}, this)" @if($slider_item->is_banner == 1) checked @endif>
                                            <label class="custom-control-label" for="photo_is_banner_{{ $slider_item->id }}"></label>
                                        </div>
                                    </div>
                                    <div class="nk-tb-col tb-col-lg">
                                        <div class="custom-control custom-switch">
                                            <input type="checkbox" class="custom-control-input" id="slider_active_{{ $slider_item->id }}" onclick="ProductActiveChange({{ $slider_item->id }}, this)" @if($slider_item->active == 1) checked @endif>
                                            <label class="custom-control-label" for="slider_active_{{ $slider_item->id }}"></label>
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
                                                                <a href="javascript:;" onclick="ViewSliderPhoto({{ $slider_item->id }})">
                                                                    <em class="icon ni ni-dot"></em>
                                                                    <span>სურათის ნახვა</span>
                                                                </a>
                                                            </li>
                                                            <li>
                                                                <a href="javascript:;" onclick="DeleteSliderPhoto({{ $slider_item->id }})" class="text-danger">
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
<div class="modal fade" id="SliderPhotoUpload" style="display: none;" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content modal-xl">
            <div class="modal-header">
                <h5 class="modal-title font-neue">სურათების ატვირთვა</h5>
                <a href="#" class="close" data-dismiss="modal" aria-label="Close">
                    <em class="icon ni ni-cross"></em>
                </a>
            </div>
            <div class="modal-body">
                <form id="slider_form" class="row">
                    <div class="col-12 mb-3 mb-2">
                        <label class="form-label">სურათი</label>
                        <div class="form-group">
                            <input id="slider_photo" name="slider_photo" class="form-control check-input" type="text" style="width: 65%; float: left;">
                            <a id="lfm" data-input="slider_photo" data-preview="holder" class="btn btn-light font-helvetica-regular" style="max-width: 35%; float: right;">სურათის არჩევა</a>
                        </div>
                    </div>
                    <div class="col-lg-6 mb-2">
                        <label class="form-label">ტექსტი 1 (ქართულად)</label>
                        <div class="form-group">
                            <input id="slider_small_text_ge" name="slider_small_text_ge" class="form-control check-input" type="text">
                        </div>
                    </div>
                    <div class="col-lg-6 mb-2">
                        <label class="form-label">ტექსტი 1 (ინგლისურად)</label>
                        <div class="form-group">
                            <input id="slider_small_text_en" name="slider_small_text_en" class="form-control" type="text">
                        </div>
                    </div>
                    <div class="col-lg-6 mb-2">
                        <label class="form-label">ტექსტი 2 (ქართულად)</label>
                        <div class="form-group">
                            <input id="slider_big_text_ge" name="slider_big_text_ge" class="form-control check-input" type="text">
                        </div>
                    </div>
                    <div class="col-lg-6 mb-2">
                        <label class="form-label">ტექსტი 2 (ინგლისურად)</label>
                        <div class="form-group">
                            <input id="slider_big_text_en" name="slider_big_text_en" class="form-control" type="text">
                        </div>
                    </div>
                    <div class="col-lg-12 mb-2">
                        <label class="form-label">URL</label>
                        <div class="form-group">
                            <input id="slider_url" name="slider_url" class="form-control" type="text">
                        </div>
                    </div>
                    <div class="col-lg-12 mb-2">
                        <label class="form-label">ბენერი</label>
                        <div class="form-group">
                            <div class="custom-control custom-switch">
                                <input type="checkbox" class="custom-control-input" id="is_slider" name="is_slider">
                                <label class="custom-control-label" for="is_slider"></label>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-12 mt-2">
                        <button class="btn btn-success font-neue" type="button" onclick="SliderSubmit()">შენახვა</button>
                    </div>
                    <input type="hidden" name="slider_id" id="slider_id">
                </form>
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