@extends('layouts.app')

@section('title')
    Purchase Request
@endsection

@section('extra-styles')
<link rel="stylesheet" type="text/css" href="/assets/css/component.css">
<link rel="stylesheet" type="text/css" href="/assets/bower_components/bootstrap-multiselect/css/bootstrap-multiselect.css">
    <link rel="stylesheet" type="text/css" href="/assets/bower_components/multiselect/css/multi-select.css">
    <link rel="stylesheet" type="text/css" href="/assets/pages/notification/notification.css">
    <link rel="stylesheet" href="/assets/bower_components/select2/css/select2.min.css">
    <!-- Animate.css -->
    <link rel="stylesheet" type="text/css" href="/assets/bower_components/animate.css/css/animate.css">
    <link rel="stylesheet" href="{{asset('assets/css/cus/parsley.css')}}">
    <link rel="stylesheet" href="{{asset('assets/css/cus/progressBar.css')}}">
<style>
    .md-content h3{
        border-radius: 0px !important;
    }

</style>
@endsection

@section('content')
    @livewire('backend.workflow.purchase.index')
@endsection
@section('dialog-section')
<div class="modal fade" id="requestModal" tabindex="-1" role="dialog">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header bg-primary">
                <h6 class="modal-title text-uppercase">New Purchase Request</h6>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true" class="text-white">&times;</span>
            </button>
            </div>
            <div class="modal-body">
							@if (session()->has('success'))
								<div class="alert alert-success background-success mt-3">
									<button type="button" class="close" data-dismiss="alert" aria-label="Close">
										<i class="icofont icofont-close-line-circled text-white"></i>
									</button>
									{!! session()->get('success') !!}
								</div>
							@endif
								@if (session()->has('error'))
									<div class="alert alert-warning background-warning mt-3">
										<button type="button" class="close" data-dismiss="alert" aria-label="Close">
											<i class="icofont icofont-close-line-circled text-white"></i>
										</button>
										{!! session()->get('error') !!}
									</div>
								@endif
                <form id="" action="{{route('process-workflow-request')}}" method="post"  enctype="multipart/form-data">
									@csrf
                    <fieldset>

                        <div class="form-group">
                            <label for="">Title</label>
                            <input type="text" name="title" placeholder="Title" id="title" class="form-control" required>
													@error('title')
														<i class="text-danger">{{$message}}</i>
													@enderror
                        </div>
                        <div class="form-group">
                            <label for="">Amount</label>
                            <div class="input-group">
                                <span class="input-group-addon" id="basic-addon3">{{Auth::user()->tenant->currency->symbol ?? 'N'}}</span>
                                <input name="amount" id="amount" required type="number" class="form-control form-control-normal" placeholder="Amount" step="0.01">
                            </div>
													@error('amount')
														<i class="text-danger">{{$message}}</i>
													@enderror
													<input type="hidden" name="request_type" value="purchase-request">
                        </div>
                        <div class="form-group">
													@if($storage_capacity == 1):
                            <label for="">Attachment</label>
                            <input type="file" name="attachment" id="uploadAttachment" class="form-control">
														@endif

													@if($storage_capacity == 0)
														Drive Capacity full, Please Upgrade To Attach File

														@endif
                        </div>
                        <div class="form-group">
                            <label for="">Description</label>
                            <textarea name="description" id="description" cols="5" rows="5" class="form-control content" placeholder="Type here..."></textarea>
                        </div>
                        <hr>
                        <div class="btn-group d-flex justify-content-center">
                            <button type="button" class="btn btn-danger waves-effect btn-mini" data-dismiss="modal"><i class="mr-2 ti-close"></i>Close</button>
                            <button type="submit" class="btn btn-primary waves-effect btn-mini waves-light" id="addNewExpenseBtn"><i class="mr-2 ti-check"></i>Submit</button>
                        </div>
                    </fieldset>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection

@section('extra-scripts')
    <script type="text/javascript" src="/assets/js/modal.js"></script>
    <script type="text/javascript" src="/assets/js/modalEffects.js"></script>
    <script type="text/javascript" src="/assets/js/classie.js"></script>
    <script type="text/javascript" src="/assets/bower_components/select2/js/select2.full.min.js"></script>
    <script type="text/javascript" src="/assets/bower_components/multiselect/js/jquery.multi-select.js"></script>
    <script type="text/javascript" src="/assets/bower_components/bootstrap-multiselect/js/bootstrap-multiselect.js"></script>

    <script type="text/javascript" src="/assets/bower_components/tinymce/tinymce.min.js"></script>
    <script type="text/javascript" src="/assets/js/cus/tinymce.js"></script>
    <script src="{{asset('/assets/js/cus/parsley.min.js')}}"></script>
    <script src="{{asset('/assets/js/cus/progressBar.js')}}"></script>

@endsection
