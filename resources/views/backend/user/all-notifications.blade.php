@extends('layouts.app')

@section('title')
    Your Notifications
@endsection

@section('extra-styles')
<link rel="stylesheet" type="text/css" href="\assets\pages\toolbar\jquery.toolbar.css">
<link rel="stylesheet" type="text/css" href="\assets\pages\toolbar\custom-toolbar.css">
@endsection

@section('content')

<div class="card">
    <div class="card-header">
        <h5>Your Notifications</h5>
    </div>
    <div class="card-block">
        <div class="col-md-12">
            <ul class="list-view">
                @foreach ($unread as $notification)
                    <li>
                        <div class="card list-view-media" style="margin-bottom:5px;">
                            <div class="card-block">
                                <div class="media">
                                    <a class="media-left" href="#">
                                        <img class="media-object card-list-img img-30" src="/assets/images/avatars/thumbnails/{{$notification->data['avatar'] ?? '/assets/images/avatars/thumbnails/avatar.png'}}" alt="{{$notification->data['post_author']}}">
                                    </a>
                                    <div class="media-body">
                                        <div class="col-xs-12">
                                            @switch($notification->data['post_type'])
                                                @case('project')
                                                    <a href="{{route('view-project', $notification->data['url'])}}" class="nav-link">{{$notification->data['post_title'] ?? 'No title'}} </a>
                                                        @break
                                                @case('task')
                                                    <a href="{{route('view-task', $notification->data['url'])}}" class="nav-link">{{$notification->data['post_title'] ?? 'No title'}}</a>
                                                        @break
                                                @case('chat')
                                                    <a href="{{$notification->data['url']}}" class="nav-link">{{$notification->data['post_title'] ?? 'No title'}}</a>
                                                        @break
                                                @case('workgroup')
                                                @default
                                                        <a href="{{route('view-workgroup-invitation',$notification->data['url'])}}" class="nav-link">{{$notification->data['post_title'] ?? 'No title'}}</a>
                                            @endswitch

                                        </div>
                                        {!! $notification->data['post_content'] !!}
                                    </div>
                                </div>
                            </div>
                        </div>
                    </li>
                @endforeach
            </ul>
        </div>
    </div>
</div>

@endsection

@section('dialog-section')

@endsection

@section('extra-scripts')


@endsection
