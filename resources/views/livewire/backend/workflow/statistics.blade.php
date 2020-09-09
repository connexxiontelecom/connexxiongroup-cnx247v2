<div>
    <div class="row">
        <div class="col-md-6 col-xl-3">
            <div class="card widget-card-1">
                <div class="card-block-small">
                    <i class="icofont icofont-diamond bg-c-yellow card1-icon"></i>
                    <span class="text-c-yellow f-w-600">Requisition</span>
                    <h4>{{number_format($overall)}}</h4>
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
                    <i class="icofont icofont-diamond bg-c-pink card1-icon"></i>
                    <span class="text-c-pink f-w-600">Requisition</span>
                    <h4>{{number_format($thisYear)}}</h4>
                    <div>
                        <span class="f-left m-t-10 text-muted">
                            <i class="text-c-pink f-16 ti-calendar m-r-10"></i>This Year
                        </span>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-6 col-xl-3">
            <div class="card widget-card-1">
                <div class="card-block-small">
                    <i class="icofont icofont-diamond bg-c-green card1-icon"></i>
                    <span class="text-c-green f-w-600">Requisition</span>
                    <h4>{{number_format($lastMonth)}}</h4>
                    <div>
                        <span class="f-left m-t-10 text-muted">
                            <i class="text-c-green f-16 ti-calendar m-r-10"></i>Last Month
                        </span>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-6 col-xl-3">
            <div class="card widget-card-1">
                <div class="card-block-small">
                    <i class="icofont icofont-diamond bg-c-blue card1-icon"></i>
                    <span class="text-c-blue f-w-600">Requisition</span>
                    <h4>{{number_format($thisMonth)}}</h4>
                    <div>
                        <span class="f-left m-t-10 text-muted">
                            <i class="text-c-blue f-16 ti-calendar m-r-10"></i>This Month
                        </span>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-12">
            <div class="card">
                <div class="card-block">
                    <div class="row">

                        <div class="col-sm-6">
                            <h2 class="d-inline-block text-c-green m-r-10">897</h2>
                            <div class="d-inline-block">
                                <p class="m-b-0"><i class="feather icon-chevrons-down m-r-10 text-c-pink"></i>10%</p>
                                <p class="text-muted m-b-0">Total Users</p>
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <h2 class="d-inline-block text-c-pink m-r-10">8456</h2>
                            <div class="d-inline-block">
                                <p class="m-b-0"><i class="feather icon-chevrons-up m-r-10 text-c-green"></i>87%</p>
                                <p class="text-muted m-b-0">Total Views</p>
                            </div>
                        </div>
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
                            <div class="col-sm-12">
                                <div class="card">
                                    <div class="card-header">
                                        <h5>Memberships</h5>
                                        <span>A run-down of all tenant subscription.</span>

                                    </div>
                                    <div class="card-block">
                                        <div class="dt-responsive table-responsive">
                                            <table id="simpletable" class="table table-striped table-bordered nowrap">
                                                <thead>
                                                <tr>
                                                    <th>#</th>
                                                    <th>Company Name</th>
                                                    <th>Start Date</th>
                                                    <th>End Date</th>
                                                    <th>Plan</th>
                                                    <th>Days</th>
                                                    <th>Status</th>
                                                    <th>Action</th>
                                                </tr>
                                                </thead>
                                                <tbody>
                                                    @php
                                                        $serial = 1;
                                                    @endphp

                                                </tbody>
                                                <tfoot>
                                                <tr>
                                                    <th>#</th>
                                                    <th>Company Name</th>
                                                    <th>Start Date</th>
                                                    <th>End Date</th>
                                                    <th>Plan</th>
                                                    <th>Days</th>
                                                    <th>Status</th>
                                                    <th>Action</th>
                                                </tr>
                                                </tfoot>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
</div>
