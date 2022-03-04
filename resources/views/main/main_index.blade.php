@extends('layout.layout')

@section('css')

@endsection

@section('content')
<div class="nk-content nk-content-fluid">
    <div class="container-xl wide-xl">
        <div class="nk-content-inner">
            <div class="nk-content-body">
                <div class="row">
                    <div class="col-md-4">
                        <div class="row">
                            <div class="col-md-12 mb-2">
                                <div class="card card-bordered card-full">
                                    <div class="card-inner">
                                        <div class="card-title-group mb-1">
                                            <div class="card-title">
                                                <h6 class="title font-neue">თანხობრივი ბრუნვა</h6>
                                                <p><a href="#" class="font-helvetica-regular">დეტალური სტატისტიკა</a></p>
                                            </div>
                                        </div>
                                        <ul class="nav nav-tabs nav-tabs-card nav-tabs-xs font-helvetica-regular">
                                            <li class="nav-item">
                                                <a class="nav-link active" data-toggle="tab" href="#overview">მიმდინარე თვე</a>
                                            </li>
                                            <li class="nav-item">
                                                <a class="nav-link" data-toggle="tab" href="#thisyear">მიმდინარე წელი</a>
                                            </li>
                                            <li class="nav-item">
                                                <a class="nav-link" data-toggle="tab" href="#alltime">ჯამი</a>
                                            </li>
                                        </ul>
                                        <div class="tab-content mt-0">
                                            <div class="tab-pane active" id="overview">
                                                <div class="invest-ov gy-2">
                                                    <div class="subtitle font-helvetica-regular">მიმდინარე თვის ბრუნვა</div>
                                                    <div class="invest-ov-details">
                                                        <div class="invest-ov-info">
                                                            <div class="title font-helvetica-regular mb-1">მინდინარე თვის შეკვეთების ღირებულება</div>
                                                            <div class="amount">49,395.395 <span class="currency currency-usd">₾</span></div>
                                                        </div>
                                                        <div class="invest-ov-stats">
                                                            <div class="title font-helvetica-regular mb-1">მინდინარე თვის შესრულებული შეკვეთა:</div>
                                                            <div><span class="amount">56</span></div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="tab-pane" id="thisyear">
                                                <div class="invest-ov gy-2">
                                                    <div class="subtitle font-helvetica-regular">მიმდინარე წლის ბრუნვა</div>
                                                    <div class="invest-ov-details">
                                                        <div class="invest-ov-info">
                                                            <div class="title font-helvetica-regular mb-1">მინდინარე წლის შეკვეთების ღირებულება</div>
                                                            <div class="amount">49,395.395 <span class="currency currency-usd">₾</span></div>
                                                        </div>
                                                        <div class="invest-ov-stats">
                                                            <div class="title font-helvetica-regular mb-1">მინდინარე წელს შესრულებული შეკვეთა:</div>
                                                            <div><span class="amount">56</span></div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="tab-pane" id="alltime">
                                                <div class="invest-ov gy-2">
                                                    <div class="subtitle font-helvetica-regular">ჯამური ბრუნვა</div>
                                                    <div class="invest-ov-details">
                                                        <div class="invest-ov-info">
                                                            <div class="title font-helvetica-regular mb-1">შეკვეთების ჯამური ღირებულება</div>
                                                            <div class="amount">49,395.395 <span class="currency currency-usd">₾</span></div>
                                                        </div>
                                                        <div class="invest-ov-stats">
                                                            <div class="title font-helvetica-regular mb-1">შესრულებული შეკვეთა:</div>
                                                            <div><span class="amount">56</span></div>
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
                    <div class="col-md-8">
                        <div class="row">
                            <div class="col-md-12 mb-2">
                                <div class="card card-bordered">
                                    <div class="card-inner border-bottom">
                                        <div class="card-title-group">
                                            <div class="card-title">
                                                <h6 class="title font-neue">ბოლო შეკვეთები</h6>
                                            </div>
                                            <div class="card-tools">
                                                <a href="{{ route('actionOrdersIndex') }}" class="link font-helvetica-regular">ყველა შეკვეთის ნახა</a>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="nk-tb-list">
                                        <div class="nk-tb-item nk-tb-head">
                                            <div class="nk-tb-col"><span>Plan</span></div>
                                            <div class="nk-tb-col tb-col-sm"><span>Who</span></div>
                                            <div class="nk-tb-col tb-col-lg"><span>Date</span></div>
                                            <div class="nk-tb-col"><span>Amount</span></div>
                                            <div class="nk-tb-col tb-col-sm"><span>&nbsp;</span></div>
                                            <div class="nk-tb-col"><span>&nbsp;</span></div>
                                        </div>
                                        <div class="nk-tb-item">
                                            <div class="nk-tb-col">
                                                <div class="align-center">
                                                    <div class="user-avatar user-avatar-sm bg-light">
                                                        <span>P2</span>
                                                    </div>
                                                    <span class="tb-sub ml-2">Dimond <span class="d-none d-md-inline">- Daily 8.52% for 14 Days</span></span>
                                                </div>
                                            </div>
                                            <div class="nk-tb-col tb-col-sm">
                                                <div class="user-card">
                                                    <div class="user-avatar user-avatar-xs bg-azure-dim">
                                                        <span>VA</span>
                                                    </div>
                                                    <div class="user-name">
                                                        <span class="tb-lead">Victoria Aguilar</span>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="nk-tb-col tb-col-lg">
                                                <span class="tb-sub">18/10/2019</span>
                                            </div>
                                            <div class="nk-tb-col">
                                                <span class="tb-sub tb-amount">1.094780 <span>BTC</span></span>
                                            </div>
                                            <div class="nk-tb-col tb-col-sm">
                                                <span class="tb-sub text-success">Completed</span>
                                            </div>
                                            <div class="nk-tb-col nk-tb-col-action">
                                                <div class="dropdown">
                                                    <a class="text-soft dropdown-toggle btn btn-sm btn-icon btn-trigger" data-toggle="dropdown"><em class="icon ni ni-chevron-right"></em></a>
                                                    <div class="dropdown-menu dropdown-menu-right dropdown-menu-xs">
                                                        <ul class="link-list-plain">
                                                            <li><a href="#">View</a></li>
                                                            <li><a href="#">Invoice</a></li>
                                                            <li><a href="#">Print</a></li>
                                                        </ul>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="card card-bordered card-full">
                                    <div class="card-inner-group">
                                        <div class="card-inner">
                                            <div class="card-title-group">
                                                <div class="card-title">
                                                    <h6 class="title font-neue">ბოლოს დარეგისტრირდნენ</h6>
                                                </div>
                                                <div class="card-tools">
                                                    <a href="html/user-list-regular.html" class="link font-helvetica-regular">სრული სია</a>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="card-inner card-inner-md">
                                            <div class="user-card">
                                                <div class="user-avatar bg-primary-dim">
                                                    <span>AB</span>
                                                </div>
                                                <div class="user-info">
                                                    <span class="lead-text">Abu Bin Ishtiyak</span>
                                                    <span class="sub-text">info@softnio.com</span>
                                                </div>
                                                <div class="user-action">
                                                    <div class="drodown">
                                                        <a href="#" class="dropdown-toggle btn btn-icon btn-trigger mr-n1" data-toggle="dropdown" aria-expanded="false"><em class="icon ni ni-more-h"></em></a>
                                                        <div class="dropdown-menu dropdown-menu-right">
                                                            <ul class="link-list-opt no-bdr">
                                                                <li><a href="#"><em class="icon ni ni-setting"></em><span>Action Settings</span></a></li>
                                                                <li><a href="#"><em class="icon ni ni-notify"></em><span>Push Notification</span></a></li>
                                                            </ul>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-8 mb-2">
                                <div class="card card-bordered card-full">
                                    <div class="card-inner">
                                        <div class="card-title-group">
                                            <div class="card-title">
                                                <h6 class="title font-neue">
                                                    <span class="mr-2">ბოლო ტრანზაქციები</span> 
                                                    <a href="#" class="link d-none d-sm-inline font-helvetica-regular">სრული სია</a>
                                                </h6>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="card-inner p-0 border-top">
                                        <div class="nk-tb-list nk-tb-orders">
                                            <div class="nk-tb-item nk-tb-head font-helvetica-regular">
                                                <div class="nk-tb-col"><span>შეკვეთის ნომერი</span></div>
                                                <div class="nk-tb-col tb-col-sm"><span>მომხმარებელი</span></div>
                                                <div class="nk-tb-col tb-col-md"><span>თარიღი</span></div>
                                                <div class="nk-tb-col"><span>თანხა</span></div>
                                                <div class="nk-tb-col"><span>სტატუსი</span></div>
                                            </div>
                                            <div class="nk-tb-item">
                                                <div class="nk-tb-col">
                                                    <span class="tb-lead"><a href="#">#95954</a></span>
                                                </div>
                                                <div class="nk-tb-col tb-col-sm">
                                                    <div class="user-card">
                                                        <div class="user-name">
                                                            <span class="tb-lead">Abu Bin Ishtiyak</span>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="nk-tb-col tb-col-md">
                                                    <span class="tb-sub">02/11/2020</span>
                                                </div>
                                                <div class="nk-tb-col">
                                                    <span class="tb-sub tb-amount">4,596.75 <span>USD</span></span>
                                                </div>
                                                <div class="nk-tb-col">
                                                    <span class="badge badge-dot badge-dot-xs badge-success font-helvetica-regular">გადახდილია</span>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="card-inner-sm border-top text-center d-sm-none">
                                        <a href="#" class="btn btn-link btn-block">See History</a>
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
@endsection

@section('js')

@endsection