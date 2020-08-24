@extends('layouts.app')

@section('title')
    Human Resource Dashboard
@endsection

@section('extra-styles')

@endsection

@section('content')
   <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-block">
                    <div class="row">
                        <div class="col-md-6 col-xl-3">
                            <div class="card user-widget-card bg-c-blue">
                                <div class="card-block">
                                    <i class="feather icon-users bg-simple-c-blue card1-icon"></i>
                                    <h4>{{ number_format($employees)}}</h4>
                                    <p>Employees</p>
                                    <a href="{{ route('employees') }}" class="more-info">More Info</a>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6 col-xl-3">
                            <div class="card user-widget-card bg-c-pink">
                                <div class="card-block">
                                    <i class="icofont icofont-tasks-alt bg-simple-c-pink card1-icon"></i>
                                    <h4><small>{{ number_format($attendance) }}</small>/{{number_format($employees)}}</h4>
                                    <p>Attendance</p>
                                    <a href="{{ route('attendance') }}" class="more-info">More Info</a>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6 col-xl-3">
                            <div class="card user-widget-card bg-c-green">
                                <div class="card-block">
                                    <i class="icofont icofont-people bg-simple-c-green card1-icon"></i>
                                    <h4>{{number_format($departments)}}</h4>
                                    <p>Departments</p>
                                    <a href="{{route('hr-configurations')}}" class="more-info">More Info</a>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6 col-xl-3">
                            <div class="card user-widget-card bg-c-yellow">
                                <div class="card-block">
                                    <i class="icofont icofont-files  bg-simple-c-yellow card1-icon"></i>
                                    <h4>652</h4>
                                    <p>On Leave</p>
                                    <a href="{{route('leave-management')}}" class="more-info">More Info</a>
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
        <div class="card table-card">
            <div class="card-header">
                <h5>Applications</h5>
                <div class="card-header-right">
                    <ul class="list-unstyled card-option">
                        <li><i class="feather icon-maximize full-card"></i></li>
                        <li><i class="feather icon-minus minimize-card"></i></li>
                        <li><i class="feather icon-trash-2 close-card"></i></li>
                    </ul>
                </div>
            </div>
            <div class="card-block">
                <div class="table-responsive">
                    <table class="table table-hover  table-borderless">
                        <thead>
                            <tr>
                                <th>
                                    <div class="chk-option">
                                        <div class="checkbox-fade fade-in-primary">
                                            <label class="check-task">
                                                <input type="checkbox" value="">
                                                <span class="cr">
                                                    <i class="cr-icon feather icon-check txt-default"></i>
                                                </span>
                                            </label>
                                        </div>
                                    </div>
                                    Applicant</th>
                                <th>Email</th>
                                <th>Mobile</th>
                                <th>Gender</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>
                                    <div class="chk-option">
                                        <div class="checkbox-fade fade-in-primary">
                                            <label class="check-task">
                                                <input type="checkbox" value="">
                                                <span class="cr">
                                                    <i class="cr-icon feather icon-check txt-default"></i>
                                                </span>
                                            </label>
                                        </div>
                                    </div>
                                    <div class="d-inline-block align-middle">
                                        <h6>Able Pro</h6>
                                        <p class="text-muted m-b-0">Powerful Admin Theme</p>
                                    </div>
                                </td>
                                <td>16,300</td>
                                <td><canvas id="app-sale1" height="50" width="100"></canvas></td>
                                <td>$53</td>
                                <td class="text-c-blue">$15,652</td>
                            </tr>
                            <tr>
                                <td>
                                    <div class="chk-option">
                                        <div class="checkbox-fade fade-in-primary">
                                            <label class="check-task">
                                                <input type="checkbox" value="">
                                                <span class="cr">
                                                    <i class="cr-icon feather icon-check txt-default"></i>
                                                </span>
                                            </label>
                                        </div>
                                    </div>
                                    <div class="d-inline-block align-middle">
                                        <h6>Photoshop</h6>
                                        <p class="text-muted m-b-0">Design Software</p>
                                    </div>
                                </td>
                                <td>26,421</td>
                                <td><canvas id="app-sale2" height="50" width="100"></canvas></td>
                                <td>$35</td>
                                <td class="text-c-blue">$18,785</td>
                            </tr>
                            <tr>
                                <td>
                                    <div class="chk-option">
                                        <div class="checkbox-fade fade-in-primary">
                                            <label class="check-task">
                                                <input type="checkbox" value="">
                                                <span class="cr">
                                                    <i class="cr-icon feather icon-check txt-default"></i>
                                                </span>
                                            </label>
                                        </div>
                                    </div>
                                    <div class="d-inline-block align-middle">
                                        <h6>Guruable</h6>
                                        <p class="text-muted m-b-0">Best Admin Template</p>
                                    </div>
                                </td>
                                <td>8,265</td>
                                <td><canvas id="app-sale3" height="50" width="100"></canvas></td>
                                <td>$98</td>
                                <td class="text-c-blue">$9,652</td>
                            </tr>
                            <tr>
                                <td>
                                    <div class="chk-option">
                                        <div class="checkbox-fade fade-in-primary">
                                            <label class="check-task">
                                                <input type="checkbox" value="">
                                                <span class="cr">
                                                    <i class="cr-icon feather icon-check txt-default"></i>
                                                </span>
                                            </label>
                                        </div>
                                    </div>
                                    <div class="d-inline-block align-middle">
                                        <h6>Flatable</h6>
                                        <p class="text-muted m-b-0">Admin App</p>
                                    </div>
                                </td>
                                <td>10,652</td>
                                <td><canvas id="app-sale4" height="50" width="100"></canvas></td>
                                <td>$20</td>
                                <td class="text-c-blue">$7,856</td>
                            </tr>
                        </tbody>
                    </table>
                    <div class="text-center">
                        <a href="#!" class=" b-b-primary text-primary">View all Projects</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

   <div class="row">
        <div class="col-xl-8 col-md-12">
            <div class="card latest-activity-card">
                <div class="card-header">
                    <h5>Latest Activity</h5>
                </div>
                <div class="card-block">
                    <div class="latest-update-box">
                        <div class="row p-t-20 p-b-30">
                            <div class="col-auto text-right update-meta">
                                <p class="text-muted m-b-0 d-inline">just now</p>
                                <i class="feather icon-sunrise bg-simple-c-blue update-icon"></i>
                            </div>
                            <div class="col">
                                <h6>John Deo</h6>
                                <p class="text-muted m-b-15">The trip was an amazing and a life changing experience!!</p>
                                <img src="..\files\assets\images\mega-menu\01.jpg" alt="" class="img-fluid img-100 m-r-15 m-b-10">
                                <img src="..\files\assets\images\mega-menu\03.jpg" alt="" class="img-fluid img-100 m-r-15 m-b-10">
                            </div>
                        </div>
                        <div class="row p-b-30">
                            <div class="col-auto text-right update-meta">
                                <p class="text-muted m-b-0 d-inline">5 min ago</p>
                                <i class="feather icon-file-text bg-simple-c-blue update-icon"></i>
                            </div>
                            <div class="col">
                                <h6>Administrator</h6>
                                <p class="text-muted m-b-0">Free courses for all our customers at A1 Conference Room - 9:00 am tomorrow!</p>
                            </div>
                        </div>
                        <div class="row p-b-30">
                            <div class="col-auto text-right update-meta">
                                <p class="text-muted m-b-0 d-inline">3 hours ago</p>
                                <i class="feather icon-map-pin bg-simple-c-blue update-icon"></i>
                            </div>
                            <div class="col">
                                <h6>Jeny William</h6>
                                <p class="text-muted m-b-15">Happy Hour! Free drinks at <span class="text-c-blue">Cafe-Bar all </span>day long!</p>
                                <div id="markers-map" style="height:200px;width:100%"></div>
                            </div>
                        </div>
                    </div>
                    <div class="text-right">
                        <a href="#!" class=" b-b-primary text-primary">View all Activity</a>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-xl-4 col-md-12">
            <div class="card feed-card">
                <div class="card-header">
                    <h5>Upcoming Deadlines</h5>
                    <div class="card-header-right">
                        <ul class="list-unstyled card-option">
                            <li><i class="fa fa fa-wrench open-card-option"></i></li>
                            <li><i class="fa fa-window-maximize full-card"></i></li>
                            <li><i class="fa fa-minus minimize-card"></i></li>
                            <li><i class="fa fa-refresh reload-card"></i></li>
                            <li><i class="fa fa-trash close-card"></i></li>
                        </ul>
                    </div>
                </div>
                <div class="card-block">
                    <div class="row m-b-25">
                        <div class="col-auto p-r-0">
                            <img src="..\files\assets\images\mega-menu\01.jpg" alt="" class="img-fluid img-50">
                        </div>
                        <div class="col">
                            <h6 class="m-b-5">New able - Redesign</h6>
                            <p class="text-c-pink m-b-0">2 Days Remaining</p>
                        </div>
                    </div>
                    <div class="row m-b-25">
                        <div class="col-auto p-r-0">
                            <img src="..\files\assets\images\mega-menu\02.jpg" alt="" class="img-fluid img-50">
                        </div>
                        <div class="col">
                            <h6 class="m-b-5">New Admin Dashboard</h6>
                            <p class="text-c-pink m-b-0">Proposal in 6 Days</p>
                        </div>
                    </div>
                    <div class="row m-b-25">
                        <div class="col-auto p-r-0">
                            <img src="..\files\assets\images\mega-menu\03.jpg" alt="" class="img-fluid img-50">
                        </div>
                        <div class="col">
                            <h6 class="m-b-5">Logo Design</h6>
                            <p class="text-c-green m-b-0">10 Days Remaining</p>
                        </div>
                    </div>
                    <div class="text-center">
                        <a href="#!" class="b-b-primary text-primary">View all Feeds</a>
                    </div>
                </div>
            </div>
            <div class="card feed-card">
                <div class="card-header">
                    <h5>Feeds</h5>
                </div>
                <div class="card-block">
                    <div class="row m-b-30">
                        <div class="col-auto p-r-0">
                            <i class="feather icon-bell bg-simple-c-blue feed-icon"></i>
                        </div>
                        <div class="col">
                            <h6 class="m-b-5">You have 3 pending tasks. <span class="text-muted f-right f-13">Just Now</span></h6>
                        </div>
                    </div>
                    <div class="row m-b-30">
                        <div class="col-auto p-r-0">
                            <i class="feather icon-shopping-cart bg-simple-c-pink feed-icon"></i>
                        </div>
                        <div class="col">
                            <h6 class="m-b-5">New order received <span class="text-muted f-right f-13">Just Now</span></h6>
                        </div>
                    </div>
                    <div class="row m-b-30">
                        <div class="col-auto p-r-0">
                            <i class="feather icon-file-text bg-simple-c-green feed-icon"></i>
                        </div>
                        <div class="col">
                            <h6 class="m-b-5">You have 3 pending tasks. <span class="text-muted f-right f-13">Just Now</span></h6>
                        </div>
                    </div>
                    <div class="row m-b-20">
                        <div class="col-auto p-r-0">
                            <i class="feather icon-shopping-cart bg-simple-c-pink feed-icon"></i>
                        </div>
                        <div class="col">
                            <h6 class="m-b-5">New order received <span class="text-muted f-right f-13">Just Now</span></h6>
                        </div>
                    </div>
                    <div class="text-center">
                        <a href="#!" class="b-b-primary text-primary">View all Feeds</a>
                    </div>
                </div>
            </div>
        </div>
   </div>


@endsection

@section('extra-scripts')

@endsection
