@extends('layouts.frontend-layout')

@section('title')
    Sigin
@endsection

@section('extra-styles')
    <style>
        .card{
            border-radius: 0px !important;
        }
    </style>
@endsection

@section('content')

    @livewire('frontend.login')

@endsection
