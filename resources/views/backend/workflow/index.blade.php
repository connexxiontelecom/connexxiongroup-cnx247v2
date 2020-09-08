@extends('layouts.app')

@section('title')
    Workflow Tasks
@endsection

@section('extra-styles')
    <link rel="stylesheet" type="text/css" href="{{ asset('/assets/bower_components\datatables.net-bs4/css/dataTables.bootstrap4.min.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('/assets/pages/data-table/css/buttons.dataTables.min.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('/assets/bower_components/datatables.net-responsive-bs4/css/responsive.bootstrap4.min.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('/assets/pages/data-table/extensions/responsive/css/responsive.dataTables.css') }}">
@endsection

@section('content')
    <div class="row">
        <div class="col-sm-12">
            <div class="card">
                <div class="card-block">
                    <ul class="nav nav-tabs md-tabs" role="tablist">
                        <li class="nav-item">
                            <a class="nav-link active" data-toggle="tab" href="#workflowTasks" role="tab" aria-expanded="false">Workflow Tasks</a>
                            <div class="slide"></div>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" data-toggle="tab" href="#myRequests" role="tab" aria-expanded="true">My Requests</a>
                            <div class="slide"></div>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" data-toggle="tab" href="#workflowInActivityStream" role="tab" aria-expanded="false">Statistics</a>
                            <div class="slide"></div>
                        </li>
                    </ul>
                </div>
            </div>

            <div class="card">
                    <div class="tab-content card-block">
                        <div class="tab-pane active" id="workflowTasks" role="tabpanel" aria-expanded="false">
                            <p class="m-0">
                               @livewire('workflows')
                            </p>
                        </div>
                        <div class="tab-pane" id="myRequests" role="tabpanel" aria-expanded="true">
                            <p class="m-0">
                                @livewire('backend.workflow.my-request')
                            </p>
                        </div>
                        <div class="tab-pane" id="workflowInActivityStream" role="tabpanel" aria-expanded="false">
                            <p class="m-0">
                                @livewire('backend.workflow.statistics')
                            </p>
                        </div>
                    </div>
            </div>
        </div>
    </div>
@endsection

@section('extra-scripts')
<script src="/assets/bower_components/datatables.net/js/jquery.dataTables.min.js"></script>
<script src="/assets/pages/data-table/extensions/responsive/js/dataTables.responsive.min.js"></script>
<script src="/assets/bower_components/datatables.net-bs4/js/dataTables.bootstrap4.min.js"></script>
<script src="/assets/bower_components/datatables.net-responsive/js/dataTables.responsive.min.js"></script>
<script src="/assets/bower_components/datatables.net-responsive-bs4/js/responsive.bootstrap4.min.js"></script>
@endsection
