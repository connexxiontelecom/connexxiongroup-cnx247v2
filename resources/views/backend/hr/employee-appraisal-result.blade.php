@extends('layouts.app')

@section('title')
    Employee Appraisal Result
@endsection

@section('extra-styles')

@endsection

@section('content')
<div class="row">
    <div class="col-md-12">
        <div class="card">
            <div class="card-block">
                <div class="d-inline-block">
                    <a class="btn btn-warning ml-3 btn-mini btn-round text-white" href="{{route('clients')}}"><i class="icofont icofont-ui-user"></i>  Plans</a>
                    <a href="{{ route('leads') }}" class=" btn btn-primary btn-mini btn-round text-white"><i class="icofont icofont-thumbs-up"></i> Features</a>
                </div>
            </div>
        </div>

    </div>
</div>
<div class="row">
    <div class="col-lg-12 col-md-12">
        <div class="card">
            <div class="card-block">
                <h5 class="sub-title">Employee Appraisal Result</h5>
                <button class="btn btn-mini btn-primary float-right mb-3" data-toggle="modal" data-target="#appraisalModal"><i class="ti-plus mr-2"></i> Start New Appraisal</button>
                @if (session()->has('success'))
                    <div class="alert alert-success background-success mt-3">
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <i class="icofont icofont-close-line-circled text-white"></i>
                        </button>
                        {!! session()->get('success') !!}
                    </div>
                @endif

            </div>
        </div>
    </div>
</div>
@endsection
@section('dialog-section')

@endsection
@section('extra-scripts')

@endsection
