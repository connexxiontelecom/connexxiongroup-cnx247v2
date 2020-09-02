@extends('layouts.app')

@section('title')
    My Profile
@endsection

@section('extra-styles')
<link rel="stylesheet" type="text/css" href="\assets\pages\toolbar\jquery.toolbar.css">
<link rel="stylesheet" type="text/css" href="\assets\pages\toolbar\custom-toolbar.css">
@endsection

@section('content')
    @livewire('backend.user.my-profile')
    <div class="row" style="margin-top:-25px;">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-block accordion-block">
                    <div id="accordion" role="tablist" aria-multiselectable="true">
                        <div class="accordion-panel">
                            <div class="accordion-heading" role="tab" id="headingOne">
                                <h3 class="card-title accordion-title">
                                <a class="accordion-msg scale_active" data-toggle="collapse" data-parent="#accordion" href="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
                                    Personal Info
                                </a>
                            </h3>
                            </div>
                            <div id="collapseOne" class="panel-collapse collapse in" role="tabpanel" aria-labelledby="headingOne">
                                <div class="accordion-content accordion-desc">
                                    <div class="row">
                                        <div class="col-md-6">
                                            @if(Auth::check())
                                                <div class="table-responsive">
                                                    <table class="table m-0">
                                                        <tbody>
                                                            <tr>
                                                                <th scope="row" class="tx-11 text-uppercase" style="font-size:12px;">Full Name</th>
                                                                <td>{{Auth::user()->first_name ?? ''}} {{Auth::user()->surname ?? ''}} </td>
                                                            </tr>
                                                            <tr>
                                                                <th scope="row" class="tx-11 text-uppercase" style="font-size:12px;">Birth Date</th>
                                                                <td>October 25th, 1990</td>
                                                            </tr>
                                                            <tr>
                                                                <th scope="row" class="tx-11 text-uppercase" style="font-size:12px;">Email</th>
                                                                <td>{{Auth::user()->email ?? ''}}</td>
                                                            </tr>
                                                            <tr>
                                                                <th scope="row" class="tx-11 text-uppercase" style="font-size:12px;">Position</th>
                                                                <td>{{Auth::user()->position ?? '-'}}</td>
                                                            </tr>
                                                            <tr>
                                                                <th scope="row" class="tx-11 text-uppercase" style="font-size:12px;">Hire Date</th>
                                                                <td>{{date('d M, Y', strtotime(Auth::user()->hire_date)) ?? '-'}}</td>
                                                            </tr>
                                                            <tr>
                                                                <th scope="row" class="tx-11 text-uppercase" style="font-size:12px;">Start Date</th>
                                                                <td>{{date(Auth::user()->tenant->dateFormat->format ?? 'd F, Y', strtotime(Auth::user()->start_date))}}</td>
                                                            </tr>
                                                        </tbody>
                                                    </table>
                                                </div>
                                            @else
                                                {{route('signin')}}
                                            @endif

                                        </div>
                                        <div class="col-md-6">
                                            @if(Auth::check())
                                                <div class="table-responsive">
                                                    <table class="table m-0">
                                                        <tbody>
                                                            <tr>
                                                                <th scope="row" class="tx-11 text-uppercase" style="font-size:12px;">Gender</th>
                                                                <td>Female</td>
                                                            </tr>
                                                            <tr>
                                                                <th scope="row" class="tx-11 text-uppercase" style="font-size:12px;">Marital Status</th>
                                                                <td>Single</td>
                                                            </tr>
                                                            <tr>
                                                                <th scope="row" class="tx-11 text-uppercase" style="font-size:12px;">Mobile</th>
                                                                <td>{{Auth::user()->mobile ?? '-'}}</td>
                                                            </tr>
                                                            <tr>
                                                                <th scope="row" class="tx-11 text-uppercase" style="font-size:12px;">Department</th>
                                                                <td>{{Auth::user()->departmenet_id ?? '-'}}</td>
                                                            </tr>
                                                            <tr>
                                                                <th scope="row" class="tx-11 text-uppercase" style="font-size:12px;">Confirm Date</th>
                                                                <td>{{date('d M, Y', strtotime(Auth::user()->confirm_date)) ?? '-'}}</td>
                                                            </tr>
                                                            <tr>
                                                                <th scope="row" class="tx-11 text-uppercase" style="font-size:12px;">Address</th>
                                                                <td>{{Auth::user()->address}}</td>
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
                        <div class="accordion-panel">
                            <div class="accordion-heading" role="tab" id="headingTwo">
                                <h3 class="card-title accordion-title">
                                <a class="accordion-msg scale_active" data-toggle="collapse" data-parent="#accordion" href="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
                                    Work Experience
                                </a>
                            </h3>
                            </div>
                            <div id="collapseTwo" class="panel-collapse collapse" role="tabpanel" aria-labelledby="headingTwo">
                                <div class="accordion-content accordion-desc">
                                    <p>
                                        Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has
                                        survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset
                                        sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.
                                    </p>
                                </div>
                            </div>
                        </div>
                        <div class="accordion-panel">
                            <div class=" accordion-heading" role="tab" id="headingThree">
                                <h3 class="card-title accordion-title">
                                <a class="accordion-msg scale_active" data-toggle="collapse" data-parent="#accordion" href="#collapseThree" aria-expanded="false" aria-controls="collapseThree">
                                   Education
                                </a>
                            </h3>
                            </div>
                            <div id="collapseThree" class="panel-collapse collapse" role="tabpanel" aria-labelledby="headingThree">
                                <div class="accordion-content accordion-desc">
                                    <p>
                                        Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has
                                        survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset
                                        sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.
                                    </p>
                                </div>
                            </div>
                        </div>
                        <div class="accordion-panel">
                            <div class=" accordion-heading" role="tab" id="headingFour">
                                <h3 class="card-title accordion-title">
                                <a class="accordion-msg scale_active" data-toggle="collapse" data-parent="#accordion" href="#collapseFour" aria-expanded="false" aria-controls="collapseFour">
                                   Emergency Contact
                                </a>
                            </h3>
                            </div>
                            <div id="collapseFour" class="panel-collapse collapse" role="tabpanel" aria-labelledby="headingFour">
                                <div class="accordion-content accordion-desc">
                                    <p>
                                        Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has
                                        survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset
                                        sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.
                                    </p>
                                </div>
                            </div>
                        </div>
                        <div class="accordion-panel">
                            <div class=" accordion-heading" role="tab" id="headingFive">
                                <h3 class="card-title accordion-title">
                                <a class="accordion-msg scale_active" data-toggle="collapse" data-parent="#accordion" href="#collapseFive" aria-expanded="false" aria-controls="collapseFive">
                                   Next of Kin
                                </a>
                            </h3>
                            </div>
                            <div id="collapseFive" class="panel-collapse collapse" role="tabpanel" aria-labelledby="headingFive">
                                <div class="accordion-content accordion-desc">
                                    <p>
                                        Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has
                                        survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset
                                        sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.
                                    </p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection

@section('dialog-section')
    @include('backend.user.common._user-modals')
@endsection

@section('extra-scripts')
<script type="text/javascript" src="/assets/pages/accordion/accordion.js"></script>
<script type="text/javascript" src="/assets/bower_components/tinymce/tinymce.min.js"></script>
<script type="text/javascript" src="/assets/js/cus/tinymce.js"></script>
<script type="text/javascript" src="/assets/js/cus/profile.js"></script>
@stack('profile-script')
@endsection
