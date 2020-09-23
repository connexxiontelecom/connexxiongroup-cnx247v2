@extends('layouts.app')

@section('title')
    Chart of Accounts
@endsection

@section('extra-styles')
    <link rel="stylesheet" type="text/css" href="\assets\bower_components\datatables.net-bs4\css\dataTables.bootstrap4.min.css">
    <link rel="stylesheet" type="text/css" href="\assets\pages\data-table\css\buttons.dataTables.min.css">
    <link rel="stylesheet" type="text/css" href="\assets\bower_components\datatables.net-responsive-bs4\css\responsive.bootstrap4.min.css">
@endsection

@section('content')
    @if ($exist == 'no')
    <div class="card">
        <div class="card-block">
            <div class="row">
                <div class="col-md-12 col-sm-12 col-lg-12">
                    <h5 class="sub-title">Chart of Accounts</h5>
                    <p><strong class="text-danger">Note: </strong> It appears you do not have an existing <strong>Chart of Accounts.</strong> Use the button below to create one.</p>
                </div>
                <div class="col-md-4 offset-md-4 col-sm-4 offset-sm-4 col-lg-4 offset-lg-4 d-flex justify-content-center">
                    <form action="{{route('create-new-coa')}}" method="post">
                        @csrf
                        <button class="btn btn-success btn-square btn-block" type="submit"><i class="icofont icofont-bank-alt mr-2"></i> Create Chart of Accounts</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
    @else
    <div class="col-lg-12 col-md-12 col-sm-12">
        <div class="card">
            <div class="card-header">
                <h5 class="card-header-text">Chart of Accounts</h5>
                <button class="btn btn-mini btn-primary float-right" type="button" data-toggle="modal" data-target="#addNewAccountModal"><i class="ti-plus mr-2"></i>Add New Account</button>
            </div>
            <div class="card-block accordion-block">
                <div id="accordion" role="tablist" aria-multiselectable="true">
                    <div class="accordion-panel">
                        <div class="accordion-heading" role="tab" id="headingOne">
                            <h3 class="card-title accordion-title">
                            <a class="accordion-msg scale_active" data-toggle="collapse" data-parent="#accordion" href="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
                                Assets
                            </a>
                        </h3>
                        </div>
                        <div id="collapseOne" class="panel-collapse collapse in" role="tabpanel" aria-labelledby="headingOne">
                            <div class="accordion-content accordion-desc">
                                <div class="dt-responsive table-responsive">
                                    <table class="table table-striped table-bordered nowrap portableTables">
                                        <thead>
                                        <tr>
                                            <th>#</th>
                                            <th>GLCode</th>
                                            <th>Account Name</th>
                                            <th>Account Type</th>
                                            <th>Parent Account</th>
                                            <th>Type</th>
                                            <th>Bank</th>
                                            <th>Narration</th>
                                            <th>Action</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        @php
                                            $serial = 1;
                                        @endphp
                                        @foreach($charts as $chart)
                                            @if ($chart->account_type == 1)
                                                <tr>
                                                    <td>{{$serial++}}</td>
                                                    <td>{{$chart->glcode}}</td>
                                                    <td>{{$chart->account_name}}</td>
                                                    <td>{{$chart->account_type}}</td>
                                                    <td>
                                                        @switch($chart->parent_account)
                                                            @case('0')
                                                            Parent Account
                                                            @break
                                                            @case('1')
                                                            Asset Account
                                                            @break
                                                            @case('2')
                                                            Liability Account
                                                            @break
                                                            @case('3')
                                                            Equity Account
                                                            @break
                                                            @case('4')
                                                            Revenue Account
                                                            @break
                                                            @case('5')
                                                            Expense Account
                                                            @break
                                                        @endswitch
                                                    </td>
                                                    <td>{{$chart->type}}</td>
                                                    <td>
                                                        @if($chart->bank == 1)
                                                            Bank
                                                        @else
                                                            Not Bank
                                                        @endif
                                                    </td>
                                                    <td>{{$chart->narration ?? ''}}</td>
                                                    <td>
                                                        <div class="btn-group">
                                                            <a href=""><i class="ti-pencil text-warning mr-2"></i></a>
                                                        </div>
                                                    </td>
                                                </tr>
                                            @endif
                                        @endforeach
                                        </tbody>
                                        <tfoot>
                                        <tr>
                                            <th>#</th>
                                            <th>GLCode</th>
                                            <th>Account Name</th>
                                            <th>Account Type</th>
                                            <th>Parent Account</th>
                                            <th>Type</th>
                                            <th>Bank</th>
                                            <th>Narration</th>
                                            <th>Action</th>
                                        </tr>
                                        </tfoot>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="accordion-panel">
                        <div class="accordion-heading" role="tab" id="headingTwo">
                            <h3 class="card-title accordion-title">
                            <a class="accordion-msg scale_active" data-toggle="collapse" data-parent="#accordion" href="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
                               Liabilities
                            </a>
                        </h3>
                        </div>
                        <div id="collapseTwo" class="panel-collapse collapse" role="tabpanel" aria-labelledby="headingTwo">
                            <div class="accordion-content accordion-desc">
                                <div class="dt-responsive table-responsive">
                                    <table  class="table table-striped table-bordered nowrap portableTables">
                                        <thead>
                                        <tr>
                                            <th>#</th>
                                            <th>GLCode</th>
                                            <th>Account Name</th>
                                            <th>Account Type</th>
                                            <th>Parent Account</th>
                                            <th>Type</th>
                                            <th>Bank</th>
                                            <th>Narration</th>
                                            <th>Action</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        @php
                                            $serial = 1;
                                        @endphp
                                        @foreach($charts as $chart)
                                            @if ($chart->account_type == 2)
                                                <tr>
                                                    <td>{{$serial++}}</td>
                                                    <td>{{$chart->glcode}}</td>
                                                    <td>{{$chart->account_name}}</td>
                                                    <td>{{$chart->account_type}}</td>
                                                    <td>
                                                        @switch($chart->parent_account)
                                                            @case('0')
                                                            Parent Account
                                                            @break
                                                            @case('1')
                                                            Asset Account
                                                            @break
                                                            @case('2')
                                                            Liability Account
                                                            @break
                                                            @case('3')
                                                            Equity Account
                                                            @break
                                                            @case('4')
                                                            Revenue Account
                                                            @break
                                                            @case('5')
                                                            Expense Account
                                                            @break
                                                        @endswitch
                                                    </td>
                                                    <td>{{$chart->type}}</td>
                                                    <td>
                                                        @if($chart->bank == 1)
                                                            Bank
                                                        @else
                                                            Not Bank
                                                        @endif
                                                    </td>
                                                    <td>{{$chart->narration ?? ''}}</td>
                                                    <td>
                                                        <div class="btn-group">
                                                            <a href=""><i class="ti-pencil text-warning mr-2"></i></a>
                                                        </div>
                                                    </td>
                                                </tr>
                                            @endif
                                        @endforeach
                                        </tbody>
                                        <tfoot>
                                        <tr>
                                            <th>#</th>
                                            <th>GLCode</th>
                                            <th>Account Name</th>
                                            <th>Account Type</th>
                                            <th>Parent Account</th>
                                            <th>Type</th>
                                            <th>Bank</th>
                                            <th>Narration</th>
                                            <th>Action</th>
                                        </tr>
                                        </tfoot>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="accordion-panel">
                        <div class=" accordion-heading" role="tab" id="headingThree">
                            <h3 class="card-title accordion-title">
                            <a class="accordion-msg scale_active" data-toggle="collapse" data-parent="#accordion" href="#collapseThree" aria-expanded="false" aria-controls="collapseThree">
                               Equity
                            </a>
                        </h3>
                        </div>
                        <div id="collapseThree" class="panel-collapse collapse" role="tabpanel" aria-labelledby="headingThree">
                            <div class="accordion-content accordion-desc">
                                <div class="dt-responsive table-responsive">
                                    <table class="table table-striped table-bordered nowrap portableTables">
                                        <thead>
                                        <tr>
                                            <th>#</th>
                                            <th>GLCode</th>
                                            <th>Account Name</th>
                                            <th>Account Type</th>
                                            <th>Parent Account</th>
                                            <th>Type</th>
                                            <th>Bank</th>
                                            <th>Narration</th>
                                            <th>Action</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        @php
                                            $serial = 1;
                                        @endphp
                                        @foreach($charts as $chart)
                                            @if ($chart->account_type == 3)
                                                <tr>
                                                    <td>{{$serial++}}</td>
                                                    <td>{{$chart->glcode}}</td>
                                                    <td>{{$chart->account_name}}</td>
                                                    <td>{{$chart->account_type}}</td>
                                                    <td>
                                                        @switch($chart->parent_account)
                                                            @case('0')
                                                            Parent Account
                                                            @break
                                                            @case('1')
                                                            Asset Account
                                                            @break
                                                            @case('2')
                                                            Liability Account
                                                            @break
                                                            @case('3')
                                                            Equity Account
                                                            @break
                                                            @case('4')
                                                            Revenue Account
                                                            @break
                                                            @case('5')
                                                            Expense Account
                                                            @break
                                                        @endswitch
                                                    </td>
                                                    <td>{{$chart->type}}</td>
                                                    <td>
                                                        @if($chart->bank == 1)
                                                            Bank
                                                        @else
                                                            Not Bank
                                                        @endif
                                                    </td>
                                                    <td>{{$chart->narration ?? ''}}</td>
                                                    <td>
                                                        <div class="btn-group">
                                                            <a href=""><i class="ti-pencil text-warning mr-2"></i></a>
                                                        </div>
                                                    </td>
                                                </tr>
                                            @endif
                                        @endforeach
                                        </tbody>
                                        <tfoot>
                                        <tr>
                                            <th>#</th>
                                            <th>GLCode</th>
                                            <th>Account Name</th>
                                            <th>Account Type</th>
                                            <th>Parent Account</th>
                                            <th>Type</th>
                                            <th>Bank</th>
                                            <th>Narration</th>
                                            <th>Action</th>
                                        </tr>
                                        </tfoot>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="accordion-panel">
                        <div class=" accordion-heading" role="tab" id="headingFour">
                            <h3 class="card-title accordion-title">
                            <a class="accordion-msg scale_active" data-toggle="collapse" data-parent="#accordion" href="#collapseFour" aria-expanded="false" aria-controls="collapseFour">
                               Revenue
                            </a>
                        </h3>
                        </div>
                        <div id="collapseFour" class="panel-collapse collapse" role="tabpanel" aria-labelledby="headingFour">
                            <div class="accordion-content accordion-desc">
                                <div class="dt-responsive table-responsive">
                                    <table class="table table-striped table-bordered nowrap portableTables">
                                        <thead>
                                        <tr>
                                            <th>#</th>
                                            <th>GLCode</th>
                                            <th>Account Name</th>
                                            <th>Account Type</th>
                                            <th>Parent Account</th>
                                            <th>Type</th>
                                            <th>Bank</th>
                                            <th>Narration</th>
                                            <th>Action</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        @php
                                            $serial = 1;
                                        @endphp
                                        @foreach($charts as $chart)
                                            @if ($chart->account_type == 4)
                                                <tr>
                                                    <td>{{$serial++}}</td>
                                                    <td>{{$chart->glcode}}</td>
                                                    <td>{{$chart->account_name}}</td>
                                                    <td>{{$chart->account_type}}</td>
                                                    <td>
                                                        @switch($chart->parent_account)
                                                            @case('0')
                                                            Parent Account
                                                            @break
                                                            @case('1')
                                                            Asset Account
                                                            @break
                                                            @case('2')
                                                            Liability Account
                                                            @break
                                                            @case('3')
                                                            Equity Account
                                                            @break
                                                            @case('4')
                                                            Revenue Account
                                                            @break
                                                            @case('5')
                                                            Expense Account
                                                            @break
                                                        @endswitch
                                                    </td>
                                                    <td>{{$chart->type}}</td>
                                                    <td>
                                                        @if($chart->bank == 1)
                                                            Bank
                                                        @else
                                                            Not Bank
                                                        @endif
                                                    </td>
                                                    <td>{{$chart->narration ?? ''}}</td>
                                                    <td>
                                                        <div class="btn-group">
                                                            <a href=""><i class="ti-pencil text-warning mr-2"></i></a>
                                                        </div>
                                                    </td>
                                                </tr>
                                            @endif
                                        @endforeach
                                        </tbody>
                                        <tfoot>
                                        <tr>
                                            <th>#</th>
                                            <th>GLCode</th>
                                            <th>Account Name</th>
                                            <th>Account Type</th>
                                            <th>Parent Account</th>
                                            <th>Type</th>
                                            <th>Bank</th>
                                            <th>Narration</th>
                                            <th>Action</th>
                                        </tr>
                                        </tfoot>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="accordion-panel">
                        <div class=" accordion-heading" role="tab" id="headingFive">
                            <h3 class="card-title accordion-title">
                            <a class="accordion-msg scale_active" data-toggle="collapse" data-parent="#accordion" href="#collapseFive" aria-expanded="false" aria-controls="collapseFive">
                               Expenses
                            </a>
                        </h3>
                        </div>
                        <div id="collapseFive" class="panel-collapse collapse" role="tabpanel" aria-labelledby="headingFive">
                            <div class="accordion-content accordion-desc">
                                <div class="dt-responsive table-responsive">
                                    <table class="table table-striped table-bordered nowrap portableTables">
                                        <thead>
                                        <tr>
                                            <th>#</th>
                                            <th>GLCode</th>
                                            <th>Account Name</th>
                                            <th>Account Type</th>
                                            <th>Parent Account</th>
                                            <th>Type</th>
                                            <th>Bank</th>
                                            <th>Narration</th>
                                            <th>Action</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        @php
                                            $serial = 1;
                                        @endphp
                                        @foreach($charts as $chart)
                                            @if ($chart->account_type == 5)
                                                <tr>
                                                    <td>{{$serial++}}</td>
                                                    <td>{{$chart->glcode}}</td>
                                                    <td>{{$chart->account_name}}</td>
                                                    <td>{{$chart->account_type}}</td>
                                                    <td>
                                                        @switch($chart->parent_account)
                                                            @case('0')
                                                            Parent Account
                                                            @break
                                                            @case('1')
                                                            Asset Account
                                                            @break
                                                            @case('2')
                                                            Liability Account
                                                            @break
                                                            @case('3')
                                                            Equity Account
                                                            @break
                                                            @case('4')
                                                            Revenue Account
                                                            @break
                                                            @case('5')
                                                            Expense Account
                                                            @break
                                                        @endswitch
                                                    </td>
                                                    <td>{{$chart->type}}</td>
                                                    <td>
                                                        @if($chart->bank == 1)
                                                            Bank
                                                        @else
                                                            Not Bank
                                                        @endif
                                                    </td>
                                                    <td>{{$chart->narration ?? ''}}</td>
                                                    <td>
                                                        <div class="btn-group">
                                                            <a href=""><i class="ti-pencil text-warning mr-2"></i></a>
                                                        </div>
                                                    </td>
                                                </tr>
                                            @endif
                                        @endforeach
                                        </tbody>
                                        <tfoot>
                                        <tr>
                                            <th>#</th>
                                            <th>GLCode</th>
                                            <th>Account Name</th>
                                            <th>Account Type</th>
                                            <th>Parent Account</th>
                                            <th>Type</th>
                                            <th>Bank</th>
                                            <th>Narration</th>
                                            <th>Action</th>
                                        </tr>
                                        </tfoot>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    @endif
