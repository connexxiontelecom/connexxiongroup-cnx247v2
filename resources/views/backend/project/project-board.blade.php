@extends('layouts.app')

@section('title')
    Project Board
@endsection

@section('extra-styles')
{{-- <link rel="stylesheet" type="text/css" href="/assets/css/jquery.mCustomScrollbar.css"> --}}
@endsection

@section('content')
    @livewire('backend.project.project-board')
@endsection

@section('extra-scripts')
<script type="text/javascript" src="/assets/pages/accordion/accordion.js"></script>
@endsection