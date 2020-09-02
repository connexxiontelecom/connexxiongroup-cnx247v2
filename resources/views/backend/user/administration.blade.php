@extends('layouts.app')

@section('title')
    User > Administration
@endsection

@section('extra-styles')
<link rel="stylesheet" type="text/css" href="\assets\pages\toolbar\jquery.toolbar.css">
<link rel="stylesheet" type="text/css" href="\assets\pages\toolbar\custom-toolbar.css">
@endsection

@section('content')
    @livewire('backend.user.my-profile')
    <div class="card" style="margin-top:-25px;">
        <div class="card-block accordion-block color-accordion-block">
            <div id="accordion" role="tablist" aria-multiselectable="true">
                <div class="accordion-panel">
                    <div class="accordion-heading" role="tab" id="appreciationAccordion">
                        <h3 class="card-title accordion-title">
                        <a class="accordion-msg scale_active" data-toggle="collapse" data-parent="#accordion" href="#appreciationCollapse" aria-expanded="true" aria-controls="appreciationCollapse">
                            Appreciation
                        </a>
                    </h3>
                    </div>
                    <div id="appreciationCollapse" class="panel-collapse collapse in" role="tabpanel" aria-labelledby="appreciationAccordion">
                        <div class="accordion-content accordion-desc">
                            <div class="card mt-3">
                                <div class="card-block">
                                    <div class="row">
                                        <div class="col-sm-4 col-md-4">
                                            <h2 class="d-inline-block text-c-green m-r-10">897</h2>
                                            <div class="d-inline-block">
                                                <p class="text-muted m-b-0">All Time</p>
                                            </div>
                                        </div>
                                        <div class="col-sm-4 col-md-4">
                                            <h2 class="d-inline-block text-c-pink m-r-10">8456</h2>
                                            <div class="d-inline-block">
                                                <p class="text-muted m-b-0">Last Month</p>
                                            </div>
                                        </div>
                                        <div class="col-sm-4 col-md-4">
                                            <h2 class="d-inline-block text-c-pink m-r-10">8456</h2>
                                            <div class="d-inline-block">
                                                <p class="text-muted m-b-0">This Month</p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="card">
                                <div class="card-block">
                                    <div class="row">
                                        <div class="table-responsive">
                                            <table class="table table-bordered">
                                                <thead>
                                                    <th>#</th>
                                                    <th>From</th>
                                                    <th>Content</th>
                                                    <th>Date</th>
                                                </thead>
                                                <tr>
                                                    <td>1</td>
                                                    <td>Joseph Gbudu</td>
                                                    <td> Lorem, ipsum dolor sit amet consectetur adipisicing elit. Assumendarem. </td>
                                                    <td>72-12-2020</td>
                                                </tr>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="accordion-panel">
                    <div class=" accordion-heading" role="tab" id="queryAccordion">
                        <h3 class="card-title accordion-title">
                        <a class="accordion-msg scale_active" data-toggle="collapse" data-parent="#accordion" href="#queryCollapse" aria-expanded="false" aria-controls="queryCollapse">
                            Query
                        </a>
                    </h3>
                    </div>
                    <div id="queryCollapse" class="panel-collapse collapse" role="tabpanel" aria-labelledby="queryAccordion">
                        <div class="accordion-content accordion-desc">
                            <div class="card mt-3">
                                <div class="card-block">
                                    <div class="row">
                                        <div class="col-sm-4 col-md-4">
                                            <h2 class="d-inline-block text-c-green m-r-10">897</h2>
                                            <div class="d-inline-block">
                                                <p class="text-muted m-b-0">All Time</p>
                                            </div>
                                        </div>
                                        <div class="col-sm-4 col-md-4">
                                            <h2 class="d-inline-block text-c-pink m-r-10">8456</h2>
                                            <div class="d-inline-block">
                                                <p class="text-muted m-b-0">Last Month</p>
                                            </div>
                                        </div>
                                        <div class="col-sm-4 col-md-4">
                                            <h2 class="d-inline-block text-c-pink m-r-10">8456</h2>
                                            <div class="d-inline-block">
                                                <p class="text-muted m-b-0">This Month</p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="accordion-panel">
                    <div class=" accordion-heading" role="tab" id="attendanceAccordion">
                        <h3 class="card-title accordion-title">
                        <a class="accordion-msg scale_active" data-toggle="collapse" data-parent="#accordion" href="#attendanceCollapse" aria-expanded="false" aria-controls="attendanceCollapse">
                            Attendance
                        </a>
                    </h3>
                    </div>
                    <div id="attendanceCollapse" class="panel-collapse collapse" role="tabpanel" aria-labelledby="attendanceAccordion">
                        <div class="accordion-content accordion-desc">
                            <div class="card mt-3">
                                <div class="card-block">
                                    <div class="row">
                                        <div class="col-sm-4 col-md-4">
                                            <h2 class="d-inline-block text-c-green m-r-10">897</h2>
                                            <div class="d-inline-block">
                                                <p class="text-muted m-b-0">All Time</p>
                                            </div>
                                        </div>
                                        <div class="col-sm-4 col-md-4">
                                            <h2 class="d-inline-block text-c-pink m-r-10">8456</h2>
                                            <div class="d-inline-block">
                                                <p class="text-muted m-b-0">Last Month</p>
                                            </div>
                                        </div>
                                        <div class="col-sm-4 col-md-4">
                                            <h2 class="d-inline-block text-c-pink m-r-10">8456</h2>
                                            <div class="d-inline-block">
                                                <p class="text-muted m-b-0">This Month</p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="card">
                                <div class="card-block">
                                    <div class="row">
                                        <div class="table-responsive">
                                            <table class="table table-bordered">
                                                <thead>
                                                    <th>#</th>
                                                    <th>Clock-in</th>
                                                    <th>Clock-out</th>
                                                    <th>Date</th>
                                                </thead>
                                                @php
                                                    $serial = 1;
                                                @endphp
                                                @foreach ($attendance as $attend)
                                                    <tr>
                                                        <td>{{$serial++}}</td>
                                                        <td> <label for="" class="label label-primary">{{date('d M, Y', strtotime($attend->clock_in))}}</label> @ <label for="" class="label label-inverse">{{date('h:i a', strtotime($attend->clock_in))}}</label> </td>
                                                        <td> <label for="" class="label label-primary">{{date('d M, Y', strtotime($attend->clock_out))}}</label> @ <label for="" class="label label-inverse">{{date('h:i a', strtotime($attend->clock_out))}}</label> </td>
                                                        <td> {{date('d F, Y', strtotime($attend->created_at))}}</td>
                                                    </tr>

                                                @endforeach
                                            </table>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="accordion-panel">
                    <div class=" accordion-heading" role="tab" id="resignationAccordion">
                        <h3 class="card-title accordion-title">
                        <a class="accordion-msg scale_active" data-toggle="collapse" data-parent="#accordion" href="#resignationCollapse" aria-expanded="false" aria-controls="resignationCollapse">
                            Resignation
                        </a>
                    </h3>
                    </div>
                    <div id="resignationCollapse" class="panel-collapse collapse" role="tabpanel" aria-labelledby="resignationAccordion">
                        <div class="accordion-content accordion-desc">
                            <table class="table table-bordered mt-3">
                                <thead>
                                    <th>#</th>
                                    <th>Subject</th>
                                    <th>Status</th>
                                    <th>Content</th>
                                    <th>Date</th>
                                    <th>Action</th>
                                </thead>
                                @php
                                    $n = 1;
                                @endphp
                                @foreach ($resignations as $resign)
                                    <tr>
                                        <td>{{$n++}}</td>
                                        <td>{!! strlen($resign->subject) > 25 ? substr($resign->subject, 0, 25).'...' : $resign->subject !!}</td>
                                        <td> <label for="" class="label label-info">{{$resign->status}}</label> </td>
                                        <td>{!! strlen($resign->content) > 25 ? substr($resign->content, 0, 25).'...' : $resign->content !!}</td>
                                        <td>{{ date('d F, Y', strtotime($resign->created_at)) }}</td>
                                        <td>
                                            <div class="btn-group">
                                                <a href="#" class="btn btn-mini btn-info"> <i class="icofont icofont-eye-alt"></i> </a>
                                                <a href="#" class="btn btn-mini btn-warning text-white"> <i class="icofont icofont-ui-edit"></i> </a>
                                                <a href="#" class="btn btn-mini btn-danger text-white"> <i class="icofont icofont-trash"></i> </a>
                                            </div>
                                        </td>
                                    </tr>
                                @endforeach
                            </table>
                        </div>
                    </div>
                </div>
                <div class="accordion-panel">
                    <div class=" accordion-heading" role="tab" id="complaintsAccordion">
                        <h3 class="card-title accordion-title">
                        <a class="accordion-msg scale_active" data-toggle="collapse" data-parent="#accordion" href="#complaintsCollapse" aria-expanded="false" aria-controls="complaintsCollapse">
                            Complaints
                        </a>
                    </h3>
                    </div>
                    <div id="complaintsCollapse" class="panel-collapse collapse" role="tabpanel" aria-labelledby="complaintsAccordion">
                        <div class="accordion-content accordion-desc">
                            <p>
                                complaintsCollapse Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has
                                survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset
                                sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.
                            </p>
                        </div>
                    </div>
                </div>
                <div class="accordion-panel">
                    <div class=" accordion-heading" role="tab" id="permissionAccordion">
                        <h3 class="card-title accordion-title">
                        <a class="accordion-msg scale_active" data-toggle="collapse" data-parent="#accordion" href="#permissionCollapse" aria-expanded="false" aria-controls="permissionCollapse">
                            User Permission(s)
                        </a>
                    </h3>
                    </div>
                    <div id="permissionCollapse" class="panel-collapse collapse" role="tabpanel" aria-labelledby="permissionAccordion">
                        <div class="accordion-content accordion-desc">
                            user permission
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('dialog-section')
    @include('backend.user.common._user-modals')
@endsection

@section('extra-scripts')
<script type="text/javascript" src="/assets/pages/accordion/accordion.js"></script>
<script type="text/javascript" src="/assets/bower_components/tinymce/tinymce.min.js"></script>
<script type="text/javascript" src="/assets/js/cus/tinymce.js"></script>
<script type="text/javascript" src="/assets/js/cus/profile.js"></script>
@stack('profile-script')
@endsection
