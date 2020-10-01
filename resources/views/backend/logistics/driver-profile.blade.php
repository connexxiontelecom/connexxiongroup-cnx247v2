@extends('layouts.app')

@section('title')
    Driver Profile
@endsection

@section('extra-styles')

@endsection

@section('content')
<div class="content social-timeline">
    <div class="">
        <div class="row">
            <div class="col-xl-3 col-lg-4 col-md-4 col-xs-12">
                <div class="social-timeline-left" style="top:0px !important;">
                    <div class="card">
                        <div class="social-profile">
                            <img class="img-fluid width-100" src="\assets\images\social\profile.jpg" alt="">
                            <div class="profile-hvr">
                                <i class="icofont icofont-ui-edit p-r-10"></i>
                                <i class="icofont icofont-ui-delete"></i>
                            </div>
                        </div>
                        <div class="card-block social-follower">
                            <h4>{{$driver->first_name ?? ''}} {{$driver->surname ?? ''}}</h4>
                            <h5>{{$driver->driver_id}}</h5>
                            <div class="mt-3">
                                <button type="button" class="btn btn-outline-primary waves-effect btn-block"><i class="icofont icofont-ui-user m-r-10"></i> Add as Friend</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-xl-9 col-lg-8 col-md-8 col-xs-12 ">
                <!-- Nav tabs -->
                <div class="card social-tabs">
                    <ul class="nav nav-tabs md-tabs tab-timeline" role="tablist">
                        <li class="nav-item">
                            <a class="nav-link" data-toggle="tab" href="#about" role="tab">About</a>
                            <div class="slide"></div>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" data-toggle="tab" href="#photos" role="tab">Guarantor(s)</a>
                            <div class="slide"></div>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" data-toggle="tab" href="#friends" role="tab">Log</a>
                            <div class="slide"></div>
                        </li>
                    </ul>
                </div>
                <!-- Tab panes -->
                <div class="tab-content">
                    <!-- About tab start -->
                    <div class="tab-pane active" id="about">
                        <div class="row">
                            <div class="col-sm-12">
                                <div class="card">
                                    <div class="card-block">
                                        <h5 class="sub-title">Personal Information</h5>
                                        <div id="view-info" class="row">
                                            <div class="col-lg-6 col-md-12">
                                                <form>
                                                    <table class="table table-responsive m-b-0">
                                                        <tr>
                                                            <th class="social-label b-none p-t-0">Full Name
                                                            </th>
                                                            <td class="social-user-name b-none p-t-0 text-muted">{{$driver->first_name ?? ''}} {{$driver->surname ?? ''}}</td>
                                                        </tr>
                                                        <tr>
                                                            <th class="social-label b-none">Gender</th>
                                                            <td class="social-user-name b-none text-muted">{{$driver->gender == 1 ? 'Male' : 'Female'}}</td>
                                                        </tr>
                                                        <tr>
                                                            <th class="social-label b-none">Email Address</th>
                                                            <td class="social-user-name b-none text-muted">{{$driver->email ?? ''}}</td>
                                                        </tr>
                                                        <tr>
                                                            <th class="social-label b-none">Mobile No.</th>
                                                            <td class="social-user-name b-none text-muted">{{$driver->mobile_no ?? ''}}</td>
                                                        </tr>
                                                        <tr>
                                                            <th class="social-label b-none">Member Since</th>
                                                            <td class="social-user-name b-none text-muted">{{date(Auth::user()->tenant->dateFormat->format ?? 'd F, Y', strtotime($driver->created_at))}}</td>
                                                        </tr>
                                                        <tr>
                                                            <th class="social-label b-none p-b-0">Address</th>
                                                            <td class="social-user-name b-none p-b-0 text-muted">New York, USA</td>
                                                        </tr>
                                                    </table>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-12">
                                <div class="card">
                                    <div class="card-block">
                                        <button type="button" class="btn btn-mini btn-primary float-right mb-3" data-toggle="modal" data-target="#emergencyContactModal"><i class="ti-plus"></i> Add New Contact</button>
                                        <h5 class="sub-title">Emergency Contact</h5>
                                        <div id="contact-info" class="row">
                                            <div class="col-lg-6 col-md-12">
                                                <table class="table table-responsive m-b-0">
                                                    <tr>
                                                        <th class="social-label b-none p-t-0">Mobile Number</th>
                                                        <td class="social-user-name b-none p-t-0 text-muted">eg. (0123) - 4567891</td>
                                                    </tr>
                                                    <tr>
                                                        <th class="social-label b-none">Email Address</th>
                                                        <td class="social-user-name b-none text-muted"><a href="..\..\..\cdn-cgi\l\email-protection.htm" class="__cf_email__" data-cfemail="e195849295a1868c80888dcf828e8c">[email&#160;protected]</a></td>
                                                    </tr>
                                                    <tr>
                                                        <th class="social-label b-none">Twitter</th>
                                                        <td class="social-user-name b-none text-muted">@phonixcoded</td>
                                                    </tr>
                                                    <tr>
                                                        <th class="social-label b-none p-b-0">Skype</th>
                                                        <td class="social-user-name b-none p-b-0 text-muted">@phonixcoded demo</td>
                                                    </tr>
                                                </table>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-12">
                                <div class="card">
                                    <div class="card-block">
                                        <button type="button" class="btn btn-mini btn-primary float-right mb-3"><i class="ti-plus"></i> Add New Contact</button>
                                        <h5 class="sub-title">Next of Kin</h5>
                                        <div id="work-info" class="row">
                                            <div class="col-lg-6 col-md-12">
                                                <table class="table table-responsive m-b-0">
                                                    <tr>
                                                        <th class="social-label b-none p-t-0">Occupation &nbsp; &nbsp; &nbsp;
                                                        </th>
                                                        <td class="social-user-name b-none p-t-0 text-muted">Developer</td>
                                                    </tr>
                                                    <tr>
                                                        <th class="social-label b-none">Skills</th>
                                                        <td class="social-user-name b-none text-muted">C#, Javascript, Anguler</td>
                                                    </tr>
                                                    <tr>
                                                        <th class="social-label b-none">Jobs</th>
                                                        <td class="social-user-name b-none p-b-0 text-muted">#</td>
                                                    </tr>
                                                </table>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="tab-pane" id="photos">
                        <div class="card">
                                <div class="card-block">
                                    <div class="demo-gallery">
                                        <ul id="profile-lightgallery" class="row">
                                            <li class="col-md-4 col-lg-2 col-sm-6 col-xs-12">
                                                <a href="\assets\images\light-box\l1.jpg" data-toggle="lightbox" data-title="A random title" data-footer="A custom footer text">
                                            <img src="\assets\images\light-box\sl1.jpg" class="img-fluid" alt="">
                                        </a>
                                            </li>
                                            <li class="col-md-4 col-lg-2 col-sm-6 col-xs-12">
                                                <a href="\assets\images\light-box\l1.jpg" data-toggle="lightbox" data-title="A random title" data-footer="A custom footer text">
                                            <img src="\assets\images\light-box\sl1.jpg" class="img-fluid" alt="">
                                        </a>
                                            </li>
                                            <li class="col-md-4 col-lg-2 col-sm-6 col-xs-12">
                                                <a href="\assets\images\light-box\l1.jpg" data-toggle="lightbox" data-title="A random title" data-footer="A custom footer text">
                                            <img src="\assets\images\light-box\sl1.jpg" class="img-fluid" alt="">
                                        </a>
                                            </li>
                                            <li class="col-md-4 col-lg-2 col-sm-6 col-xs-12">
                                                <a href="\assets\images\light-box\l1.jpg" data-toggle="lightbox" data-title="A random title" data-footer="A custom footer text">
                                            <img src="\assets\images\light-box\sl1.jpg" class="img-fluid" alt="">
                                        </a>
                                            </li>
                                        </ul>
                                    </div>
                                </div>

                            <!-- Gallery end -->
                        </div>
                    </div>
                    <!-- Photos tab end -->
                    <!-- Friends tab start -->
                    <div class="tab-pane" id="friends">
                        <div class="row">
                            <div class="col-lg-12 col-xl-6">
                                <div class="card">
                                    <div class="card-block post-timelines">
                                        <span class="dropdown-toggle addon-btn text-muted f-right service-btn" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true" role="tooltip"></span>
                                        <div class="dropdown-menu dropdown-menu-right b-none services-list">
                                            <a class="dropdown-item" href="#">Remove tag</a>
                                            <a class="dropdown-item" href="#">Report Photo</a>
                                            <a class="dropdown-item" href="#">Hide From Timeline</a>
                                            <a class="dropdown-item" href="#">Blog User</a>
                                        </div>
                                        <div class="media bg-white d-flex">
                                            <div class="media-left media-middle">
                                                <a href="#">
                                            <img class="media-object" src="\assets\images\timeline\img2.png" alt="">
                                        </a>
                                            </div>
                                            <div class="media-body friend-elipsis">
                                                <div class="f-15 f-bold m-b-5">Josephin Doe</div>
                                                <div class="text-muted social-designation">Software Engineer</div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-12 col-xl-6">
                                <div class="card">
                                    <div class="card-block post-timelines">
                                        <span class="dropdown-toggle addon-btn text-muted f-right service-btn" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true" role="tooltip"></span>
                                        <div class="dropdown-menu dropdown-menu-right b-none services-list">
                                            <a class="dropdown-item" href="#">Remove tag</a>
                                            <a class="dropdown-item" href="#">Report Photo</a>
                                            <a class="dropdown-item" href="#">Hide From Timeline</a>
                                            <a class="dropdown-item" href="#">Blog User</a>
                                        </div>
                                        <div class="media bg-white d-flex">
                                            <div class="media-left media-middle">
                                                <a href="#">
                                            <img class="media-object" src="\assets\images\timeline\img2.png" alt="">
                                        </a>
                                            </div>
                                            <div class="media-body friend-elipsis">
                                                <div class="f-15 f-bold m-b-5">Josephin Doe</div>
                                                <div class="text-muted social-designation">Software Engineer</div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-12 col-xl-6">
                                <div class="card">
                                    <div class="card-block post-timelines">
                                        <span class="dropdown-toggle addon-btn text-muted f-right service-btn" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true" role="tooltip"></span>
                                        <div class="dropdown-menu dropdown-menu-right b-none services-list">
                                            <a class="dropdown-item" href="#">Remove tag</a>
                                            <a class="dropdown-item" href="#">Report Photo</a>
                                            <a class="dropdown-item" href="#">Hide From Timeline</a>
                                            <a class="dropdown-item" href="#">Blog User</a>
                                        </div>
                                        <div class="media bg-white d-flex">
                                            <div class="media-left media-middle">
                                                <a href="#">
                                            <img class="media-object" src="\assets\images\timeline\img2.png" alt="">
                                        </a>
                                            </div>
                                            <div class="media-body friend-elipsis">
                                                <div class="f-15 f-bold m-b-5">Josephin Doe</div>
                                                <div class="text-muted social-designation">Software Engineer</div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-12 col-xl-6">
                                <div class="card">
                                    <div class="card-block post-timelines">
                                        <span class="dropdown-toggle addon-btn text-muted f-right service-btn" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true" role="tooltip"></span>
                                        <div class="dropdown-menu dropdown-menu-right b-none services-list">
                                            <a class="dropdown-item" href="#">Remove tag</a>
                                            <a class="dropdown-item" href="#">Report Photo</a>
                                            <a class="dropdown-item" href="#">Hide From Timeline</a>
                                            <a class="dropdown-item" href="#">Blog User</a>
                                        </div>
                                        <div class="media bg-white d-flex">
                                            <div class="media-left media-middle">
                                                <a href="#">
                                            <img class="media-object" src="\assets\images\timeline\img2.png" alt="">
                                        </a>
                                            </div>
                                            <div class="media-body friend-elipsis">
                                                <div class="f-15 f-bold m-b-5">Josephin Doe</div>
                                                <div class="text-muted social-designation">Software Engineer</div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-12 col-xl-6">
                                <div class="card">
                                    <div class="card-block post-timelines">
                                        <span class="dropdown-toggle addon-btn text-muted f-right service-btn" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true" role="tooltip"></span>
                                        <div class="dropdown-menu dropdown-menu-right b-none services-list">
                                            <a class="dropdown-item" href="#">Remove tag</a>
                                            <a class="dropdown-item" href="#">Report Photo</a>
                                            <a class="dropdown-item" href="#">Hide From Timeline</a>
                                            <a class="dropdown-item" href="#">Blog User</a>
                                        </div>
                                        <div class="media bg-white d-flex">
                                            <div class="media-left media-middle">
                                                <a href="#">
                                            <img class="media-object" src="\assets\images\timeline\img2.png" alt="">
                                        </a>
                                            </div>
                                            <div class="media-body friend-elipsis">
                                                <div class="f-15 f-bold m-b-5">Josephin Doe</div>
                                                <div class="text-muted social-designation">Software Engineer</div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-12 col-xl-6">
                                <div class="card">
                                    <div class="card-block post-timelines">
                                        <span class="dropdown-toggle addon-btn text-muted f-right service-btn" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true" role="tooltip"></span>
                                        <div class="dropdown-menu dropdown-menu-right b-none services-list">
                                            <a class="dropdown-item" href="#">Remove tag</a>
                                            <a class="dropdown-item" href="#">Report Photo</a>
                                            <a class="dropdown-item" href="#">Hide From Timeline</a>
                                            <a class="dropdown-item" href="#">Blog User</a>
                                        </div>
                                        <div class="media bg-white d-flex">
                                            <div class="media-left media-middle">
                                                <a href="#">
                                            <img class="media-object" src="\assets\images\timeline\img2.png" alt="">
                                        </a>
                                            </div>
                                            <div class="media-body friend-elipsis">
                                                <div class="f-15 f-bold m-b-5">Josephin Doe</div>
                                                <div class="text-muted social-designation">Software Engineer</div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-12 col-xl-6">
                                <div class="card">
                                    <div class="card-block post-timelines">
                                        <span class="dropdown-toggle addon-btn text-muted f-right service-btn" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true" role="tooltip"></span>
                                        <div class="dropdown-menu dropdown-menu-right b-none services-list">
                                            <a class="dropdown-item" href="#">Remove tag</a>
                                            <a class="dropdown-item" href="#">Report Photo</a>
                                            <a class="dropdown-item" href="#">Hide From Timeline</a>
                                            <a class="dropdown-item" href="#">Blog User</a>
                                        </div>
                                        <div class="media bg-white d-flex">
                                            <div class="media-left media-middle">
                                                <a href="#">
                                            <img class="media-object" src="\assets\images\timeline\img2.png" alt="">
                                        </a>
                                            </div>
                                            <div class="media-body friend-elipsis">
                                                <div class="f-15 f-bold m-b-5">Josephin Doe</div>
                                                <div class="text-muted social-designation">Software Engineer</div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-12 col-xl-6">
                                <div class="card">
                                    <div class="card-block post-timelines">
                                        <span class="dropdown-toggle addon-btn text-muted f-right service-btn" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true" role="tooltip"></span>
                                        <div class="dropdown-menu dropdown-menu-right b-none services-list">
                                            <a class="dropdown-item" href="#">Remove tag</a>
                                            <a class="dropdown-item" href="#">Report Photo</a>
                                            <a class="dropdown-item" href="#">Hide From Timeline</a>
                                            <a class="dropdown-item" href="#">Blog User</a>
                                        </div>
                                        <div class="media bg-white d-flex">
                                            <div class="media-left media-middle">
                                                <a href="#">
                                            <img class="media-object" src="\assets\images\timeline\img2.png" alt="">
                                        </a>
                                            </div>
                                            <div class="media-body friend-elipsis">
                                                <div class="f-15 f-bold m-b-5">Josephin Doe</div>
                                                <div class="text-muted social-designation">Software Engineer</div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-12 col-xl-6">
                                <div class="card">
                                    <div class="card-block post-timelines">
                                        <span class="dropdown-toggle addon-btn text-muted f-right service-btn" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true" role="tooltip"></span>
                                        <div class="dropdown-menu dropdown-menu-right b-none services-list">
                                            <a class="dropdown-item" href="#">Remove tag</a>
                                            <a class="dropdown-item" href="#">Report Photo</a>
                                            <a class="dropdown-item" href="#">Hide From Timeline</a>
                                            <a class="dropdown-item" href="#">Blog User</a>
                                        </div>
                                        <div class="media bg-white d-flex">
                                            <div class="media-left media-middle">
                                                <a href="#">
                                            <img class="media-object" src="\assets\images\timeline\img2.png" alt="">
                                        </a>
                                            </div>
                                            <div class="media-body friend-elipsis">
                                                <div class="f-15 f-bold m-b-5">Josephin Doe</div>
                                                <div class="text-muted social-designation">Software Engineer</div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-12 col-xl-6">
                                <div class="card">
                                    <div class="card-block post-timelines">
                                        <span class="dropdown-toggle addon-btn text-muted f-right service-btn" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true" role="tooltip"></span>
                                        <div class="dropdown-menu dropdown-menu-right b-none services-list">
                                            <a class="dropdown-item" href="#">Remove tag</a>
                                            <a class="dropdown-item" href="#">Report Photo</a>
                                            <a class="dropdown-item" href="#">Hide From Timeline</a>
                                            <a class="dropdown-item" href="#">Blog User</a>
                                        </div>
                                        <div class="media bg-white d-flex">
                                            <div class="media-left media-middle">
                                                <a href="#">
                                            <img class="media-object" src="\assets\images\timeline\img2.png" alt="">
                                        </a>
                                            </div>
                                            <div class="media-body friend-elipsis">
                                                <div class="f-15 f-bold m-b-5">Josephin Doe</div>
                                                <div class="text-muted social-designation">Software Engineer</div>
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
    </div>
</div>
@endsection

@section('dialog-section')
<div class="modal fade" id="emergencyContactModal" tabindex="-1" role="dialog">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header bg-primary">
                <h6 class="modal-title">Add New Emergency Contact</h6>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true" class="text-white">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form>
                    <div class="form-group">
                        <label>Full Name</label>
                        <input type="text" name="full_name" id="full_name" placeholder="Full Name" class="form-control"/>
                    </div>
                    <div class="form-group">
                        <label>Mobile Number</label>
                        <input type="text" name="mobile_no" id="mobile_no" placeholder="Mobile Number" class="form-control"/>
                    </div>
                    <div class="form-group">
                        <label>Email Address</label>
                        <input type="text" name="email_address" id="email_address" placeholder="Email Address" class="form-control"/>
                    </div>
                    <div class="form-group">
                        <label>Relationship</label>
                        <input type="text" name="email_address" id="email_address" placeholder="Email Address" class="form-control"/>
                    </div>
                    <div class="form-group">
                        <label>Office/Residential Address</label>
                        <textarea placeholder="Office/Residential Address" name="address" id="address" class="form-control" style="resize:none;"></textarea>
                    </div>
                    <hr/>
                    <div class="form-group d-flex justify-content-center">
                        <button class="btn btn-mini btn-primary"><i class="ti-check mr-2"></i>Submit</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
@section('extra-scripts')

@endsection