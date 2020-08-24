<div>
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-block">
                    <h4 class="sub-title">Tickets</h4>
                    <div class="btn-group d-flex justify-content-end">
                        <a href="{{route('ticket')}}" class="btn btn-mini btn-primary" type="button"><i class="ti-plus"></i> New Support Ticket</a>
                        <a href="{{route('ticket-history')}}" class="btn btn-mini btn-danger"><i class="ti-support"></i> Ticket History</a>
                    </div>
                    @if (session()->has('success'))
                        <div class="alert alert-success background-success mt-3">
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                <i class="icofont icofont-close-line-circled text-white"></i>
                            </button>
                            {!! session()->get('success') !!}
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>

    <div class="card" style="margin-top:-30px;">
        <div class="card-block email-card">
            <div class="row">
                <div class="col-xl-4">
                    <!-- Overall Progress card start -->
                    <div class="card">
                        <div class="card-block">
                            <!-- <p>.col-sm-4</p> -->
                            <div class="issue-list-progress">
                                <h6>Overall Progress</h6>
                                <div class="issue-progress">
                                    <div class="progress">
                                        <span class="issue-text1 txt-primary"></span>
                                        <div class="issue-bar1 bg-primary"></div>
                                    </div>
                                    <!-- end of progress -->
                                </div>
                                <!-- end of issue progress -->
                            </div>
                            <!-- end of issue list progress -->

                            <!-- end of matric progress -->
                            <table class="table matrics-table">
                                <tbody>
                                    <tr>
                                        <td>
                                            <strong>Assigned Hours</strong>
                                        </td>
                                        <td class="txt-primary">70 Hours</td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <strong>Time Consumed</strong>
                                        </td>
                                        <td class="txt-danger">49 Hours</td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <strong>Issues</strong>
                                        </td>
                                        <td class="txt-primary">19</td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <strong>Bugs</strong>
                                        </td>
                                        <td class="txt-primary">16</td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <strong>Health</strong>
                                        </td>
                                        <td class="txt-success">75%</td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <strong>Commits</strong>
                                        </td>
                                        <td class="txt-primary">280</td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <strong>Bugs Percentage</strong>
                                        </td>
                                        <td class="txt-danger">25%</td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <strong>Assign Date</strong>
                                        </td>
                                        <td class="txt-info">02/11/2016</td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <strong>Last closed on</strong>
                                        </td>
                                        <td class="txt-info">15/01/2017</td>
                                    </tr>
                                </tbody>
                                <!-- end of tbody -->
                            </table>
                            <!-- end of table -->
                        </div>
                    </div>
                    <!-- Overall Progress card stendart -->
                </div>
                <div class="col-xl-8">
                    <!-- New ticket button card start -->
                    <div class="card">
                        <div class="card-block">
                            <div class=" waves-effect waves-light m-r-10 v-middle issue-btn-group">
                                <button type="button" class="btn btn-sm btn-success btn-new-tickets waves-effect waves-light m-r-15 m-b-5 m-t-5"><i class="icofont icofont-paper-plane"></i><span class="m-l-10">New Tickets</span></button>
                                <div class="btn-group m-b-5 m-t-5">
                                    <button type="button" class="btn btn-primary btn-sm waves-effect waves-light"><i class="icofont icofont-ui-user"></i></button>
                                    <button type="button" class="btn btn-primary btn-sm waves-effect waves-light"><i class="icofont icofont-edit-alt"></i></button>
                                    <button type="button" class="btn btn-primary btn-sm waves-effect waves-light"><i class="icofont icofont-reply"></i></button>
                                    <button type="button" class="btn btn-primary btn-sm waves-effect waves-light"><i class="icofont icofont-printer"></i></button>
                                </div>
                                <div class="f-right bug-issue-link m-t-5">
                                    <ol class="breadcrumb bg-white m-0 p-t-5 p-b-0">
                                        <li class="breadcrumb-item"><a href="#">16 Bugs</a></li>
                                        <li class="breadcrumb-item"><a href="#">19 Issue</a></li>
                                    </ol>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- New ticket button card end -->
                    <!-- bug list card start -->
                    <div class="card">
                        <div class="card-header">
                            <h5>Zero Configuration</h5>
                            <div class="card-header-right">
                                <i class="icofont icofont-spinner-alt-5"></i>
                            </div>
                        </div>
                        <div class="card-block">
                            <div class="table-responsive">
                                <table id="issue-list-table" class="table dt-responsive width-100">
                                    <thead class="text-left">
                                        <tr>
                                            <th>Type</th>
                                            <th>#ID</th>
                                            <th>Description</th>
                                            <th>Start date</th>
                                            <th>Priority</th>
                                            <th>Assigned</th>
                                            <th>Status</th>
                                        </tr>
                                    </thead>
                                    <tbody class="text-left">
                                        <tr>
                                            <td class="txt-primary">Bug</td>
                                            <td>PI:198756541080</td>
                                            <td>Software Run Failure</td>
                                            <td>2015/01/10</td>
                                            <td><span class="label label-danger">Highest</span></td>
                                            <td><a href="#">Katerina larson</a></td>
                                            <td><span class="label label-primary">Open</span></td>
                                        </tr>
                                        <tr>
                                            <td class="txt-primary">Bug</td>
                                            <td>PI:198756897280</td>
                                            <td>Server Randering</td>
                                            <td>2015/04/22</td>
                                            <td><span class="label label-success">Normal</span></td>
                                            <td><a href="#">Mitchell Jones</a></td>
                                            <td><span class="label label-danger">Close</span></td>
                                        </tr>
                                        <tr>
                                            <td class="txt-primary">Bug</td>
                                            <td>PI:198773249750</td>
                                            <td>Cluster Load Balancing</td>
                                            <td>2015/01/10</td>
                                            <td><span class="label label-info">Slow</span></td>
                                            <td><a href="#">Michal Marshell</a></td>
                                            <td><span class="label label-warning">Pending</span></td>
                                        </tr>
                                        <tr>
                                            <td class="txt-primary">Bug</td>
                                            <td>PI:197016541230</td>
                                            <td>Data Mirroring Error</td>
                                            <td>2015/01/10</td>
                                            <td><span class="label label-warning">High</span></td>
                                            <td><a href="#">Tiger Nixon</a></td>
                                            <td><span class="label label-danger">Close</span></td>
                                        </tr>
                                        <tr>
                                            <td class="txt-primary">Bug</td>
                                            <td>PI:282256541230</td>
                                            <td>Software Run Failure</td>
                                            <td>2015/01/10</td>
                                            <td><span class="label label-success">Normal</span></td>
                                            <td><a href="#">Raghuvinder Singh</a></td>
                                            <td><span class="label label-primary">Open</span></td>
                                        </tr>
                                        <tr>
                                            <td class="txt-primary">Bug</td>
                                            <td>PI:382906541279</td>
                                            <td>Package Fatal Error</td>
                                            <td>2015/01/10</td>
                                            <td><span class="label label-warning">High</span></td>
                                            <td><a href="#">Alex standoman</a></td>
                                            <td><span class="label label-warning">Pending</span></td>
                                        </tr>
                                        <tr>
                                            <td class="txt-primary">Bug</td>
                                            <td>PI:497056541220</td>
                                            <td>Server Authontication Error</td>
                                            <td>2015/01/10</td>
                                            <td><span class="label label-warning">High</span></td>
                                            <td><a href="#">Roya Hamad</a></td>
                                            <td><span class="label label-warning">Pending</span></td>
                                        </tr>
                                        <tr>
                                            <td class="txt-primary">Bug</td>
                                            <td>PI:198756541230</td>
                                            <td>Software Run Failure</td>
                                            <td>2015/01/10</td>
                                            <td><span class="label label-danger">Highest</span></td>
                                            <td><a href="#">Carry Mathison</a></td>
                                            <td><span class="label label-primary">Open</span></td>
                                        </tr>
                                        <tr>
                                            <td class="txt-primary">Bug</td>
                                            <td>PI:198756541230</td>
                                            <td>Software Run Failure</td>
                                            <td>2015/01/10</td>
                                            <td><span class="label label-danger">Highest</span></td>
                                            <td><a href="#">Dugless hole</a></td>
                                            <td><span class="label label-info">On Hold</span></td>
                                        </tr>
                                        <tr>
                                            <td class="txt-primary">Bug</td>
                                            <td>PI:198756541230</td>
                                            <td>Package Security Failure</td>
                                            <td>2015/01/10</td>
                                            <td><span class="label label-info">slow</span></td>
                                            <td><a href="#">Tiger Nixon</a></td>
                                            <td><span class="label label-danger">Close</span></td>
                                        </tr>
                                        <tr>
                                            <td class="txt-primary">Bug</td>
                                            <td>PI:198756541230</td>
                                            <td>Software Run Failure</td>
                                            <td>2015/01/10</td>
                                            <td><span class="label label-warning">High</span></td>
                                            <td><a href="#">Tiger Nixon</a></td>
                                            <td><span class="label label-info">On hold</span></td>
                                        </tr>
                                        <tr>
                                            <td class="txt-primary">Bug</td>
                                            <td>PI:198756541230</td>
                                            <td>Software Run Failure</td>
                                            <td>2015/01/10</td>
                                            <td><span class="label label-info">slow</span></td>
                                            <td><a href="#">Tiger Nixon</a></td>
                                            <td><span class="label label-warning">Pending</span></td>
                                        </tr>
                                        <tr>
                                            <td class="txt-primary">Bug</td>
                                            <td>PI:198756541230</td>
                                            <td>Software Run Failure</td>
                                            <td>2015/01/10</td>
                                            <td><span class="label label-success">Normal</span></td>
                                            <td><a href="#">Tiger Nixon</a></td>
                                            <td><span class="label label-danger">Close</span></td>
                                        </tr>
                                        <tr>
                                            <td class="txt-primary">Bug</td>
                                            <td>PI:198756541230</td>
                                            <td>Software Run Failure</td>
                                            <td>2015/01/10</td>
                                            <td><span class="label label-info">slow</span></td>
                                            <td><a href="#">Tiger Nixon</a></td>
                                            <td><span class="label label-info">On Hold</span></td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                            <!-- end of table -->
                        </div>
                    </div>
                    <!-- bug list card end -->
                </div>
            </div>
        </div>
    </div>
</div>
