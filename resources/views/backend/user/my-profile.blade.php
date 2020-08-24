@extends('layouts.app')

@section('title')
    My Profile
@endsection

@section('extra-styles')
<link rel="stylesheet" type="text/css" href="\assets\pages\toolbar\jquery.toolbar.css">
<link rel="stylesheet" type="text/css" href="\assets\pages\toolbar\custom-toolbar.css">
@endsection

@section('content')
    @livewire('backend.user.my-profile')
    <div class="card" style="margin-top:-25px;">
        <div class="card-block">
            <div class="row">
                <div class="col-md-12 col-lg-12 col-xl-12">
                    <div class="tab-pane active" id="home" role="tabpanel">
                        @if(Auth::check())
                            <div class="table-responsive">
                                <table class="table m-0">
                                    <tbody>
                                        <tr>
                                            <th scope="row" class="tx-11 text-uppercase" style="font-size:12px;">Full Name</th>
                                            <td>{{Auth::user()->first_name ?? ''}} {{Auth::user()->surname ?? ''}} </td>
                                        </tr>
                                        <tr>
                                            <th scope="row" class="tx-11 text-uppercase" style="font-size:12px;">Gender</th>
                                            <td>Female</td>
                                        </tr>
                                        <tr>
                                            <th scope="row" class="tx-11 text-uppercase" style="font-size:12px;">Birth Date</th>
                                            <td>October 25th, 1990</td>
                                        </tr>
                                        <tr>
                                            <th scope="row" class="tx-11 text-uppercase" style="font-size:12px;">Marital Status</th>
                                            <td>Single</td>
                                        </tr>
                                        <tr>
                                            <th scope="row" class="tx-11 text-uppercase" style="font-size:12px;">Email</th>
                                            <td>{{Auth::user()->email ?? ''}}</td>
                                        </tr>
                                        <tr>
                                            <th scope="row" class="tx-11 text-uppercase" style="font-size:12px;">Mobile</th>
                                            <td>{{Auth::user()->mobile ?? '-'}}</td>
                                        </tr>
                                        <tr>
                                            <th scope="row" class="tx-11 text-uppercase" style="font-size:12px;">Position</th>
                                            <td>{{Auth::user()->position ?? '-'}}</td>
                                        </tr>
                                        <tr>
                                            <th scope="row" class="tx-11 text-uppercase" style="font-size:12px;">Department</th>
                                            <td>{{Auth::user()->departmenet_id ?? '-'}}</td>
                                        </tr>
                                        <tr>
                                            <th scope="row" class="tx-11 text-uppercase" style="font-size:12px;">Hire Date</th>
                                            <td>{{date('d M, Y', strtotime(Auth::user()->hire_date)) ?? '-'}}</td>
                                        </tr>
                                        <tr>
                                            <th scope="row" class="tx-11 text-uppercase" style="font-size:12px;">Confirm Date</th>
                                            <td>{{date('d M, Y', strtotime(Auth::user()->confirm_date)) ?? '-'}}</td>
                                        </tr>
                                        <tr>
                                            <th scope="row" class="tx-11 text-uppercase" style="font-size:12px;">Address</th>
                                            <td>{{Auth::user()->address}}</td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        @else
                            {{route('signin')}}
                        @endif

                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('dialog-section')
<div class="modal fade" id="newResignationModal" tabindex="-1" role="dialog">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h6 class="modal-title text-uppercase">New Resignation</h6>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
            </div>
            <div class="modal-body">
                <form action="">
                    <div class="form-group">
                        <label for="">Subject</label>
                        <input type="text" placeholder="Subject" id="subject" class="form-control">
                    </div>
                    <div class="form-group">
                        <label for="">Attachment</label>
                        <input type="file" id="attachment" class="form-control">
                    </div>
                    <div class="form-group">
                        <label for="">Content</label>
                        <textarea name="" id="resignation_content" cols="5" rows="5" class="form-control content" placeholder="Type here..."></textarea>
                    </div>
                </form>
            </div>
            <div class="modal-footer d-flex justify-content-center">
                <button type="button" class="btn btn-default waves-effect btn-mini" data-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary waves-effect btn-mini waves-light" id="submitResignationBtn">Submit</button>
            </div>
        </div>
    </div>
</div>
<div class="modal fade" id="newComplaintModal" tabindex="-1" role="dialog">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h6 class="modal-title">New Complaint</h6>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
            </div>
            <div class="modal-body">
                <form action="">
                    <div class="form-group">
                        <label for="">Subject</label>
                        <input type="text" placeholder="Subject" id="complaint_subject" class="form-control">
                    </div>
                    <div class="form-group">
                        <label for="">Content</label>
                        <textarea name="" id="complaint_content" cols="5" rows="5" class="form-control content" placeholder="Type here..."></textarea>
                    </div>
                </form>
            </div>
            <div class="modal-footer d-flex justify-content-center">
                <button type="button" class="btn btn-default waves-effect btn-mini" data-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary waves-effect btn-mini waves-light" id="submitComplaintBtn">Submit</button>
            </div>
        </div>
    </div>
</div>
@endsection

@section('extra-scripts')
<script type="text/javascript" src="/assets/pages/accordion/accordion.js"></script>
<script type="text/javascript" src="/assets/bower_components/tinymce/tinymce.min.js"></script>
<script type="text/javascript" src="/assets/js/cus/tinymce.js"></script>
<script type="text/javascript" src="/assets/js/cus/profile.js"></script>
@stack('profile-script')
@endsection