@endsection

@section('dialog-section')
    <div class="modal fade" id="addNewAccountModal" tabindex="-1" role="dialog">
        <div class="modal-dialog " role="document">
            <div class="modal-content">
                <div class="modal-header bg-primary">
                    <h6 class="modal-title text-uppercase">Add New Account</h6>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span class="text-white" aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <p><strong class="text-danger">Note:</strong> All fields marked with <sup class="text-danger">*</sup> is required.</p>
                    <form action="">
                        <div class="form-group">
                            <label for="">GL Code <sup class="text-danger">*</sup></label>
                            <input type="number" placeholder="GL Code" id="gl_code" class="form-control">
                            <div  class="text-white background-danger mt-2 p-2" id="gl_code_error">
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="">Account Name <sup class="text-danger">*</sup></label>
                            <input type="text" placeholder="Account Name" id="account_name" class="form-control">
                        </div>
                        <div class="row">
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="">Account Type <sup class="text-danger">*</sup></label>
                                    <select name="account_type" id="account_type" class="form-control ">
                                        <option disabled selected>Select account type</option>
                                        <option value="1">Asset</option>
                                        <option value="2">Liability</option>
                                        <option value="3">Equity</option>
                                        <option value="4">Revenue</option>
                                        <option value="5">Expense</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="">Type <sup class="text-danger">*</sup></label>
                                    <select name="type" id="type" class="form-control">
                                        <option selected disabled>Select type</option>
                                        <option value="General">General</option>
                                        <option value="Detail">Detail</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="">Bank <sup class="text-danger">*</sup></label>
                                    <select name="type" id="bank" class="form-control">
                                        <option value="1">Yes</option>
                                        <option value="0">No</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                <div  class="text-white background-danger mt-2 p-2" id="account_type_error">
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="">Parent Account<sup class="text-danger">*</sup></label>
                            <select name="type" id="parent_account" class="form-control">
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="">Note</label>
                            <textarea name="note" id="note" style="resize: none;" class="form-control" placeholder="Type narration here..."></textarea>
                        </div>
                    </form>
                </div>
                <div class="modal-footer d-flex justify-content-center">
                    <button type="button" class="btn btn-danger waves-effect btn-mini" data-dismiss="modal"> <i class="ti-close mr-2"></i>Close</button>
                    <button type="button" class="btn btn-primary waves-effect btn-mini waves-light" id="addNewAccountBtn"> <i class="ti-check mr-2"></i>Submit</button>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('extra-scripts')

    <script src="\assets\bower_components\datatables.net\js\jquery.dataTables.min.js"></script>
    <script src="\assets\bower_components\datatables.net-buttons\js\dataTables.buttons.min.js"></script>
    <script src="\assets\pages\data-table\js\jszip.min.js"></script>
    <script src="\assets\pages\data-table\js\pdfmake.min.js"></script>
    <script src="\assets\pages\data-table\js\vfs_fonts.js"></script>
    <script src="\assets\bower_components\datatables.net-buttons\js\buttons.html5.min.js"></script>

    <script src="\assets\bower_components\datatables.net-bs4\js\dataTables.bootstrap4.min.js"></script>
    <script src="\assets\bower_components\datatables.net-responsive\js\dataTables.responsive.min.js"></script>
    <script src="\assets\bower_components\datatables.net-responsive-bs4\js\responsive.bootstrap4.min.js"></script>
    <script src="\assets\pages\data-table\js\data-table-custom.js"></script>
    <script>
        $(document).ready(function(){
            $('#gl_code_error').hide();
            $('#account_type_error').hide();
            $('#addNewAccountBtn').prop("disabled", true);
            $("#gl_code").blur(function () {
                var gl_code = $(this).val();
                gl_code = String(gl_code);
                var length  = gl_code.length;
                if(length%2 == 0){
                    $('#gl_code_error').show();
                    $('#gl_code_error').html("Length of account number should be odd");
                    $('#addNewAccountBtn').prop("disabled", true);
                }
                else{
                    $('#gl_code_error').hide();
                    $('#addNewAccountBtn').prop("disabled", false);
                    //console.log("Number @ :"+$(this).val().toString().charAt(0));
                }

            });
            //Account type
            $(document).on('change', '#account_type', function(e){
                e.preventDefault();
                var account_type = $(this).val();
                console.log(account_type);
                switch (account_type) {
                    case "1":
                       if($('#gl_code').val().toString().charAt(0) != 1){
                            $('#account_type_error').show();
                            $("#account_type_error").html("Invalid GL code for this account type. Hint: First number should start with <strong>1</strong>");
                            $('#addNewAccountBtn').prop("disabled", true);
                        }else{
                            $('#account_type_error').hide();
                            $('#addNewAccountBtn').prop("disabled", false);
                           getParentAccount(1, $('#type').val() );
                        }
                    break;
                    case "2":
                        if($('#gl_code').val().toString().charAt(0) != 2){
                            $('#account_type_error').show();
                            $("#account_type_error").html("Invalid GL code for this account type. Hint: First number should start with <strong>2</strong>");
                            $('#addNewAccountBtn').prop("disabled", true);
                        }else{
                            $('#account_type_error').hide();
                            $('#addNewAccountBtn').prop("disabled", false);
                            getParentAccount(2, $('#type').val() );
                        }
                    break;
                    case "3":
                        if($('#gl_code').val().toString().charAt(0) != 3){
                            $('#account_type_error').show();
                            $("#account_type_error").html("Invalid GL code for this account type. Hint: First number should start with <strong>3</strong>");
                            $('#addNewAccountBtn').prop("disabled", true);
                        }else{
                            $('#account_type_error').hide();
                            $('#addNewAccountBtn').prop("disabled", false);
                            getParentAccount(3, $('#type').val() );
                        }
                    break;
                    case "4":
                        if($('#gl_code').val().toString().charAt(0) != 4){
                            $('#account_type_error').show();
                            $("#account_type_error").html("Invalid GL code for this account type. Hint: First number should start with <strong>4</strong>");
                            $('#addNewAccountBtn').prop("disabled", true);
                        }else{
                            $('#account_type_error').hide();
                            $('#addNewAccountBtn').prop("disabled", false);
                            getParentAccount(4, $('#type').val() );
                        }
                    break;
                    case "5":
                        if($('#gl_code').val().toString().charAt(0) != 5){
                            $('#account_type_error').show();
                            $("#account_type_error").html("Invalid GL code for this account type. Hint: First number should start with <strong>5</strong>");
                            $('#addNewAccountBtn').prop("disabled", true);
                        }else{
                            $('#account_type_error').hide();
                            $('#addNewAccountBtn').prop("disabled", false);
                            getParentAccount(5, $('#type').val() );
                        }
                    break;


                }
            });
            //type
            $(document).on('change', '#type', function(e){
                e.preventDefault();
                getParentAccount($('#account_type').val(), $('#type').val() );
                /*axios.post('/get-parent-account', {account_type:$(this).val()})
                .then(response=>{
                    $.each(response.data.parents, function (index, value) {
                        $('#parent_account').append('<option value="' + value.id + '">' + value.account_name + '</option>');
                    });
                });*/
            });

            $(document).on('click', '#addNewAccountBtn',function(e){
                e.preventDefault();
                axios.post('/save-account', {
                    'glcode':$('#gl_code').val(),
                    'account_name':$('#account_name').val(),
                    'account_type':$('#account_type').val(),
                    'type':$('#type').val(),
                    'bank':$('#bank').val(),
                    'parent_account':$('#parent_account').val()
                })
                .then(response=>{
                    $('#addNewAccountModal').modal('hide');
                });
            });
        });

        function getParentAccount(account_type, type){

            axios.post('/get-parent-account', {account_type:account_type, type:type})
            .then(response=>{
                $.each(response.data.parents, function (index, value) {
                    $('#parent_account').append('<option value="' + value.glcode + '">' + value.account_name +" - "+ value.glcode + '</option>');
                });
            });
        }
    </script>
@endsection
