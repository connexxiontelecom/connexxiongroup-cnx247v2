@extends('layouts.app')

@section('title')
    Vehicle Details > {{$vehicle->owner_name ?? ''}}
@endsection

@section('extra-styles')

@endsection

@section('content')
<div class="row">
    <div class="col-md-12 filter-bar">
        @include('backend.logistics.common._logistics-slab')
    </div>
</div>
<div class="row">
    <div class="col-md-12">
        <!-- Product detail page start -->
        <div class="card product-detail-page">
            <div class="card-block">
                <div class="row">
                    <div class="col-lg-5 col-xs-12">
                        <div class="port_details_all_img row">
                            <div class="col-lg-12 m-b-15">
                                <div id="big_banner">
                                    <div class="port_big_img">
                                        <img class="img img-fluid" src="/assets/uploads/logistics/vehicles/{{$vehicle->image ?? 'vehicle.png'}}" alt="{{$vehicle->owner_name ?? ''}}">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-7 col-xs-12 product-detail" id="product-detail">
                        <div class="row">
                            <div class="col-lg-12 col-md-12 col-sm-12">
                                <button class="btn btn-mini btn-primary float-right mb-2"><i class="zmdi zmdi-car-taxi mr-2"></i> Assign To Driver</button>
                                <table class="table">
                                    <tbody>
                                        <tr>
                                            <td class="col-lg-2"><strong>Owner Name:</strong> </td>
                                            <td class="col-lg-10">{{$vehicle->owner_name ?? ''}}</td>
                                        </tr>
                                        <tr>
                                            <td class="col-lg-2"><strong>Registration No.:</strong></td>
                                            <td class="col-lg-10">{{$vehicle->registration_no ?? ''}}</td>
                                        </tr>
                                        <tr>
                                            <td class="col-lg-2"><strong>Registration Date:</strong></td>
                                            <td class="col-lg-10">{{date('d F, Y', strtotime($vehicle->registration_date))}}</td>
                                        </tr>
                                        <tr>
                                            <td class="col-lg-2"><strong>Chassis No.:</strong></td>
                                            <td class="col-lg-10">{{$vehicle->chassis_no ?? ''}}</td>
                                        </tr>
                                        <tr>
                                            <td class="col-lg-2"><strong>Engine No.:</strong></td>
                                            <td class="col-lg-10">{{$vehicle->engine_no ?? ''}}</td>
                                        </tr>
                                        <tr>
                                            <td class="col-lg-2"><strong>Make/Model:</strong></td>
                                            <td class="col-lg-10">{{$vehicle->make_model ?? ''}}</td>
                                        </tr>
                                        <tr>
                                            <td class="col-lg-2"><strong>Date Added:</strong></td>
                                            <td class="col-lg-10"><label class="label label-primary">{{date('d F, Y', strtotime($vehicle->created_at))}}</label></td>
                                        </tr>
                                        <tr>
                                            <td class="col-lg-2"><strong>Assigned To:</strong></td>
                                            <td class="col-lg-10"><label class="label label-light">Driver Name</label></td>
                                        </tr>
                                        <tr>
                                            <td class="col-lg-2"><strong>Added By:</strong></td>
                                            <td class="col-lg-10"><label class="label label-warning">{{$vehicle->addedBy->first_name ?? ''}} {{$vehicle->addedBy->surname ?? ''}}</label></td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
                <hr>
                <div class="row">
                    <div class="col-sm-12 col-md-12 col-lg-12 d-flex justify-content-center">
                        <a href="{{route('logistics-vehicles')}}" class="btn btn-mini btn-secondary">Back To Vehicles</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="row">
    <div class="col-md-12 col-lg-12 col-sm-12">
        <div class="card">
            <div class="card-block">
                <h5 class="sub-title">Vehicle Assignment Log</h5>
                
            </div>
        </div>
    </div>
</div>
@endsection

@section('extra-scripts')

@endsection