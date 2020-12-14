@extends('layouts.app')

@section('title')
    Deals
@endsection

@section('extra-styles')

<style>
/* The heart of the matter */

.horizontal-scrollable > .row {
            overflow-x: auto;
            white-space: nowrap;
    }

.horizontal-scrollable {
    overflow-x: scroll;
    overflow-y: hidden;
    white-space: nowrap;
    }
</style>
@endsection

@section('content')
    @livewire('backend.crm.deals.index')
@endsection

@section('dialog-section')

@endsection
@section('extra-scripts')

@endsection
