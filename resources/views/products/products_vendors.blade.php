@extends('layout.layout')

@section('css')

@endsection

@section('content')
<div class="nk-content nk-content-fluid">
    <div class="container-xl wide-xl">
        <div class="nk-content-inner">
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
                                                    <li><a href="javascript:;" onclick="VendorModal()"><span>მომწოდებლის დამატება</span></a></li>
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
            <div class="nk-content-body">
                <div class="nk-block nk-block-lg">
                    <div class="card card-preview">
                        <div class="card-inner">
                            <table class="datatable-init table">
                                <thead>
                                    <tr class="font-helvetica-regular">
                                        <th>დასახელება</th>
                                        <th>საიდენტიფიკაციო კოდი</th>
                                        <th>მისამართი</th>
                                        <th>ტელეფონის ნომერი</th>
                                        <th>სტატუსი</th>
                                        <th>მოქმედება</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td>Michael Bruce</td>
                                        <td>Javascript Developer</td>
                                        <td>Singapore</td>
                                        <td>Singapore</td>
                                        <td>Singapore</td>
                                        <td>29</td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div> 
            </div>
        </div>
    </div>
</div>	
<div class="modal fade" id="VendorModal" style="display: none;" aria-hidden="true">
    <div class="modal-dialog modal-xl" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title font-neue vendor-modal-head"></h5>
                <a href="#" class="close" data-dismiss="modal" aria-label="Close">
                    <em class="icon ni ni-cross"></em>
                </a>
            </div>
            <div class="modal-body">
                <form action="#" class="form-validate is-alter" novalidate="novalidate" id="vendor_form">
                    <div class="row">
                        <div class="col-lg-6 mb-2">
                            <div class="form-group">
                                <label class="form-label font-helvetica-regular" for="vendor_name">მომწოდებლის დასახელება *</label>
                                <div class="form-control-wrap">
                                    <input type="text" class="form-control check-input" name="vendor_name" id="vendor_name">
                                    <small class="vendor_name-error text-error text-danger mt-1"></small>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-6 mb-2">
                            <div class="form-group">
                                <label class="form-label font-helvetica-regular" for="vendor_code">საიდენტიფიკაცო კოდი *</label>
                                <div class="form-control-wrap">
                                    <input type="text" class="form-control check-input" name="vendor_code" id="vendor_code">
                                    <small class="vendor_code-error text-error text-danger mt-1"></small>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-6 mb-2">
                            <div class="form-group">
                                <label class="form-label font-helvetica-regular" for="vendor_address">მისამართი *</label>
                                <div class="form-control-wrap">
                                    <input type="text" class="form-control check-input" name="vendor_address" id="vendor_address">
                                    <small class="vendor_address-error text-error text-danger mt-1"></small>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-6 mb-2">
                            <div class="form-group">
                                <label class="form-label font-helvetica-regular" for="vendor_phone">ტელეფონი *</label>
                                <div class="form-control-wrap">
                                    <input type="text" class="form-control check-input" name="vendor_phone" id="vendor_phone">
                                    <small class="vendor_phone-error text-error text-danger mt-1"></small>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-12 col-lg-6 mb-2">
                            <div class="form-group">
                                <button type="button" class="btn btn-lg btn-primary font-helvetica-regular" onclick="VendorFormSubmit()">დადასტურება</button>
                            </div>
                        </div>
                    </div>
                    <input type="hidden" name="vendor_id" id="vendor_id">
                </form>
            </div>
        </div>
    </div>
</div>
@endsection

@section('js')
    <script type="text/javascript" src="{{ url('assets/js/jquery-ui.min.js') }}"></script>
    <script src="{{ url('assets/scripts/products_scripts.js') }}"></script>
@endsection