@extends('layouts.app')

@section('title')
    Tenants Financials
@endsection

@section('extra-styles')
    <!-- Chartlist chart css -->
    <link rel="stylesheet" href="/assets/bower_components/chartist/css/chartist.css" type="text/css" media="all">
@endsection

@section('content')
<div class="row">
    <div class="col-md-12">
        <div class="card">
            <div class="card-block">
                @include('backend.admin.common._nav-slab')
            </div>
        </div>

    </div>
</div>
<div class="row">
    <div class="col-md-6 col-xl-3">
        <div class="card widget-card-1">
            <div class="card-block-small">
                <i class="icofont icofont-money-bag bg-c-yellow card1-icon"></i>
                <span class="text-c-yellow f-w-600">Revenue</span>
                <h5>₦{{number_format(($overall/100),2)}}</h5>
                <div>
                    <span class="f-left m-t-10 text-muted">
                        <i class="text-c-yellow f-16 ti-calendar m-r-10"></i>Overall
                    </span>
                </div>
            </div>
        </div>
    </div>
    <div class="col-md-6 col-xl-3">
        <div class="card widget-card-1">
            <div class="card-block-small">
                <i class="icofont icofont-money-bag bg-c-pink card1-icon"></i>
                <span class="text-c-pink f-w-600">Revenue</span>
                <h5>₦{{number_format(($lastMonth/100),2)}}</h5>
                <div>
                    <span class="f-left m-t-10 text-muted">
                        <i class="text-c-pink f-16 ti-calendar m-r-10"></i>Last Month
                    </span>
                </div>
            </div>
        </div>
    </div>
    <div class="col-md-6 col-xl-3">
        <div class="card widget-card-1">
            <div class="card-block-small">
                <i class="icofont icofont-money-bag bg-c-blue card1-icon"></i>
                <span class="text-c-blue f-w-600">Revenue</span>
                <h5>₦{{number_format(($thisMonth/100),2)}}</h5>
                <div>
                    <span class="f-left m-t-10 text-muted">
                        <i class="text-c-blue f-16 ti-calendar m-r-10"></i>This Month
                    </span>
                </div>
            </div>
        </div>
    </div>
    <div class="col-md-6 col-xl-3">
        <div class="card widget-card-1">
            <div class="card-block-small">
                <i class="icofont icofont-money-bag bg-c-green card1-icon"></i>
                <span class="text-c-green f-w-600">Revenue</span>
                <h5>₦{{number_format(($thisWeek/100),2)}}</h5>
                <div>
                    <span class="f-left m-t-10 text-muted">
                        <i class="text-c-green f-16 ti-calendar m-r-10"></i>This Week
                    </span>
                </div>
            </div>
        </div>
    </div>

</div>
   <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-block">
                    <div class="card-header">
                        @if (session()->has('success'))
                        <div class="alert alert-success background-success mt-3">
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                <i class="icofont icofont-close-line-circled text-white"></i>
                            </button>
                            {!! session()->get('success') !!}
                        </div>
                    @endif
                    </div>
                    <div class="row">
                        <div class="col-xl-8">
                            <div class="card">
                                <div class="card-header">
                                    <h5>Weekly Performance</h5>
                                    <span>Pricing plan comparison for the week.</span>

                                </div>
                                <div class="card-block">
                                    <div id="main" style="height:300px"></div>
                                </div>
                            </div>
                        </div>
                        <div class="col-xl-4">
                            <div class="card">
                                <div class="card-header">
                                    <h5>Tenants</h5>
                                    <span>Top 5 Contributing tenants</span>

                                </div>
                                <div class="card-block">
                                    <div id="pie-chart" style="height:300px"></div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12 col-lg-12">
                            <div class="card">
                                <div class="card-header">
                                    <h5>Monthly performance</h5>
                                    <span>This year's monthly performance (revenue)</span>
                                </div>
                                <div class="card-block">
                                    <div id="placeholder" class="demo-placeholder" style="height:300px;"></div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="card">
                                <div class="card-header">
                                    <h5>Revenue Chart</h5>
                                    <span>Revenue comparison across different pricing plans.</span>

                                </div>
                                <div class="card-block">
                                    <div id="morris-extra-area"></div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
   </div>
@endsection

@section('extra-scripts')
<script src="/assets/bower_components/raphael/js/raphael.min.js"></script>
<script src="/assets/bower_components/morris.js/js/morris.js"></script>
<script src="/assets/pages/chart/morris/morris-custom-chart.js"></script>

<script src="\assets\pages\chart\echarts\js\echarts-all.js" type="text/javascript"></script>
<script type="text/javascript" src="\assets\pages\chart\echarts\echart-custom.js"></script>

<script src="\assets\pages\chart\float\jquery.flot.js"></script>
<script src="\assets\pages\chart\float\jquery.flot.categories.js"></script>
<script src="\assets\pages\chart\float\jquery.flot.pie.js"></script>

<script type="text/javascript" src="\assets\js\cus\float-chart-custom.js"></script>
@endsection
