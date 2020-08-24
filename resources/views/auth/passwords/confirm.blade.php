@extends('layouts.auth-layout')

@section('title')
    Set New Password
@endsection

@section('extra-styles')
    <style>
        .card{
            border-radius: 0px !important;
        }
    </style>
@endsection

@section('main-content')

    @livewire('frontend.confirm-password')

@endsection
