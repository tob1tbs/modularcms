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
                                <a href="javascript:;" class="btn btn-white btn-outline-light">
                                    <em class="icon ni ni-plus"></em>
                                    <span class="font-helvetica-regular">ახალი სურათი</span>
                                </a>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
            <div class="card card-preview">
                <div class="card-inner">
                    <div class="toggle-expand-content expanded" data-content="quick-access">
                        <div class="nk-files nk-files-view-grid">
                            <div class="nk-files-list">

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