@extends('layouts.app')

@section('title')
    Task Details
@endsection

@section('extra-styles')
{{-- <link rel="stylesheet" type="text/css" href="/assets/css/jquery.mCustomScrollbar.css"> --}}
@endsection

@section('content')
    @livewire('backend.task.view-task')
@endsection

@section('extra-scripts')

@endsection