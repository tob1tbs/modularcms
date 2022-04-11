@extends('layout.layout')

@section('css')

@endsection

@section('content')
<div class="nk-content nk-content-fluid">
    <div class="container-xl wide-xl">
        <div class="nk-content-inner">
            <div class="nk-content-body">
                <div class="nk-block nk-block-lg">
                    <form id="basic_parameters_form" class="card card-bordered">
                        <div class="card-inner">
                            <ul class="nav nav-tabs">
                                <li class="nav-item"><a class="nav-link active font-neue" data-toggle="tab" href="#basic_parameters">ზოგადი პარამეტრები</a></li>
                                <li class="nav-item"><a class="nav-link font-neue" data-toggle="tab" href="#contact_info">საკონტაქტო ინფორმაცია</a></li>
                                <li class="nav-item"><a class="nav-link font-neue" data-toggle="tab" href="#social_network">სოციალური ქსელები</a></li>
                                <li class="nav-item"><a class="nav-link font-neue" data-toggle="tab" href="#plugins">პლაგინები</a></li>
                                <li class="nav-item"><a class="nav-link font-neue" data-toggle="tab" href="#seo">SEO</a></li>
                            </ul>
                            <div class="tab-content">
                                <div class="tab-pane active" id="basic_parameters">
                                    @foreach($parameter_list as $parameter_item)
                                    @switch($parameter_item->type)
                                    @case('input')
                                    <div class="row g-3 align-center">
                                        <div class="col-lg-5">
                                            <div class="form-group">
                                                <label class="form-label" for="{{ $parameter_item->key }}">{{ $parameter_item->label }}</label>
                                                <span class="form-note font-helvetica-regular">{{ $parameter_item->snippet }}</span>
                                            </div>
                                        </div>
                                        <div class="col-lg-7">
                                            <div class="form-group">
                                                <div class="form-control-wrap">
                                                    <input type="text" class="form-control" id="{{ $parameter_item->key }}" name="{{ $parameter_item->key }}" value="{{ $parameter_item->value }}" {{ $parameter_item->disabled == 1 ? 'disabled' : '' }}>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    @break
                                    @case('checkbox')
                                    <div class="row g-3 align-center">
                                        <div class="col-lg-5">
                                            <div class="form-group">
                                                <label class="form-label" for="{{ $parameter_item->key }}">{{ $parameter_item->label }}</label>
                                                <span class="form-note font-helvetica-regular">{{ $parameter_item->snippet }}</span>
                                            </div>
                                        </div>
                                        <div class="col-lg-7">
                                            <div class="form-group">
                                                <div class="form-control-wrap">
                                                    <div class="custom-control custom-switch">
                                                        <input type="checkbox" class="custom-control-input font-neue" @if($parameter_item->value == 1) checked @endif name="{{ $parameter_item->key }}" id="{{ $parameter_item->key }}" value="1">
                                                        <label class="custom-control-label" for="{{ $parameter_item->key }}"></label>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    @break
                                    @endswitch
                                    @endforeach
                                </div>
                                <div class="tab-pane" id="contact_info">
                                    @foreach($parameter_info_list as $info_parameter_item)
                                    @switch($info_parameter_item->type)
                                    @case('input')
                                    <div class="row g-3 align-center">
                                        <div class="col-lg-5">
                                            <div class="form-group">
                                                <label class="form-label" for="{{ $info_parameter_item->key }}">{{ $info_parameter_item->label }}</label>
                                                <span class="form-note font-helvetica-regular">{{ $info_parameter_item->snippet }}</span>
                                            </div>
                                        </div>
                                        <div class="col-lg-7">
                                            <div class="form-group">
                                                <div class="form-control-wrap">
                                                    <input type="text" class="form-control" id="{{ $info_parameter_item->key }}" name="info[{{ $info_parameter_item->key }}]" value="{{ $info_parameter_item->value }}">
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    @break
                                    @endswitch
                                    @endforeach
                                </div>
                                <div class="tab-pane" id="social_network">
                                    @foreach($parameter_social_list as $social_parameter_item)
                                    @switch($social_parameter_item->type)
                                    @case('input')
                                    <div class="row g-3 align-center">
                                        <div class="col-lg-5">
                                            <div class="form-group">
                                                <label class="form-label" for="{{ $social_parameter_item->key }}">{{ $social_parameter_item->label }}</label>
                                                <span class="form-note font-helvetica-regular">{{ $social_parameter_item->snippet }}</span>
                                            </div>
                                        </div>
                                        <div class="col-lg-7">
                                            <div class="form-group">
                                                <div class="form-control-wrap">
                                                    <input type="text" class="form-control" id="{{ $social_parameter_item->key }}" name="social[{{ $social_parameter_item->key }}]" value="{{ $social_parameter_item->value }}">
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    @break
                                    @endswitch
                                    @endforeach
                                </div>
                                <div class="tab-pane" id="plugins">
                                    @foreach($parameter_plugin_list as $plugin_parameter_item)
                                    @switch($plugin_parameter_item->type)
                                    @case('input')
                                    <div class="row g-3 align-center">
                                        <div class="col-lg-5">
                                            <div class="form-group">
                                                <label class="form-label" for="{{ $plugin_parameter_item->key }}">{{ $plugin_parameter_item->label }}</label>
                                                <span class="form-note font-helvetica-regular">{{ $plugin_parameter_item->snippet }}</span>
                                            </div>
                                        </div>
                                        <div class="col-lg-7">
                                            <div class="form-group">
                                                <div class="form-control-wrap">
                                                    <input type="text" class="form-control" id="{{ $plugin_parameter_item->key }}" name="plugin[{{ $plugin_parameter_item->key }}]" value="{{ $plugin_parameter_item->value }}" {{ $plugin_parameter_item->disabled == 1 ? 'disabled' : '' }}>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    @break
                                    @endswitch
                                    @endforeach
                                </div>
                                <div class="tab-pane" id="seo">
                                    <ul class="nav nav-tabs">
                                        
                                    </ul>
                                    <div class="tab-content">
                                        
                                    </div>
                                </div>
                            </div>
                            <div class="row g-3 align-center">
                                <div class="col-lg-12">
                                    <div class="form-group">
                                        <label class="form-label font-helvetica-regular">&nbsp;</label>
                                        <div class="form-control-wrap">
                                            <button class="btn btn-success font-helvetica-regular" onclick="BasicParametersSubmit()" type="button" style="height: 36px;">შენახვა</button>
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
@endsection

@section('js')
<script src="{{ url('assets/scripts/parameters_scripts.js') }}"></script>
@endsection