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
                        <h4 class="nk-block-title font-neue">მომხმარებელთა ჩამონათვალი</h4>
                    </div>    
                    <div class="nk-block-head-content">
                        <ul class="nk-block-tools g-3">
                            <li>
                                <a href="javascript:;" id="lfm" class="btn btn-white btn-outline-light">
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