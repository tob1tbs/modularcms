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
                        <h4 class="nk-block-title font-neue">ახალი შეკვეთის დამატება</h4>
                    </div>    
                </div>
            </div>
            <div class="nk-content-body card-bordered">
                <div class="card card-preview">
                    <form id="product_form" class="row">
                        <div class="col-lg-8">
                            <div class="card-inner">
                                <ul class="nav nav-tabs">
                                    <li class="nav-item"><a class="nav-link active font-neue" data-toggle="tab" href="#user_info">მომხმარებლის ინფორმაცია</a></li>
                                    <li class="nav-item"><a class="nav-link font-neue" data-toggle="tab" href="#product_data">პროდუქტციის არჩევა</a></li>
                                    <li class="nav-item"><a class="nav-link font-neue" data-toggle="tab" href="#delivery_parameters">მიწოდების პარამეტრები</a></li>
                                    <li class="nav-item"><a class="nav-link font-neue" data-toggle="tab" href="#payment">გადახდა</a></li>
                                </ul>
                                <div class="tab-content">
                                    <div class="tab-pane active" id="user_info">
                                        <div class="row">
                                            <div class="col-10 mt-2">
                                                <div class="form-group">
                                                    <label class="form-label" for="customer_type">მომხმარებლის ტიპი</label>
                                                    <select class="form-control" name="customer_type" id="customer_type">
                                                        <option value="1">ფიზიკური პირი</option>
                                                        <option value="2">იურიდიული პირი</option>
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="col-2">
                                                <button type="button" class="btn btn-success float-right font-helvetica-regular" style="font-size: 12px; margin-top: 43px;" onclick="ImportUsersList()">მონაცემთა იმპორტი</button>
                                            </div>
                                            <div class="col-12">
                                                <div class="row mt-2" class="company-import" style="display: none;">
                                                    <div class="col-10">
                                                        <div class="form-group">
                                                            <label class="form-label" for="customer_list">კომპანიის საიდენტიფიკაციო კოდი</label>
                                                            <input type="text" class="form-control check-input" name="company_name" id="company_name">
                                                        </div>
                                                    </div>
                                                    <div class="col-2">
                                                        <button type="button" class="btn btn-success float-right font-helvetica-regular" style="font-size: 12px; margin-top: 31px;" onclick="ImportUsersList()">მონაცემთა იმპორტი</button>
                                                    </div>
                                                </div>
                                                <div class="row mt-2" class="customer-import">
                                                    <div class="col-10">
                                                        <div class="form-group">
                                                            <label class="form-label" for="customer_list">მომხმარებლის პირადი ნომერი</label>
                                                            <input type="text" class="form-control check-input" name="company_name" id="company_name">
                                                        </div>
                                                    </div>
                                                    <div class="col-2">
                                                        <button type="button" class="btn btn-success float-right font-helvetica-regular" style="font-size: 12px; margin-top: 31px;" onclick="ImportUsersList()">მონაცემთა იმპორტი</button>
                                                    </div>
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

                                </div>
                            </div>
                        </div>
                        <input type="hidden" name="order_id" id="order_id">
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>  
@endsection

@section('js')
<script type="text/javascript" src="{{ url('assets/js/jquery-ui.min.js') }}"></script>
<script src="{{ url('assets/scripts/orders_scripts.js') }}"></script>
@endsection
