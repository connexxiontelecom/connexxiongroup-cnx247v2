<div class="row">
    <div class="col-xl-4 col-lg-12 push-xl-8 task-detail-right">
        <div class="card">
            <div class="card-header">
                <h5 class="card-header-text">
                    <i class="icofont icofont-clock-time m-r-10"></i>Task Duration
                </h5>
                <div class="btn-group mt-2 d-flex justify-content-center" role="group">
                    <button type="button"  class="btn btn-success btn-mini waves-effect waves-light" data-toggle="tooltip" data-placement="top" title="" data-original-title="Start Date">
                        <i class="ti-alarm-clock"></i>{{date(Auth::user()->tenant->dateFormat->format ?? 'd F, Y', strtotime($task->start_date))}} @ {{date('h:ia', strtotime($task->start_date))}}
                    </button>
                    <button type="button"  class="btn btn-danger btn-mini waves-effect waves-light" data-toggle="tooltip" data-placement="top" title="" data-original-title="Due Date">
                        <i class="ti-alarm-clock"></i>{{date(Auth::user()->tenant->dateFormat->format ?? 'd F, Y', strtotime($task->end_date))}} @ {{date('h:ia', strtotime($task->end_date))}}
                    </button>
                </div>
            </div>
        </div>
        <div class="card card-border-primary" style="margin-top:-30px;">
            <div class="card-header">
                <h5 class="card-header-text">
                    <i class="icofont icofont-ui-note m-r-10"></i> Task Details
                </h5>
            </div>
            <div class="card-block task-details">
                <table class="table table-border table-xs">
                    <tbody>
                        <tr>
                            <td>
                                <i class="icofont icofont-id-card"></i> Created:
                            </td>
                            <td class="text-right">{{date('d F, Y', strtotime($task->created_at))}}</td>
                        </tr>
                        <tr>
                            <td>
                                <i class="icofont icofont-spinner-alt-5"></i> Priority:
                            </td>
                            <td class="text-right">
                                <div class="btn-group">
                                    <a href="javascript:void(0);">
                                        {{$task->priority->name}}
                                    </a>
                                </div>
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <i class="icofont icofont-ui-love-add"></i> Created by:
                            </td>
                            <td class="text-right">
                                <a href="{{ route('view-profile', $task->user->url) }}">{{$task->user->first_name}}  {{$task->user->surname ?? ''}}</a>
                            </td>
                        </tr>
                        <tr>
                            <td><i class="icofont icofont-spinner-alt-3"></i> Revisions:</td>
                            <td class="text-right">{{count($task->postReviews)}}</td>
                        </tr>
                        <tr>
                            <td>
                                <i class="icofont icofont-washing-machine"></i> Status:
                            </td>
                            <td class="text-right">{{$task->postStatus->name ?? '-'}}</td>
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
                            <a wire:click="markAsComplete({{$task->id}})"  class="dropdown-item waves-light waves-effect" href="javascript:void(0);">
                                <i class="icofont icofont-checked m-r-10"></i>Mark as completed
                            </a>
                            <div class="dropdown-divider"></div>
                            <a class="dropdown-item waves-light waves-effect" href="{{ route('edit-task', $task->post_url) }}">
                                <i class="icofont icofont-edit-alt m-r-10 text-warning"></i>Edit task
                            </a>
                            <a class="dropdown-item waves-light waves-effect" href="{{ route('view-task', $task->post_url) }}">
                                <i class="ti-eye text-primary m-r-10"></i>View task
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
                                    <a href="#" class="m-b-5 d-block">{{$task->post_title ?? ''}}</a>
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
                        <li class="text-muted text-center">There're no attachments for this task.</li>
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
                @foreach($task->responsiblePersons as $person)
                    <div class="media">
                        <div class="media-left media-middle photo-table">
                            <a href="{{ route('view-profile', $person->user->url) }}">
                                <img data-toggle="tooltip" data-placement="top" title="" data-original-title="{{$person->user->first_name}} {{$person->user->surname ?? ''}}" class="img-radius" src="/assets/images/avatars/thumbnails/{{ $person->user->avatar ?? '/assets/images/avatar-3.jpg' }}" alt="chat-user">
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
                @if(count($task->postParticipants) > 0)
                    @foreach($task->postParticipants as $part)
                        <div class="media">
                            <div class="media-left media-middle photo-table">
                                <a href="{{ route('view-profile', $part->user->url) }}">
                                    <img data-toggle="tooltip" data-placement="top" title="" data-original-title="{{$part->user->first_name}} {{$part->user->surname ?? ''}}" class="img-radius" src="/assets/images/avatars/thumbnails/{{ $part->user->avatar ?? '/assets/images/avatar-3.jpg' }}" alt="chat-user">
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
                @if(count($task->postObservers) > 0)
                    @foreach($task->postObservers as $part)
                        <div class="media">
                            <div class="media-left media-middle photo-table">
                                <a href="{{ route('view-profile', $part->user->url) }}">
                                    <img data-toggle="tooltip" data-placement="top" title="" data-original-title="{{$part->user->first_name}} {{$part->user->surname ?? ''}}" class="img-radius" src="/assets/images/avatars/thumbnails/{{ $part->user->avatar ?? '/assets/images/avatar-3.jpg' }}" alt="chat-user">
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

    </div>
    <div class="col-xl-8 col-lg-12 pull-xl-4 filter-bar">
            @include('livewire.backend.task.common._task-slab')
        <div class="card">
            <div class="card-block">
                <h5 class="sub-title">
                    <i class="icofont icofont-tasks-alt m-r-5"></i> {{$task->post_title }}                @if ($task->post_status == 'complete')
                    <label for="" class="label label-success">Completed</label>
                @elseif($task->post_status == 'in-progress')
                    <label for="" class="label label-warning">in-progress</label>
                @endif
                </h5>
                @if ($task->post_status == 'in-progress')
                <button class="btn btn-sm btn-primary f-right btn-mini" wire:click="markAsComplete({{$task->id}})" >
                    <i class="icofont icofont-ui-alarm"></i>Mark as completed
                </button>
                @endif

                <div class="">
                    <div class="m-b-20">
                        <h6 class="sub-title m-b-15">Overview</h6>
                        {!! $task->post_content !!}
                    </div>
                    <div class="m-t-20 m-b-20">
                        <h6 class="sub-title m-b-15">Revisions</h6>
                    </div>
                    <div class="row">
                        <ul class="media-list revision-blc">
                            @if(count($task->postReviews) > 0)
                                @foreach ($task->postReviews as $review)
                                <li class="media d-flex m-b-15">
                                    <div class="p-l-15 p-r-20 d-inline-block v-middle">
                                        <a href="{{ route('view-profile', $review->user->url) }}">
                                            <img class="media-object img-radius comment-img" src="/assets/images/avatars/thumbnails/{{$review->user->avatar ?? '/assets/images/avatar-1.jpg'}}" alt="{{$review->user->first_name}} {{$review->user->surname ?? ''}}">
                                        </a>
                                    </div>
                                    <div class="d-inline-block">
                                    {!! $review->content !!}
                                        <div class="media-annotation">{{$review->created_at->diffForHumans()}}</div>
                                    </div>
                                </li>

                                @endforeach

                            @else
                                <p class="ml-4 text-center">There're no reviews for this task.</p>
                            @endif
                        </ul>
                    </div>
                </div>
            </div>
            <div class="card-footer">
                <div class="col-md-12 btn-add-task">
                    <div class="input-group input-group-button">
                        <input type="text" wire:model.debounce.10000ms="review" class="form-control" placeholder="Leave review...">

                        <span class="input-group-addon btn btn-primary btn-sm" wire:click="leaveReviewBtn({{$task->id }})">
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
                    @foreach ($task->postComments as $comment)
                        <li class="media">
                            <div class="media-left">
                                <a href="{{ route('view-profile', $comment->user->url) }}">
                                    <img class="media-object img-radius comment-img" src="/assets/images/avatars/thumbnails/{{$comment->user->avatar ?? '/assets/images/avatar-1.jpg'}}" alt="{{$comment->user->first_name}} {{$comment->user->surname ?? ''}}">
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

                            <span class="input-group-addon btn btn-primary btn-sm" wire:click="leaveCommentBtn({{$task->id }})">
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
    </div>
</div>
@push('task-scripts')
    <script>
        $(document).ready(function(){
            alert('ready');
        });
    </script>
@endpush
