@extends('layouts.app')

@section('title')
    {{$user->first_name ?? ''}} {{$user->surname ?? '' }}'s Profile
@endsection

@section('extra-styles')
<link rel="stylesheet" type="text/css" href="\assets\pages\toolbar\jquery.toolbar.css">
<link rel="stylesheet" type="text/css" href="\assets\pages\toolbar\custom-toolbar.css">
@endsection

@section('content')
<div class="card">

    <div class="row">
        <div class="col-lg-12">
            <div class="cover-profile">
                <div class="profile-bg-img">
                    <img class="profile-bg-img img-fluid" src="/assets/images/cover-photos/{{$user->cover ?? 'cover.jpeg'}}" width="1202" height="217" alt="{{$user->first_name ?? ''}}">
                    <div class="card-block user-info">
                        <div class="col-md-12">
                            <div class="media-left">
                                <a href="{{url()->current()}}" class="profile-image">
                                    <img height="108" width="108" class="user-img img-radius" src="/assets/images/avatars/medium/{{$user->avatar ?? 'avatar.png'}}" alt="{{$user->first_name ?? ''}}">
                                </a>
                            </div>
                            <div class="media-body row">
                                <div class="col-lg-12">
                                    <div class="user-title">
                                        <h2>{{$user->first_name ?? ''}} {{$user->surname ?? ''}}</h2>
                                        <span class="text-white">{{$user->position ?? ''}}</span>

                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-12">
            <div class="btn-group ml-3">
                <a href="{{route('chat-n-calls')}}" class="btn btn-mini btn-light"><i class="ti-comments"></i>  Chat</a>
                <a href="{{url()->previous()}}" class="btn btn-mini btn-secondary text-white"><i class="ti-back-left"></i>  Back</a>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-lg-12 col-xl-12 col-md-12">
            @include('backend.activity-stream.common._profile-slab')
        </div>
    </div>
</div>

    <div class="card" style="margin-top:-25px;">
        <div class="card-block">
            <div class="row">
                <div class="col-md-12 col-lg-12 col-xl-12">
                    <div class="tab-pane active" id="home" role="tabpanel">
                        @if(Auth::check())
                            <div class="table-responsive">
                                <table class="table m-0">
                                    <tbody>
                                        <tr>
                                            <th scope="row" class="tx-11 text-uppercase" style="font-size:12px;">Full Name</th>
                                            <td>{{$user->first_name ?? ''}} {{$user->surname ?? ''}} </td>
                                        </tr>
                                        <tr>
                                            <th scope="row" class="tx-11 text-uppercase" style="font-size:12px;">Gender</th>
                                            <td>Female</td>
                                        </tr>
                                        <tr>
                                            <th scope="row" class="tx-11 text-uppercase" style="font-size:12px;">Birth Date</th>
                                            <td>October 25th, 1990</td>
                                        </tr>
                                        <tr>
                                            <th scope="row" class="tx-11 text-uppercase" style="font-size:12px;">Marital Status</th>
                                            <td>Single</td>
                                        </tr>
                                        <tr>
                                            <th scope="row" class="tx-11 text-uppercase" style="font-size:12px;">Email</th>
                                            <td>{{$user->email ?? ''}}</td>
                                        </tr>
                                        <tr>
                                            <th scope="row" class="tx-11 text-uppercase" style="font-size:12px;">Mobile</th>
                                            <td>{{$user->mobile ?? '-'}}</td>
                                        </tr>
                                        <tr>
                                            <th scope="row" class="tx-11 text-uppercase" style="font-size:12px;">Position</th>
                                            <td>{{$user->position ?? '-'}}</td>
                                        </tr>
                                        <tr>
                                            <th scope="row" class="tx-11 text-uppercase" style="font-size:12px;">Department</th>
                                            <td>{{$user->departmenet_id ?? '-'}}</td>
                                        </tr>
                                        <tr>
                                            <th scope="row" class="tx-11 text-uppercase" style="font-size:12px;">Hire Date</th>
                                            <td>{{date('d M, Y', strtotime($user->hire_date)) ?? '-'}}</td>
                                        </tr>
                                        <tr>
                                            <th scope="row" class="tx-11 text-uppercase" style="font-size:12px;">Confirm Date</th>
                                            <td>{{date('d M, Y', strtotime($user->confirm_date)) ?? '-'}}</td>
                                        </tr>
                                        <tr>
                                            <th scope="row" class="tx-11 text-uppercase" style="font-size:12px;">Address</th>
                                            <td>{{$user->address}}</td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        @else
                            {{route('signin')}}
                        @endif

                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('dialog-section')

@endsection

@section('extra-scripts')
<script type="text/javascript" src="/assets/pages/accordion/accordion.js"></script>
<script type="text/javascript" src="/assets/bower_components/tinymce/tinymce.min.js"></script>
<script type="text/javascript" src="/assets/js/cus/tinymce.js"></script>
<script type="text/javascript" src="/assets/js/cus/profile.js"></script>
@stack('profile-script')
@endsection
