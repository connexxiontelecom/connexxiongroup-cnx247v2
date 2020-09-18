@extends('layouts.frontend-layout')

@section('title')
    Settings
@endsection

@section('extra-styles')
    <style>
        .card{
            border-radius: 0px !important;
        }
    </style>
@endsection

@section('content')
       @include('frontend.procurement.partials._header-menu')
        <section class="section mt-60">
            <div class="container mt-lg-3">
                <div class="row">
                    <div class="col-lg-12 col-12">

                        <div class="border-bottom pb-4">
                            <div class="row">
                                <div class="col-md-6 mt-4">
                                    <h5>Company Settings</h5>
                                    <form action="">
                                        @csrf
                                        <div class="mt-4">
                                            <div class="col-md-12">
                                                <div class="form-group position-relative">
                                                    <label>Office Email <span class="text-danger">*</span></label>
                                                    <i data-feather="mail" class="fea icon-sm icons"></i>
                                                    <input name="office_email" id="office_email" type="email" class="form-control pl-5" placeholder="Office Email">
                                                    @error('office_email')
                                                        <i class="text-danger mr-2">{{$message}}</i>
                                                    @enderror
                                                    <small class="text-muted"><span class="text-danger">Note: </span> This email address will be required to login.</small>
                                                </div>
                                            </div>
                                            <div class="col-md-12">
                                                <div class="form-group position-relative">
                                                    <label>Office Phone <span class="text-danger">*</span></label>
                                                    <i data-feather="phone" class="fea icon-sm icons"></i>
                                                    <input name="office_phone" id="office_phone" type="text" class="form-control pl-5" placeholder="Office Phone">
                                                    @error('office_phone')
                                                        <i class="text-danger mr-2">{{$message}}</i>
                                                    @enderror
                                                </div>
                                            </div>
                                            <div class="col-md-12">
                                                <div class="form-group position-relative">
                                                    <label>Website<span class="text-danger">*</span></label>
                                                    <i data-feather="globe" class="fea icon-sm icons"></i>
                                                    <input name="website" id="website" type="text" class="form-control pl-5" placeholder="Website">
                                                    @error('website')
                                                        <i class="text-danger mr-2">{{$message}}</i>
                                                    @enderror
                                                </div>
                                            </div>
                                            <div class="col-md-12">
                                                <div class="form-group position-relative">
                                                    <label>Tagline<span class="text-danger">*</span></label>
                                                    <i data-feather="message-square" class="fea icon-sm icons"></i>
                                                    <textarea name="tagline" id="tagline" type="text" class="form-control pl-5" style="resize: none;" placeholder="Tagline"></textarea>
                                                    @error('tagline')
                                                        <i class="text-danger mr-2">{{$message}}</i>
                                                    @enderror
                                                </div>
                                            </div>
                                            <div class="col-md-12">
                                                <div class="form-group position-relative">
                                                    <label>Office Address<span class="text-danger">*</span></label>
                                                    <i data-feather="map-pin" class="fea icon-sm icons"></i>
                                                    <textarea name="office_address" id="office_address" type="text" class="form-control pl-5" style="resize: none;" placeholder="Office Address"></textarea>
                                                    @error('office_address')
                                                        <i class="text-danger mr-2">{{$message}}</i>
                                                    @enderror
                                                </div>
                                            </div>
                                            <div class="col-md-12">
                                                <div class="btn-group">
                                                    <a href="{{url()->previous()}}" class="btn btn-outline-dark mt-2 mr-2">Cancel</a>
                                                    <button type="submit" class="btn btn-outline-primary mt-2 mr-2">Save changes</button>
                                                </div>
                                            </div>
                                        </div>
                                    </form>
                                </div>

                                <div class="col-md-6 mt-4 pt-2 pt-sm-0">
                                    <h5>Contact Person Settings</h5>
                                    @foreach (Auth::user()->orderSupplier()->orderBy('id', 'DESC')->take(3)->get() as $order)
                                        <div class="media key-feature align-items-center p-3 rounded shadow mt-4">
                                            <img src="images/job/Circleci.svg" class="avatar avatar-ex-sm" alt="">
                                            <div class="media-body content ml-3">
                                                <a href="{{route('my-purchase-orders', $order->slug)}}" class="text-secondary">
                                                    <h4 class="title mb-0">PO Number: {{$order->purchase_order_no}}</h4>
                                                </a>
                                                @if ($order->status == 'in-progress')
                                                    <a href="javascript:void(0);" class="badge badge-warning badge-pill float-right"> {{$order->status}} </a>
                                                @elseif($order->status == 'approved')
                                                    <a href="javascript:void(0);" class="badge badge-primary badge-pill float-right"> {{$order->status}} </a>
                                                @elseif($order->status == 'delivered')
                                                    <a href="javascript:void(0);" class="badge badge-success badge-pill float-right"> {{$order->status}} </a>
                                                @else
                                                    <a href="javascript:void(0);" class="badge badge-danger badge-pill float-right"> {{$order->status}} </a>

                                                @endif
                                                <p class="text-muted mb-0">{{$order->orderedBy->tenant->currency->symbol}}{{number_format($order->total)}}</p>
                                                <p class="text-muted mb-0"><a href="javascript:void(0)" class="text-primary">Requested by: </a> {{$order->orderedBy->first_name ?? ''}} {{$order->orderedBy->surname ?? '' }} <small class="badge badge-pill badge-outline-primary"> From </small> {{$order->orderedBy->tenant->company_name ?? ''}}</p>
                                            </div>
                                        </div>
                                    @endforeach
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
@endsection
