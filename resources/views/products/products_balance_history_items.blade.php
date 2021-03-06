@extends('layout.layout')

@section('css')

@endsection

@section('content')
<div class="nk-content nk-content-fluid">
    <div class="container-xl wide-xl">
        <div class="nk-content-inner">
            <div class="nk-content-body">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="card card-bordered h-100">
                            <div class="card-inner border-bottom">
                                <div class="card-title-group">
                                    <div class="card-title">
                                        <h6 class="title font-neue">ნაშთების განახლების ისტორია</h6>
                                    </div>
                                </div>
                            </div>
                            <div class="card-inner">
                                <div class="timeline">
                                    <ul class="timeline-list">
                                        @foreach($product_count_log_item_list as $log_item)
                                        <li class="timeline-item">
                                            <div class="timeline-status bg-primary"></div>
                                            <div class="timeline-date">{{ $log_item->created_at->format('d-m-y') }} <em class="icon ni ni-alarm-alt"></em></div>
                                            <div class="timeline-data">
                                                <h6 class="timeline-title font-neue">
                                                    {{ $log_item->balanceProduct->name_ge }} - {{ $log_item->id }}
                                                </h6>
                                                <div class="timeline-des">
                                                    <p class="font-helvetica-regular">
                                                        <em class="icon ni ni-user-alt"></em> ძველი ნაშთი: {{ $log_item->value_old }} - განახლებული ნაშთი: {{ $log_item->value_new }}
                                                    </p>
                                                    <span class="time">{{ $log_item->created_at->format('H:i:s') }}</span>
                                                    @if($log_item->restored == 0)
                                                    <span class="font-helvetica-regular float-right text-success" style="cursor: pointer;" onclick="RestoreItemCount({{ $log_item->id }})">ნაშთის დაბრუნება</span>
                                                    @endif
                                                </div>
                                            </div>
                                        </li>
                                        @endforeach
                                    </ul>
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
<script type="text/javascript" src="{{ url('assets/js/jquery-ui.min.js') }}"></script>
<script src="{{ url('assets/scripts/products_scripts.js') }}"></script>
@endsection