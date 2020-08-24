<div class="row">
    <!-- Task-detail-right start -->
    <div class="col-xl-4 col-lg-12 push-xl-8 task-detail-right">
        <div class="card">
            <div class="card-header">
                <h5 class="card-header-text">
                    <i class="icofont icofont-clock-time m-r-10"></i>Task Timer
                </h5>
            </div>
            <div class="card-block">
                <div class="counter">
                    <div class="yourCountdownContainer">
                        <div class="row">
                            <div class="col-xs-3">
                                <h2>Duration</h2>
                            </div>
                        </div>
                        <!-- end of row -->
                    </div>
                    <!-- end of yourCountdown -->
                </div>
                <!-- end of counter -->
            </div>
        </div>
        <div class="card">
            <div class="card-header">
                <h5 class="card-header-text">
                    <i class="icofont icofont-ui-note m-r-10"></i> Project
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
                                    <a href="#">
                                        <i class="icofont icofont-upload m-r-5"></i>
                                        {{$project->priority}}
                                    </a>
                                </div>
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <i class="icofont icofont-ui-love-add"></i> Created by:
                            </td>
                            <td class="text-right">
                                <a href="#">{{$project->user->first_name}}  {{$project->user->surname ?? ''}}</a>
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
                            <td class="text-right">{{$project->status ?? '-'}}</td>
                        </tr>
                    </tbody>
                </table>
            </div>
            <div class="card-footer">
                <div>
                    <span>
                        <a href="#!" class="text-muted m-r-10 f-16">
                            <i class="icofont icofont-random"></i>
                        </a>
                    </span>
                    <span class="m-r-10">
                        <a href="#!" class="text-muted f-16">
                            <i class="icofont icofont-options"></i>
                        </a>
                    </span>
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
                            <a class="dropdown-item waves-light waves-effect" href="#!">
                                <i class="icofont icofont-checked m-r-10"></i>Mark as completed
                            </a>
                            <div class="dropdown-divider"></div>
                            <a class="dropdown-item waves-light waves-effect" href="#!">
                                <i class="icofont icofont-edit-alt m-r-10"></i>Edit task
                            </a>
                            <a class="dropdown-item waves-light waves-effect" href="#!">
                                <i class="icofont icofont-close m-r-10"></i>Remove
                            </a>
                        </div>
                        <!-- end of dropdown menu -->
                    </div>
                </div>
            </div>
        </div>
        <div class="card">
            <div class="card-header">
                <h5 class="card-header-text">
                    <i class="icofont icofont-attachment"></i> Shared Files
                </h5>
                <button class="btn btn-success btn-icon float-right" title="Upload attachment">
                    <i class="ti-cloud-up"></i>
                </button>
            </div>
            <div class="card-block task-attachment">
                <ul class="media-list">
                    <li class="media d-flex m-b-10">
                        <div class="m-r-20 v-middle">
                            <i class="icofont icofont-file-word f-28 text-muted"></i>
                        </div>
                        <div class="media-body">
                            <a href="#" class="m-b-5 d-block">Overdrew_scowled.doc</a>
                            <div class="text-muted">
                                <span>Size: 1.2Mb</span>
                                <span>
                                    Added by
                                    <a href="">Winnie</a>
                                </span>
                            </div>
                        </div>
                        <div class="f-right v-middle text-muted">
                            <i class="icofont icofont-download-alt f-18"></i>
                        </div>
                    </li>
                    <li class="media d-flex m-b-10">
                        <div class="m-r-20 v-middle">
                            <i class="icofont icofont-file-powerpoint f-28 text-muted"></i>
                        </div>
                        <div class="media-body">
                            <a href="#" class="m-b-5 d-block">And_less_maternally.pdf</a>
                            <div class="text-muted">
                                <span>Size: 0.11Mb</span>
                                <span>
                                    Added by
                                    <a href="">Eugene</a>
                                </span>
                            </div>
                        </div>
                        <div class="f-right v-middle text-muted">
                            <i class="icofont icofont-download-alt f-18"></i>
                        </div>
                    </li>
                    <li class="media d-flex m-b-10">
                        <div class="m-r-20 v-middle">
                            <i class="icofont icofont-file-pdf f-28 text-muted"></i>
                        </div>
                        <div class="media-body">
                            <a href="#" class="m-b-5 d-block">The_less_overslept.pdf</a>
                            <div class="text-muted">
                                <span>Size:5.9Mb</span>
                                <span>
                                    Added by
                                    <a href="">Natalie</a>
                                </span>
                            </div>
                        </div>
                        <div class="f-right v-middle text-muted">
                            <i class="icofont icofont-download-alt f-18"></i>
                        </div>
                    </li>
                    <li class="media d-flex m-b-10">
                        <div class="m-r-20 v-middle">
                            <i class="icofont icofont-file-exe f-28 text-muted"></i>
                        </div>
                        <div class="media-body">
                            <a href="#" class="m-b-5 d-block">Well_equitably.mov</a>
                            <div class="text-muted">
                                <span>Size:20.9Mb</span>
                                <span>
                                    Added by
                                    <a href="">Jenny</a>
                                </span>
                            </div>
                        </div>
                        <div class="f-right v-middle text-muted">
                            <i class="icofont icofont-download-alt f-18"></i>
                        </div>
                    </li>
                </ul>
            </div>
        </div>
        <div class="card">
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
                                <img data-toggle="tooltip" data-placement="top" title="" data-original-title="{{$person->user->first_name}} {{$person->user->surname ?? ''}}" class="img-radius" src="{{ $person->user->avatar ?? '/assets/images/avatar-3.jpg' }}" alt="chat-user">
                            </a>
                        </div>
                        <div class="media-body">
                            <h6>{{$person->user->first_name }}  {{ $person->user->surname ?? '' }}</h6>
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
        <div class="card">
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
                                    <img data-toggle="tooltip" data-placement="top" title="" data-original-title="{{$part->user->first_name}} {{$part->user->surname ?? ''}}" class="img-radius" src="{{ $part->user->avatar ?? '/assets/images/avatar-3.jpg' }}" alt="chat-user">
                                </a>
                            </div>
                            <div class="media-body">
                                <h6>{{$part->user->first_name }}  {{ $part->user->surname ?? '' }}</h6>
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
        <div class="card">
            <div class="card-header">
                <h5 class="card-header-text">
                    <i class="icofont icofont-users-alt-4"></i> Observer(s)
                </h5>
            </div>
            <div class="card-block user-box assign-user">
                @if(count($project->postObservers) > 0)
                    @foreach($project->postObservers as $observe)
                    
                        <div class="media">
                            <div class="media-left media-middle photo-table">
                                <a href="{{ route('view-profile', $observe->user->url) }}">
                                    <img data-toggle="tooltip" data-placement="top" title="" data-original-title="{{$observe->user->first_name}} {{$observe->user->surname ?? ''}}" class="img-radius" src="{{ $observe->user->avatar ?? '/assets/images/avatar-3.jpg' }}" alt="chat-user">
                                </a>
                            </div>
                            <div class="media-body">
                                <h6>{{$observe->user->first_name }}  {{ $observe->user->surname ?? '' }}</h6>
                                <p>{{$observe->user->position ?? '-' }}</p>
                            </div>
                            <div>
                                <a href="#!" class="text-muted">
                                    <i class="icon-options-vertical"></i>
                                </a>
                            </div>
                        </div>
                    @endforeach

                @else 
                    <p class="">There're no observers for this task</p>
                @endif 

            </div>
        </div>
    </div>
    <!-- Task-detail-right start -->
    <!-- Task-detail-left start -->
    <div class="col-xl-8 col-lg-12 pull-xl-4">
        <div class="card">
            <div class="card-header">
                <h5>
                    <i class="icofont icofont-tasks-alt m-r-5"></i> {{$project->post_title }}
                </h5>
                <button class="btn btn-sm btn-primary f-right">
                    <i class="icofont icofont-ui-alarm"></i>Mark as completed
                </button>
            </div>
            <div class="card-block">
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
                                            <img class="media-object img-radius comment-img" src="{{$review->user->avatar ?? '/assets/images/avatar-1.jpg'}}" alt="{{$review->user->first_name}} {{$review->user->surname ?? ''}}">
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
            <div class="card-header">
                <h5 class="card-header-text">
                    <i class="icofont icofont-comment m-r-5"></i> Comments
                </h5>
            </div>
            <div class="card-block">
                <ul class="media-list">
                    @foreach ($project->postComments as $comment)
                        <li class="media">
                            <div class="media-left">
                                <a href="{{ route('view-profile', $comment->user->url) }}">
                                    <img class="media-object img-radius comment-img" src="{{$comment->user->avatar ?? '/assets/images/avatar-1.jpg'}}" alt="{{$comment->user->first_name}} {{$comment->user->surname ?? ''}}">
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
    </div>
    <!-- Task-detail-left end -->
</div>