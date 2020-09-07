<li class="header-notification">
    <div class="dropdown-primary dropdown">
        <div class="dropdown-toggle" data-toggle="dropdown">
            <i class="feather icon-bell"></i>
            <span class="badge bg-c-pink">{{ number_format(count($unread)) }}</span>
        </div>
        <ul class="show-notification notification-view dropdown-menu" data-dropdown-in="fadeIn" data-dropdown-out="fadeOut">
            <li>
                <h6>Notifications</h6>
                <label class="label label-info text-white nav-link"> <a href="{{ route('notifications') }}">View All Notifications</a> </label>
            </li>
            @if(Auth::check())

                @foreach ($unread->take(5) as $un)
                    @switch($un->data['post_type'])
                        @case('project')
                            <a href="{{route('view-project', $un->data['url'])}}" class="nav-link" wire:click="markNotificationAsRead">
                                @break
                        @case('task')
                            <a href="{{route('view-task', $un->data['url'])}}" class="nav-link" wire:click="markNotificationAsRead">
                                @break
                        @case('chat')
                            <a href="{{$un->data['url']}}" class="nav-link" wire:click="markNotificationAsRead">
                                @break
                        @case('query')
                            <a href="{{route('view-query',$un->data['url'])}}" class="nav-link" wire:click="markNotificationAsRead">
                                @break
                        @case('expense-request')
                                <a href="{{route('view-workflow-task',$un->data['url'])}}" class="nav-link" wire:click="markNotificationAsRead">
                                @break
                        @case('leave-request')
                                <a href="{{route('view-workflow-task',$un->data['url'])}}" class="nav-link" wire:click="markNotificationAsRead">
                                @break
                        @case('memo')
                                <a href="{{route('view-internal-memo',$un->data['url'])}}" class="nav-link" wire:click="markNotificationAsRead">
                                @break
                        @case('workgroup')
                        @default
                                <a href="{{route('view-workgroup-invitation',$un->data['url'])}}" class="nav-link" wire:click="markNotificationAsRead">
                    @endswitch
                            <li>
                                <div class="media">
                                    <img class="d-flex align-self-center img-radius" src="{{asset('/assets/images/avatars/thumbnails/'.$un->data['avatar']) ?? '/assets/images/avatars/thumbnails/avatar.png'}}" alt="{{$un->data['post_author']}}">
                                    <div class="media-body">
                                        <h5 class="notification-user">{{$un->data['post_author']}}</h5>
                                        <p class="notification-msg">
                                                {{ strlen(strip_tags($un->data['post_content'])) > 43 ? substr(strip_tags($un->data['post_content']), 0, 43).'...' : strip_tags($un->data['post_content']) }}

                                        </p>
                                        <span class="notification-time">{{$un->created_at->diffForHumans()}}</span>
                                    </div>
                                </div>
                            </li>
                        </a>
                @endforeach
            @endif
        </ul>
    </div>
</li>
