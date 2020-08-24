@extends('layouts.app')

@section('title')
    Chat-n-calls
@endsection

@section('extra-styles')
<link rel="stylesheet" type="text/css" href="\assets\pages\message\message.css">
@endsection

@section('content')
    @livewire('backend.chat-n-calls.view.chat-n-calls')
@endsection

@section('extra-scripts')
<script type="text/javascript" src="\assets\pages\message\message.js"></script>
<script type="text/javascript" src="\assets\js\cus\axios.min.js"></script>

@endsection
