@extends('layouts.app')

@section('title')
    Project Details
@endsection

@section('extra-styles')
{{-- <link rel="stylesheet" type="text/css" href="/assets/css/jquery.mCustomScrollbar.css"> --}}
@endsection

@section('content')
    @livewire('backend.project.view-project')
@endsection

@section('extra-scripts')

@endsection