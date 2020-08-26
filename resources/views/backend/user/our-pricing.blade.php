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
               <div class="card-header">
                   <div class="sub-title">Our Pricing</div>
               </div>
               <div class="card-block">
                   <div class="row">
                       @foreach ($plans as $plan)
                        <div class="col-lg-3 col-md-6 col-12 mt-4 pt-2">
                            <div class="card pricing-rates business-rate shadow bg-light border-0 rounded">
                                <div class="card-body">
                                    <h2 class="title text-uppercase mb-4">{{$plan->planName->name}}</h2>
                                    <div class="d-flex mb-4">
                                        <span class="h5 mb-0 mt-0">{{$plan->currency->symbol}}</span>
                                        <span class="price h5 mb-0">{{number_format($plan->price,2)}}</span>
                                        <span class="h5 align-self-end mb-1">/mo</span>
                                    </div>

                                    <p class="text-center text-muted">
                                        {{$plan->description}}
                                    </p>
                                    <p class="text-center">
                                        <a href="{{route('create-site', ['timestamp'=>sha1(time()), 'plan'=>$plan->slug])}}" target="_blank" class="btn btn-primary btn-mini mt-4">Buy Now</a>
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
