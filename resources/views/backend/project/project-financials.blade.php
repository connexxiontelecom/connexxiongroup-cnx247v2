@extends('layouts.app')

@section('title')
    Project Financials > {{$project->post_title ?? ''}}
@endsection

@section('extra-styles')
<link rel="stylesheet" type="text/css" href="\assets\bower_components\datatables.net-bs4\css\dataTables.bootstrap4.min.css">
    <link rel="stylesheet" type="text/css" href="\assets\pages\data-table\css\buttons.dataTables.min.css">
    <link rel="stylesheet" type="text/css" href="\assets\bower_components\datatables.net-responsive-bs4\css\responsive.bootstrap4.min.css">
@endsection

@section('content')
<div class="container">
    @if (session()->has('success'))
        <div class="row">
            <div class="col-md-12 col-xl-12">
                <div class="card">
                    <div class="card-block">
                        <div class="alert alert-success" role="alert">
                            {!! session()->get('success') !!}
                        </div>
                    </div>
                </div>
            </div>
        </div>
   @endif
    @if (session()->has('error'))
        <div class="row">
            <div class="col-md-12 col-xl-12">
                <div class="card">
                    <div class="card-block">
                        <div class="alert alert-warning" role="alert">
                            {!! session()->get('error') !!}
                        </div>
                    </div>
                </div>
            </div>
        </div>
   @endif
   <div class="row">
       <div class="col-md-12 col-sm-12 col-lg-12">
            <nav class="navbar navbar-light bg-faded m-b-30 p-10 filter-bar">
                <div class="row">
                    <div class="d-inline-block">
                        <a class="btn btn-warning ml-3 btn-mini btn-round text-white" href="{{route('project-board')}}"><i class="icofont icofont-tasks"></i>  Project Detail</a>
                        <a href="{{ route('project-budget', $project->post_url) }}" class=" btn btn-primary btn-mini btn-round text-white"><i class="icofont icofont-spreadsheet"></i> Budget</a>
                        <a href="{{ route('project-invoice', $project->post_url) }}" class="btn btn-danger btn-mini btn-round text-white"><i class="icofont icofont-money-bag "></i>  Invoice </a>
                        <a href="{{ route('project-receipt', $project->post_url) }}" class="btn btn-info btn-mini btn-round text-white"><i class="ti-receipt "></i>  Receipt </a>
                    </div>
                </div>
                <div class="nav-item nav-grid">
                    <a href="{{ route('project-calendar') }}" class="btn btn-info btn-mini btn-round text-white"><i class="icofont icofont-pie-chart "></i>  Gantt</a>
                    <a href="{{ route('project-calendar') }}" class="btn btn-info btn-mini btn-round text-white"><i class="ti-calendar"></i>  Calendar</a>
                    <a href="{{ route('project-analytics') }}" class="btn btn-danger btn-mini btn-round text-white"><i class="icofont icofont-pie-chart "></i>  Analytics </a>
                </div>
            </nav>
       </div>
   </div>
   <form action="{{route('store-project-invoice')}}" method="post">
       @csrf
    <div class="card">
        <div class="card-block">
            <h5 class="sub-title">{{$project->post_title ?? ''}}</h5>
            <div class="row">
                <div class="col-md-6">
                    <div class="card text-center text-white bg-c-green">
                        <div class="card-block">
                            <h6 class="m-b-0">Cash Inflow</h6>
                            <h4 class="m-t-10 m-b-10">12</h4>
                        </div>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="card text-center text-white bg-c-pink">
                        <div class="card-block">
                            <h6 class="m-b-0">Cash Outflow</h6>
                            <h4 class="m-t-10 m-b-10">6325</h4>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="row invoice-contact">
            <div class="col-xl-12 col-md-12">
                <div class="row">
                    <div class="col-md-12">
                        <div class="card">
                            <div class="card-block">
                                <div class="row">
                                    <div class="col-md-12 col-lg-12 col-sm-12">
                                        <div class="dt-responsive table-responsive">
                                            <table id="simpletable" class="table table-striped table-bordered nowrap">
                                                <thead>
                                                <tr>
                                                    <th>#</th>
                                                    <th>Budget Title</th>
                                                    <th>Invoice No.</th>
                                                    <th>Receipt No.</th>
                                                    <th>Amount</th>
                                                    <th>Date</th>
                                                </tr>
                                                </thead>
                                                <tbody>
                                                    @php
                                                        $serial = 1;
                                                    @endphp

                                                </tbody>
                                                <tfoot>
                                                <tr>
                                                    <th>#</th>
                                                    <th>Budget Title</th>
                                                    <th>Invoice No.</th>
                                                    <th>Receipt No.</th>
                                                    <th>Amount</th>
                                                    <th>Date</th>
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

        </div>
    </div>
</form>
</div>
@endsection
@section('dialog-section')
<div class="modal fade" id="budgetModal" tabindex="-1" role="dialog">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header bg-warning">
                <h6 class="modal-title" style="text-transform: uppercase">Project Budget</h6>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true" class="text-white">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <h5 class="sub-title">{{$project->post_title ?? ''}}</h5>
                <div class="row">
                    <div class="col-md-12 col-lg-12 col-sm-12  inject-table"></div>
                </div>
            </div>
            <div class="modal-footer d-flex justify-content-center">
                <div class="btn-group">
                    <button type="button" class="btn btn-danger waves-effect btn-mini" data-dismiss="modal"> <i class="ti-close mr-2"></i> Close</button>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
@section('extra-scripts')
<script src="\assets\bower_components\datatables.net\js\jquery.dataTables.min.js"></script>

<script src="\assets\bower_components\datatables.net-bs4\js\dataTables.bootstrap4.min.js"></script>
<script src="\assets\bower_components\datatables.net-responsive\js\dataTables.responsive.min.js"></script>
<script src="\assets\bower_components\datatables.net-responsive-bs4\js\responsive.bootstrap4.min.js"></script>
<script src="\assets\pages\data-table\js\data-table-custom.js"></script>
@endsection
