<div class="row">

        <div class="col-xl-3 col-lg-12 push-xl-9">
            <div class="card">
                <div class="card-block p-t-10">
                    <div class="task-right">
                        <div class="task-right-header-users">
                            <span data-toggle="collapse">Assign Users</span>
                        </div>
                        <div class="user-box assign-user taskboard-right-users">
                            <div class="media">
                                <div class="media-left media-middle photo-table">
                                    <a href="#">
                                        <img class="media-object img-radius" src="\assets\images\avatar-1.jpg" alt="Generic placeholder image">
                                        <div class="live-status bg-danger"></div>
                                    </a>
                                </div>
                                <div class="media-body">
                                    <h6>Josephin Doe</h6>
                                    <p>Santa Ana,CA</p>
                                </div>
                            </div>
                            <div class="media">
                                <div class="media-left media-middle photo-table">
                                    <a href="#">
                                        <img class="media-object img-radius" src="\assets\images\avatar-2.jpg" alt="Generic placeholder image">
                                        <div class="live-status bg-success"></div>
                                    </a>
                                </div>
                                <div class="media-body">
                                    <h6>Josephin Doe</h6>
                                    <p>Huntingston, NJ</p>
                                </div>
                            </div>
                            <div class="media">
                                <div class="media-left media-middle photo-table">
                                    <a href="#">
                                        <img class="media-object img-radius" src="\assets\images\avatar-3.jpg" alt="Generic placeholder image">
                                        <div class="live-status bg-danger"></div>
                                    </a>
                                </div>
                                <div class="media-body">
                                    <h6>Josephin Doe</h6>
                                    <p>Willingstion, WA</p>
                                </div>
                            </div>
                            <div class="media">
                                <div class="media-left media-middle photo-table">
                                    <a href="#">
                                        <img class="media-object img-radius" src="\assets\images\avatar-2.jpg" alt="Generic placeholder image">
                                        <div class="live-status bg-success"></div>
                                    </a>
                                </div>
                                <div class="media-body">
                                    <h6>Josephin Doe</h6>
                                    <p>Illions, IL</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-xl-9 col-lg-12 pull-xl-3 filter-bar">
            @include('livewire.backend.project.common._project-slab')
            <div class="row">
                @foreach ($projects as $task)
                <div class="col-sm-6">
                    <div class="card" style="border-top: 4px solid {{$task->post_color}}">
                        <div class="card-header">
                            <a href="{{ route('view-task', $task->post_url) }}" class="card-title">{{$task->post_title}}</a>
                            <span class="label label-primary f-right"> {{date(Auth::user()->tenant->dateFormat->format ?? 'd F, Y', strtotime($task->created_at) )}}</span>
                        </div>
                        <div class="card-block">
                            <div class="row">
                                <div class="col-sm-12">
                                    <p class="task-detail">{!! strlen($task->post_content) > 110 ? substr($task->post_content, 0, 110).'...' : $task->post_content !!}</p>
                                    <p class="task-due">
                                        <strong> Due :</strong>
                                        <strong class="label label-danger">{{date(Auth::user()->tenant->dateFormat->format ?? 'd F, Y', strtotime($task->end_date) )}}</strong>
                                    </p>
                                </div>
                            </div>
                        </div>
                        <div class="card-footer">
                            <div class="task-list-table">
                                @foreach($task->responsiblePersons as $person)
                                    <a href="/activity-stream/profile/{{$person->user->url}}">
                                        <img class="img-fluid img-radius" data-toggle="tooltip" data-placement="top" title="" data-original-title="{{$person->user->first_name}} {{$person->user->surname ?? ''}}" src="/assets/images/avatars/thumbnails/{{ $person->user->avatar ?? '/assets/images/avatar.png' }}" alt="{{$person->user->first_name}} {{$person->user->surname ?? ''}}">
                                    </a>

                                @endforeach
                            </div>
                            <div class="task-board">
                                <div class="dropdown-secondary dropdown">
                                    <button
                                        class="btn btn-default btn-mini dropdown-toggle waves-light b-none txt-muted"
                                        type="button"
                                        id="dropdown6"
                                        data-toggle="dropdown"
                                        aria-haspopup="true"
                                        aria-expanded="false"
                                    >
                                        <i class="icofont icofont-navigation-menu"></i>
                                    </button>
                                    <div
                                        class="dropdown-menu"
                                        aria-labelledby="dropdown6"
                                        data-dropdown-in="fadeIn"
                                        data-dropdown-out="fadeOut"
                                    >
                                        <div class="dropdown-divider"></div>
                                        <a class="dropdown-item waves-light waves-effect" href="#!">
                                            <i class="icofont icofont-ui-edit"></i> Edit task
                                        </a>
                                        <a class="dropdown-item waves-light waves-effect" href="#!">
                                            <i class="icofont icofont-close-line"></i> Remove
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                @endforeach

            </div>
        </div>
        @can('view projects')
        <div class="col-md-12">
            <div class="card">
                <div class="card-block">
                    <p class="text-muted">Kindly <a href="" class="btn btn-success btn-mini waves-effect waves-light"><i class="zmdi zmdi-shopping-cart mr-2"></i> upgrade</a> your plan to access this feature or contact your admin.</p>
                </div>
            </div>
        </div>
    @endcan
</div>
