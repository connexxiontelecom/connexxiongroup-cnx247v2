@extends('layouts.app')

@section('title')
    Our Pricing
@endsection

@section('extra-styles')
<link rel="stylesheet" type="text/css" href="\assets\pages\toolbar\jquery.toolbar.css">
<link rel="stylesheet" type="text/css" href="\assets\pages\toolbar\custom-toolbar.css">
@endsection

@section('content')
   <div class="row">
       <div class="col-md-12">
           <div class="card">
            <div class="card-block">
                <h5 class="sub-title">Our Pricing</h5>
                @if (session()->has('success'))
                    <div class="alert alert-success background-success mt-3">
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <i class="icofont icofont-close-line-circled text-white"></i>
                        </button>
                        {!! session()->get('success') !!}
                    </div>
                @endif
                   <div class="row">
                       @foreach ($plans as $plan)
                        <div class="col-lg-3 col-md-6 col-12 mt-4 pt-2">
                            <div class="card pricing-rates business-rate shadow bg-light border-0 rounded">
                                <div class="card-body">
                                    <h4 class="title text-uppercase mb-4">{{$plan->planName->name}}
                                        @if ($plan->id == Auth::user()->tenant->plan_id)
                                            <label for="" class="label label-danger">Current plan</label>
                                        @endif
                                    </h4>
                                    <div class="d-flex mb-4">
                                        <span class="h5 mb-0 mt-0">{{$plan->currency->symbol}}</span>
                                        <span class="price h5 mb-0">{{number_format($plan->price,2)}}</span>
                                        <span class="h5 align-self-end mb-1">/mo</span>
                                    </div>

                                    <p class="text-center text-muted">
                                        {{$plan->description}}
                                    </p>
                                    <p class="text-center">
                                        <a href="{{route('renew-membership', ['timestamp'=>sha1(time()), 'plan'=>$plan->slug])}}" class="btn btn-primary btn-mini mt-4">Buy Now</a>
                                    </p>
                                </div>
                            </div>
                        </div>
                       @endforeach

                   </div>
               </div>
           </div>
       </div>
   </div>
@endsection

@section('dialog-section')

@endsection

@section('extra-scripts')

@endsection
