
<div class="card">
    <div class="card-header">
        <h5>Assignments</h5> <br>
        <div class="dropdown-primary dropdown open mt-2" data-intro="This is Card Header" data-step="1">
            <button class="btn btn-primary btn-sm dropdown-toggle waves-effect waves-light " type="button" id="dropdown-2" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><i class="ti-filter mr-2"></i>Filter</button>
            <div class="dropdown-menu" aria-labelledby="dropdown-2" data-dropdown-in="fadeIn" data-dropdown-out="fadeOut" x-placement="bottom-start" style="position: absolute; transform: translate3d(0px, 39px, 0px); top: 0px; left: 0px; will-change: transform;">
                <a class="dropdown-item waves-light waves-effect" href="#">All</a>
                <a class="dropdown-item waves-light waves-effect" href="#">In-progress</a>
                <a class="dropdown-item waves-light waves-effect" href="#">Approved</a>
                <div class="dropdown-divider"></div>
                <a class="dropdown-item waves-light waves-effect" href="#">Declined</a>
            </div>
        </div>
    </div>
    <div class="card-block">
        @if(session()->has('success'))
        <div class="alert alert-success border-success">
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <i class="icofont icofont-close-line-circled"></i>
            </button>
            {!! session('success') !!}
        </div>
        @endif
        <div class="dt-responsive table-responsive">
            <table id="new-cons" class="table table-striped table-bordered nowrap">
                <thead>
                    <tr class="text-uppercase">
                        <th>#</th>
                        <th>Title</th>
                        <th>Description</th>
                        <th>Status</th>
                        <th>Date</th>
                        <th>Name</th>
                    </tr>
                </thead>
                <tbody>
                    @php
                        $i = 1;
                    @endphp
                    @foreach ($requests as $request)
                        @foreach($request->responsiblePersons as $person)
                            @if($person->user_id == Auth::user()->id)
                                <tr>
                                    <td>{{$i++}}</td>
                                    <td>
                                        <a href="{{ route('view-workflow-task', $request->post_url) }}">{!! strlen($request->post_title) > 18 ? substr($request->post_title, 0,15).'...' : $request->post_title !!}</a>
                                    </td>
                                    <td>
                                        {{ strlen($request->post_content ) > 35 ? substr($request->post_content, 0,35).'...' : $request->post_content  }}
                                    </td>
                                    <td>
                                        @if($request->post_status == 'in-progress')
                                            <label class="badge badge-warning text-white special-badge"><small class="text-uppercase">in-progress</small></label>
                                        @elseif($request->post_status == 'approved')
                                            <label class="badge badge-success special-badge"><small class="text-uppercase">approved</small></label>

                                        @elseif($request->post_status == 'declined')
                                            <label class="badge badge-danger special-badge"><small class="text-uppercase">declined</small></label>
                                        @endif
                                    </td>
                                    <td> <small class="text-uppercase">{{date('d M, Y | h:i a', strtotime($request->created_at))}}</small> </td>
                                    <td>
                                        You are assigned to fulfill this request<br/>
                                        <div class="btn-group mt-2">
                                            @if($person->status == 'approved')
                                                <button type="button" class="btn btn-danger btn-out-dashed btn-square btn-mini waves-effect waves-light declineBtn" wire:click="declineRequest({{ $request->id }})">
                                                    <i class="icofont icofont-thumbs-down"></i>
                                                Decline
                                                </button>
                                            @elseif($person->status == 'declined')

                                            @elseif($person->status == 'in-progress')
                                                <button type="button" class="btn btn-danger btn-mini btn-out-dashed btn-square waves-effect waves-light declineBtn" wire:click="declineRequest({{ $request->id }})">
                                                    Decline
                                                    <i class="icofont icofont-thumbs-down"></i>
                                                </button>
                                                <button type="button" class="btn btn-success btn-mini btn-out-dashed btn-square waves-effect waves-light approveBtn" wire:click="approveRequest({{ $request->id }})">
                                                    Approve
                                                    <i class="icofont icofont-thumbs-up"></i>
                                                </button>
                                            @endif

                                        </div>
                                    </td>
                                </tr>

                            @endif

                        @endforeach
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>
