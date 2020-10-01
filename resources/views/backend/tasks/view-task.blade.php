@extends('layouts.app')

@section('title')
    Task Details
@endsection

@section('extra-styles')
@endsection

@section('content')
    @livewire('backend.task.view-task')
@endsection

@section('dialog-section')
<div class="modal fade" id="uploadTaskAttachmentModal" tabindex="-1" role="dialog">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header bg-primary">
                <h6 class="modal-title">Upload Attachment</h6>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true" class="text-white">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form id="taskAttachmentForm" data-parsley-validate>
                    <div class="form-group">
                        <label for="">Attachment</label>
                        <input type="file" required placeholder="File" id="attachment" class="form-control-file">
                    </div>
                    <hr>
                    <div class="btn-group d-flex justify-content-center">
                        <button type="button" class="btn btn-danger waves-effect btn-mini" data-dismiss="modal"> <i class="ti-close mr-2"></i> Close</button>
                        <button type="submit" class="btn btn-primary waves-effect btn-mini waves-light" id="uploadTaskAttachmentBtn"><i class="mr-2 ti-check"></i>Submit</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<div class="modal fade" id="reviewTaskModal" tabindex="-1" role="dialog">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header bg-primary">
                <h6 class="modal-title">Review Task</h6>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true" class="text-white">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form id="reviewSubmissionForm" data-parsley-validate>
                    <div class="form-group">
                        <label>Review</label>
                        <textarea style="resize:none;" required class="form-control" id="leave_review"></textarea>
                        @error('leave_review')
                            <i class="text-danger mt-2">{{$message}}</i>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label>How would you rate this task?</label>
                        <select class="form-control col-md-4" required id="rating">
                            @for($i = 1; $i<6; $i++)
                                <option value="{{$i}}">{{$i}} star rating</option>
                            @endfor
                        </select>
                        @error('rating')
                            <i class="text-danger mt-2">{{$message}}</i>
                        @enderror
                    </div>
                    <div class="checkbox-fade fade-in-primary">
                        <label>
                            <input type="checkbox" id="appraisal">
                            <span class="cr">
                                <i class="cr-icon icofont icofont-ui-check txt-primary"></i>
                            </span>
                            <span>Use this rating for employee appraisal.</span>
                        </label>
                    </div>
                    <hr>
                    <div class="form-group d-flex justify-content-center">
                        <div class="btn-group">
                            <button class="btn btn-mini btn-primary" type="submit"><i class="ti-check mr-2"></i>  Submit</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
@section('extra-scripts')
@stack('task-script')
@endsection
