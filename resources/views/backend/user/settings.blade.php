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
        <div class="col-lg-12 col-xl-12">
            @include('livewire.backend.user.common._user-settings-slab')
            <div class="tab-content tabs-left-content card-block col-md-12">
                <div class="tab-pane active" id="home5" role="tabpanel">
                   @livewire('backend.user.edit-profile')
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
