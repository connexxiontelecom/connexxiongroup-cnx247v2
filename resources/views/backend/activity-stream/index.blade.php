@extends('layouts.app')

@section('title')
    Activity Stream
@endsection

@section('extra-styles')
<link rel="stylesheet" href="/assets/bower_components/select2/css/select2.min.css">
<link rel="stylesheet" type="text/css" href="/assets/bower_components/bootstrap-multiselect/css/bootstrap-multiselect.css">
    <link rel="stylesheet" type="text/css" href="/assets/bower_components/multiselect/css/multi-select.css">
    <link rel="stylesheet" href="/assets/pages/chart/radial/css/radial.css" type="text/css" media="all">
    <link rel="stylesheet" type="text/css" href="\assets\bower_components\switchery\css\switchery.min.css">
    <link rel="stylesheet" type="text/css" href="\assets\bower_components\bootstrap-tagsinput\css\bootstrap-tagsinput.css">
    <link rel="stylesheet" href="{{asset('assets/css/cus/parsley.css')}}">
    <link rel="stylesheet" href="{{asset('assets/css/cus/progressBar.css')}}">
@endsection

@section('content')
        @livewire('backend.activity-stream.shortcut')

@endsection

@section('dialog-section')
<div class="modal fade" id="inviteUserModal" tabindex="-1" role="dialog">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h6 class="modal-title text-uppercase">Invite Users</h6>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
            </div>
            <div class="modal-body">
                <div class="col-lg-12 col-xl-12 col-md-12">
                    <!-- Nav tabs -->
                    <ul class="nav nav-tabs md-tabs" role="tablist">
                        <li class="nav-item">
                            <a class="nav-link active" data-toggle="tab" href="#shareLink" role="tab">Share Link</a>
                            <div class="slide"></div>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" data-toggle="tab" href="#byEmail" role="tab">By Email</a>
                            <div class="slide"></div>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" data-toggle="tab" href="#bySms" role="tab">By SMS</a>
                            <div class="slide"></div>
                        </li>
                    </ul>
                    <!-- Tab panes -->
                    <div class="tab-content card-block">
                        <div class="tab-pane active" id="shareLink" role="tabpanel">
                            <p class="m-0">Okay... Let's get more people to join you. Simply copy this link and share it with the persons you intend to invite.</p>
                            <div class="container mt-3">
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="input-group">
                                            <input type="text" value="{{ config('app.url')."token/".sha1(time()) }}" class="form-control" placeholder="Right add-on">
                                            <span class="input-group-addon"><i class="ti-files"></i></span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="tab-pane" id="byEmail" role="tabpanel">
                            <p class="m-0">Enter the list of emails in the box provided below. Separate with a comma.</p>
                            <div class="container mt-3">
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label for="">Email address</label> <br>
                                            <div class="tags_add ">
                                                <input type="text" class="form-control w-100 p-1" id="invitation_emails" placeholder="Email address" data-role="tagsinput">
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label for="">Message <i>(Optional)</i> </label>
                                            <textarea name="invitation_message" id="invitation_message" rows="5" class="form-control" placeholder="Compose message" style="resize: none;"></textarea>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-12 d-flex justify-content-center">
                                        <button class="btn btn-mini btn-primary" id="sendInvitationByEmail">Send Invitation</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="tab-pane" id="bySms" role="tabpanel">
                            <p class="m-0">Enter the list of phone numbers in the box provided below. Separate with a comma.</p>
                            <div class="container mt-3">
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label for="">Phone number</label> <br>
                                            <div class="tags_add ">
                                                <input type="number" class="form-control w-100 p-1" id="invitation_numbers" placeholder="Phone number" data-role="tagsinput">
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label for="">Text message <i>(Optional)</i> </label>
                                            <textarea name="invitation_text" id="invitation_text" rows="5" class="form-control" placeholder="Compose message" style="resize: none;"></textarea>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-12 d-flex justify-content-center">
                                        <button class="btn btn-mini btn-primary" id="sendInvitationBySms">Send Invitation</button>
                                    </div>
                                </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer d-flex justify-content-center">
                <button type="button" class="btn btn-default btn-mini waves-effect " data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>
@endsection
@section('extra-scripts')
<!-- Select 2 js -->
<script type="text/javascript" src="/assets/bower_components/select2/js/select2.full.min.js"></script>
<!-- Multiselect js -->
<script type="text/javascript" src="/assets/bower_components/bootstrap-multiselect/js/bootstrap-multiselect.js">
</script>
<script type="text/javascript" src="/assets/bower_components/tinymce/tinymce.min.js"></script>
<script type="text/javascript" src="/assets/js/cus/tinymce.js"></script>
<script type="text/javascript" src="/assets/bower_components/multiselect/js/jquery.multi-select.js"></script>
<script type="text/javascript" src="/assets/pages/advance-elements/select2-custom.js"></script>
<script type="text/javascript" src="/assets/js/cus/axios.min.js"></script>
<script type="text/javascript" src="\assets\bower_components\switchery\js\switchery.min.js"></script>

<script type="text/javascript" src="\assets\pages\advance-elements\swithces.js"></script>
<script type="text/javascript" src="\assets\bower_components\bootstrap-tagsinput\js\bootstrap-tagsinput.js"></script>
<script src="{{asset('/assets/js/cus/parsley.min.js')}}"></script>
<script src="{{asset('/assets/js/cus/progressBar.js')}}"></script>
@stack('activity-stream-exception')

@endsection
