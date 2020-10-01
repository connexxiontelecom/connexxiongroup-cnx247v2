@extends('layouts.app')

@section('title')
    Task Board
@endsection

@section('extra-styles')

@endsection

@section('content')
    @livewire('backend.task.task-board')
@endsection

@section('dialog-section')
<div class="modal fade" id="taskDeleteModal" tabindex="-1" role="dialog">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header bg-danger">
                <h6 class="modal-title bg-danger">Are you sure?</h6>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true" class="text-white">&times;</span>
            </button>
            </div>
            <div class="modal-body">
                <p>This action cannot be undone. Are you sure you want to delete <strong id="taskName"></strong>?</p>
            </div>
            <div class="modal-footer">
                <div class="btn-group d-flex justify-content-center">
                    <input type="hidden" id="taskId">
                    <button type="button" class="btn btn-default btn-mini waves-effect " data-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-danger btn-mini waves-effect waves-light" id="deleteTaskBtn">Yes, remove</button>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
@section('extra-scripts')
<script type="text/javascript" src="/assets/pages/accordion/accordion.js"></script>
@stack('task-script')
@endsection
