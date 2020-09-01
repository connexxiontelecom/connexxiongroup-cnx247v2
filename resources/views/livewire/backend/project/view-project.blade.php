<div class="row">
    <div class="col-xl-4 col-lg-12 push-xl-8 task-detail-right">
        <div class="card">
            <div class="card-header">
                <h5 class="card-header-text">
                    <i class="icofont icofont-clock-time m-r-10"></i>project Duration
                </h5>
                <div class="btn-group mt-2 d-flex justify-content-center" role="group">
                    <button type="button"  class="btn btn-success btn-mini waves-effect waves-light" data-toggle="tooltip" data-placement="top" title="" data-original-title="Start Date">
                        <i class="ti-alarm-clock"></i>{{date(Auth::user()->tenant->dateFormat->format ?? 'd F, Y', strtotime($project->start_date))}} @ {{date('h:ia', strtotime($project->start_date))}}
                    </button>
                    <button type="button"  class="btn btn-danger btn-mini waves-effect waves-light" data-toggle="tooltip" data-placement="top" title="" data-original-title="Due Date">
                        <i class="ti-alarm-clock"></i>{{date(Auth::user()->tenant->dateFormat->format ?? 'd F, Y', strtotime($project->end_date))}} @ {{date('h:ia', strtotime($project->end_date))}}
                    </button>
                </div>
            </div>
        </div>
        <div class="card card-border-primary" style="margin-top:-30px;">
            <div class="card-header">
                <h5 class="card-header-text">
                    <i class="icofont icofont-ui-note m-r-10"></i> Project Details
                </h5>
            </div>
            <div class="card-block task-details">
                <table class="table table-border table-xs">
                    <tbody>
                        <tr>
                            <td>
                                <i class="icofont icofont-id-card"></i> Created:
                            </td>
                            <td class="text-right">{{date('d F, Y', strtotime($project->created_at))}}</td>
                        </tr>
                        <tr>
                            <td>
                                <i class="icofont icofont-spinner-alt-5"></i> Priority:
                            </td>
                            <td class="text-right">
                                <div class="btn-group">
                                    <a href="javascript:void(0);">
                                        {{$project->priority->name}}
                                    </a>
                                </div>
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <i class="icofont icofont-ui-love-add"></i> Created by:
                            </td>
                            <td class="text-right">
                                <a href="{{ route('view-profile', $project->user->url) }}">{{$project->user->first_name}}  {{$project->user->surname ?? ''}}</a>
                            </td>
                        </tr>
                        <tr>
                            <td><i class="icofont icofont-spinner-alt-3"></i> Revisions:</td>
                            <td class="text-right">{{count($project->postReviews)}}</td>
                        </tr>
                        <tr>
                            <td>
                                <i class="icofont icofont-washing-machine"></i> Status:
                            </td>
                            <td class="text-right">{{$project->postStatus->name ?? '-'}}</td>
                        </tr>
                    </tbody>
                </table>
            </div>
            <div class="card-footer">
                <div>
                    <div class="dropdown-secondary dropdown d-inline-block">
                        <button
                            class="btn btn-sm btn-primary dropdown-toggle waves-light"
                            type="button"
                            id="dropdown3"
                            data-toggle="dropdown"
                            aria-haspopup="true"
                            aria-expanded="false"
                        >
                            <i class="icofont icofont-navigation-menu"></i>
                        </button>
                        <div
                            class="dropdown-menu"
                            aria-labelledby="dropdown3"
                            data-dropdown-in="fadeIn"
                            data-dropdown-out="fadeOut"
                        >
                            <a wire:click="markAsComplete({{$project->id}})"  class="dropdown-item waves-light waves-effect" href="javascript:void(0);">
                                <i class="icofont icofont-checked m-r-10"></i>Mark as completed
                            </a>
                            <div class="dropdown-divider"></div>
                            <a class="dropdown-item waves-light waves-effect" href="{{ route('edit-project', $project->post_url) }}">
                                <i class="icofont icofont-edit-alt m-r-10 text-warning"></i>Edit task
                            </a>
                            <a class="dropdown-item waves-light waves-effect" href="{{ route('view-project', $project->post_url) }}">
                                <i class="ti-eye text-primary m-r-10"></i>View project
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="card card-border-danger" style="margin-top:-30px;">
            <div class="card-header">
                <h5 class="card-header-text">
                    <i class="icofont icofont-attachment"></i> Shared Files
                </h5>
                <button class="btn btn-success btn-mini float-right" title="Upload attachment">
                    <i class="ti-cloud-up mr-2"></i> Upload Attachment
                </button>
            </div>
            <div class="card-block task-attachment">
                <ul class="media-list">
                    @if (count($attachments) > 0)
                        @foreach ($attachments as $attachment)
                            <li class="media d-flex m-b-10">
                                <div class="m-r-20 v-middle">
                                    <i class="icofont icofont-file-word f-28 text-muted"></i>
                                </div>
                                <div class="media-body">
                                    <a href="#" class="m-b-5 d-block">{{$project->post_title ?? ''}}</a>
                                    <div class="text-muted">
                                        <span>Size: 1.2Mb</span>
                                        <span>
                                            Added by
                                            <a href="{{route('view-profile', $attachment->user->url)}}">{{$attachment->user->first_name ?? ''}} {{$attachment->user->surname ?? ''}}</a>
                                        </span>
                                    </div>
                                </div>
                                <div class="f-right v-middle text-muted">
                                    <i class="icofont icofont-download-alt f-18"></i>
                                </div>
                            </li>
                        @endforeach

                    @else
                        <li class="text-muted text-center">There're no attachments for this project.</li>
                    @endif
                </ul>
            </div>
        </div>
        <div class="card card-border-info" style="margin-top:-30px;">
            <div class="card-header">
                <h5 class="card-header-text">
                    <i class="icofont icofont-users-alt-4"></i> Responsible Person(s)
                </h5>
            </div>
            <div class="card-block user-box assign-user">
                @foreach($project->responsiblePersons as $person)
                    <div class="media">
                        <div class="media-left media-middle photo-table">
                            <a href="{{ route('view-profile', $person->user->url) }}">
                                <img data-toggle="tooltip" data-placement="top" title="" data-original-title="{{$person->user->first_name}} {{$person->user->surname ?? ''}}" class="img-radius" src="/assets/images/avatars/thumbnails/{{ $person->user->avatar ?? 'avatar.png' }}" alt="{{$person->user->first_name ?? ''}}">
                            </a>
                        </div>
                        <div class="media-body">
                            <h6><a href="{{ route('view-profile', $person->user->url) }}">{{$person->user->first_name }}  {{ $person->user->surname ?? '' }}</a></h6>
                            <p>{{$person->user->position ?? '-' }}</p>
                        </div>
                        <div>
                            <a href="#!" class="text-muted">
                                <i class="icon-options-vertical"></i>
                            </a>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
        <div class="card card-border-warning" style="margin-top:-30px;">
            <div class="card-header">
                <h5 class="card-header-text">
                    <i class="icofont icofont-users-alt-4"></i> Participant(s)
                </h5>
            </div>
            <div class="card-block user-box assign-user">
                @if(count($project->postParticipants) > 0)
                    @foreach($project->postParticipants as $part)
                        <div class="media">
                            <div class="media-left media-middle photo-table">
                                <a href="{{ route('view-profile', $part->user->url) }}">
                                    <img data-toggle="tooltip" data-placement="top" title="" data-original-title="{{$part->user->first_name}} {{$part->user->surname ?? ''}}" class="img-radius" src="/assets/images/avatars/thumbnails/{{ $part->user->avatar ?? 'avatar.png' }}" alt="{{$part->user->first_name ?? ''}}">
                                </a>
                            </div>
                            <div class="media-body">
                                <h6><a href="{{ route('view-profile', $part->user->url) }}">{{$part->user->first_name }}  {{ $part->user->surname ?? '' }}</a></h6>
                                <p>{{$part->user->position ?? '-' }}</p>
                            </div>
                            <div>
                                <a href="#!" class="text-muted">
                                    <i class="icon-options-vertical"></i>
                                </a>
                            </div>
                        </div>
                    @endforeach

                @else
                        <p class="">There're no participants for this task</p>

                @endif

            </div>
        </div>
        <div class="card card-border-primary" style="margin-top:-30px;">
            <div class="card-header">
                <h5 class="card-header-text">
                    <i class="icofont icofont-users-alt-4"></i> Observers(s)
                </h5>
            </div>
            <div class="card-block user-box assign-user">
                @if(count($project->postObservers) > 0)
                    @foreach($project->postObservers as $part)
                        <div class="media">
                            <div class="media-left media-middle photo-table">
                                <a href="{{ route('view-profile', $part->user->url) }}">
                                    <img data-toggle="tooltip" data-placement="top" title="" data-original-title="{{$part->user->first_name}} {{$part->user->surname ?? ''}}" class="img-radius" src="/assets/images/avatars/thumbnails/{{ $part->user->avatar ?? 'avatar.png' }}" alt="{{$part->user->first_name ?? ''}}">
                                </a>
                            </div>
                            <div class="media-body">
                                <h6><a href="{{ route('view-profile', $part->user->url) }}">{{$part->user->first_name }}  {{ $part->user->surname ?? '' }}</a></h6>
                                <p>{{$part->user->position ?? '-' }}</p>
                            </div>
                            <div>
                                <a href="#!" class="text-muted">
                                    <i class="icon-options-vertical"></i>
                                </a>
                            </div>
                        </div>
                    @endforeach

                @else
                        <p class="">There're no participants for this project</p>

                @endif

            </div>
        </div>

    </div>
    <div class="col-xl-8 col-lg-12 pull-xl-4 filter-bar">
        @include('livewire.backend.project.common._project-slab')
        <div class="card">
            <div class="card-block">
                <h5 class="sub-title">
                    <i class="icofont icofont-tasks-alt m-r-5"></i> {{$project->post_title }}
                </h5>
                <button class="btn btn-mini btn-primary  f-right" wire:click="markAsComplete({{$project->id}})">
                    <i class="icofont icofont-ui-alarm"></i>Mark as completed
                </button>
                <div class="">
                    <div class="m-b-20">
                        <h6 class="sub-title m-b-15">Overview</h6>
                        {!! $project->post_content !!}
                    </div>
                    <div class="m-t-20 m-b-20">
                        <h6 class="sub-title m-b-15">Revisions</h6>
                    </div>
                    <div class="row">
                        <ul class="media-list revision-blc">
                            @if(count($project->postReviews) > 0)
                                @foreach ($project->postReviews as $review)
                                <li class="media d-flex m-b-15">
                                    <div class="p-l-15 p-r-20 d-inline-block v-middle">
                                        <a href="{{ route('view-profile', $review->user->url) }}">
                                            <img class="media-object img-radius comment-img" src="/assets/images/avatars/thumbnails/{{$review->user->avatar ?? 'avatar.png'}}" alt="{{$review->user->first_name}} {{$review->user->surname ?? ''}}">
                                        </a>
                                    </div>
                                    <div class="d-inline-block">
                                    {!! $review->content !!}
                                        <div class="media-annotation">{{$review->created_at->diffForHumans()}}</div>
                                    </div>
                                </li>

                                @endforeach

                            @else
                                <p class="ml-4 text-center">There're no reviews for this project.</p>
                            @endif
                        </ul>
                    </div>
                </div>
            </div>
            <div class="card-footer">
                <div class="col-md-12 btn-add-task">
                    <div class="input-group input-group-button">
                        <input type="text" wire:model.debounce.10000ms="review" class="form-control" placeholder="Leave review...">

                        <span class="input-group-addon btn btn-primary btn-sm" wire:click="leaveReviewBtn({{$project->id }})">
                            <i class="icofont icofont-plus f-w-600"></i>
                            Review
                        </span>
                    </div>
                    @error('review')
                    <i class="text-danger">{{$message}}</i>
                    @enderror
                </div>
            </div>
        </div>
        <div class="card comment-block">
            <div class="card-block">
                <h5 class="sub-title">
                    <i class="icofont icofont-comment m-r-5"></i> Comments
                </h5>
                <ul class="media-list">
                    @foreach ($project->postComments as $comment)
                        <li class="media">
                            <div class="media-left">
                                <a href="{{ route('view-profile', $comment->user->url) }}">
                                    <img class="media-object img-radius comment-img" src="/assets/images/avatars/thumbnails/{{$comment->user->avatar ?? 'avatar.png'}}" alt="{{$comment->user->first_name}} {{$comment->user->surname ?? ''}}">
                                </a>
                            </div>
                            <div class="media-body">
                                <h6 class="media-heading txt-primary">{{$comment->user->first_name}} {{ $comment->user->surname ?? ''}}
                                    <span class="f-12 text-muted m-l-5">{{ $comment->created_at->diffForHumans() }}</span>
                                </h6>
                                <p>{!! $comment->comment !!}</p>
                                <hr>
                            </div>
                        </li>

                    @endforeach
                </ul>
                <div class="md-float-material d-flex">
                    <div class="col-md-12 btn-add-task">
                        <div class="input-group input-group-button">
                            <input type="text" wire:model.debounce.10000ms="comment" class="form-control" placeholder="Leave comment...">

                            <span class="input-group-addon btn btn-primary btn-sm" wire:click="leaveCommentBtn({{$project->id }})">
                                <i class="icofont icofont-plus f-w-600"></i>
                                Comment
                            </span>
                        </div>
                        @error('comment')
                        <i class="text-danger">{{$message}}</i>
                        @enderror
                    </div>

                </div>
            </div>
        </div>
        <div class="card comment-block">
            <div class="card-block">
                <h5 class="sub-title">
                    <i class="icofont icofont-measure m-r-5"></i> Project Milestones
                    <button class="btn btn-mini btn-primary float-right mb-2 milestone-laucher" data-post-id="{{$project->id}}" data-target="#milestoneModal" data-toggle="modal"><i class="ti-plus mr-2"></i> Create Milestone</button>
                </h5>
                <div class="row">
                    <div class="col-md-12">
                        <div class="card">
                            <div class="card-block accordion-block">
                                <div id="accordion" role="tablist" aria-multiselectable="true">

                                    @if(count($milestones) > 0)
                                        @foreach($milestones as $milestone)
                                            <div class="accordion-panel">
                                                <div class="accordion-heading" role="tab" id="heading_"{{$milestone->id}}>
                                                    <h3 class="card-title accordion-title">
                                                    <a class="accordion-msg scale_active collapsed" data-toggle="collapse" data-parent="#accordion" href="#collapse_{{$milestone->id}}" aria-expanded="false" aria-controls="collapse_{{$milestone->id}}">
                                                        <img data-toggle="tooltip" data-placement="top" title="" data-original-title="Created by: {{$milestone->user->first_name ?? ''}} {{$milestone->user->surname ?? ''}}" src="/assets/images/avatars/thumbnails/{{$milestone->user->avatar ?? 'avatar.png'}}" class="img-30" alt="{{$milestone->user->first_name ?? ''}}"> {{$milestone->title}} 
                                                        <span class="float-right">
                                                            Date: <label class="label label-primary">{{date(Auth::user()->tenant->dateFormat->format ?? 'd F, Y', strtotime($milestone->created_at))}}</label>
                                                            Due Date:  <label class="label label-danger">{{date(Auth::user()->tenant->dateFormat->format ?? 'd F, Y', strtotime($milestone->due_date))}}</label>
                                                        </span>
                                                    </a>
                                                </h3>
                                                </div>
                                                <div id="collapse_{{$milestone->id}}" class="panel-collapse in collapse" role="tabpanel" aria-labelledby="heading_{{$milestone->id}}" style="">
                                                    <div class="accordion-content accordion-desc">
                                                        <p class="mb-3">Status: 
                                                            @if($milestone->status == 0)
                                                                <label class="label label-warning">Open</label>
                                                            @else
                                                                <label class="label label-success">Closed</label>

                                                            @endif
                                                        </p>
                                                        <p>
                                                            {{$milestone->description ?? ''}}
                                                        </p>
                                                        <div class="btn-group d-flex justify-content-end">
                                                            <a href="javascript:void(0);" class="text-danger"><i class="ti-trash text-danger mr-2"></i> Delete</a>
                                                            <a href="javascript:void(0);" class="text-primary"><i class="ti-check text-primary ml-2"></i> Close</a>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        @endforeach
                                    @else
                                        <p class="text-center">This project has no milestones</p>
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
