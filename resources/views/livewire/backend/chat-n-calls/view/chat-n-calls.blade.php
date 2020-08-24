<div class="row">
    <!-- Message section start -->
    <div class="col-sm-12">
        <div class="card">
            <div class="card-header bg-primary">
                <div class="media">
                    <a class="media-left">
                        <img class="media-object img-radius msg-img-h" src="/assets/images/avatars/medium/{{Auth::user()->avatar ?? 'avatar.png'}}" alt="{{Auth::user()->first_name ?? ''}}">
                    </a>
                    <div class="media-body">
                        <div class="txt-white">{{Auth::user()->first_name ?? ''}} {{Auth::user()->surname ?? ''}}
                            <button class="btn btn-success btn-icon ml-4" type="button" wire:click="makeCall"><i class="icofont icofont-ui-call"></i></button>
                        </div>
                        <div class="txt-white">{{Auth::user()->position ?? ''}}</div>
                    </div>
                </div>
            </div>
            <div class="card-block">
                <div class="row" style=" min-height:100px; max-height:408px;">
                    <div class="col-lg-3 col-md-4 message-left">
                        <div class="card-block user-box contact-box assign-user" style="overflow-y: scroll; height:408px;">
                            @foreach ($users as $user)
                                <div class="media contact-wrapper" wire:click="getConversation({{$user->id}})">
                                    <div class="media-left media-middle photo-table">
                                        <a href="javascript:void(0)">
                                            <img class="media-object img-radius" src="/assets/images/avatars/thumbnails/{{$user->avatar ?? '/assets/images/avatars/avatar.png'}}" alt="{{$user->first_name}} {{$user->surname ?? ''}}">
                                        </a>
                                    </div>
                                    <div class="media-body" style="cursor: pointer;">
                                        <strong>{{$user->first_name}} {{$user->surname ?? ''}}</strong>
                                        <p>{{$user->position ?? substr($user->email, 0,15).'...'}}</p>
                                        <hr>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>
                    <div class="col-lg-9 col-md-12 messages-content ">
                        <div style="overflow-y: scroll; height:250px;">
                            @if ($selectedUserId == null )
                                <h5 class="text-center text-muted">Kindly select a contact to start conversation...</h5>
                            @else
                                @foreach ($messages as $message)
                                    @if ($message->from_id == Auth::user()->id)
                                    <div class="media">
                                        <div class="media-body text-right">
                                            @if (!empty($message->attachment))
                                                <p class="msg-reply bg-primary">
                                                    @if (pathinfo($message->attachment, PATHINFO_EXTENSION) == 'pdf')
                                                        <a href="/assets/uploads/attachments/{{$message->attachment}}">
                                                            <img src="/assets/formats/pdf.png" alt="{{Auth::user()->tenant->company_name ?? 'CNX247 ERP Solution'}}" height="180" width="180">
                                                        </a>
                                                    @else
                                                        <a href="/assets/uploads/attachments/{{$message->attachment}}">
                                                            <img src="/assets/formats/jpg.png" alt="{{Auth::user()->tenant->company_name ?? 'CNX247 ERP Solution'}}" height="180" width="180">
                                                        </a>
                                                    @endif
                                                </p>
                                                <p><i class="icofont icofont-wall-clock f-12"></i>{{date(Auth::user()->tenant->dateFormat->format ?? 'd F, Y', strtotime($message->created_at))}} @ {{date('h:ia', strtotime($message->created_at))}}</p>
                                            @elseif(!empty($message->message) )
                                                <p class="msg-reply bg-primary">{!! $message->message !!}</p>
                                                <p><i class="icofont icofont-wall-clock f-12"></i>{{date(Auth::user()->tenant->dateFormat->format ?? 'd F, Y', strtotime($message->created_at))}} @ {{date('h:ia', strtotime($message->created_at))}}</p>
                                            @endif
                                        </div>
                                        <div class="media-right friend-box">
                                            <a href="#">
                                                <img class="media-object img-radius" src="/assets/images/avatars/medium/{{Auth::user()->avatar ?? 'avatar.png'}}" alt="{{Auth::user()->first_name ?? ''}}">
                                            </a>
                                        </div>
                                    </div>
                                    @else
                                        <div class="media">
                                            <div class="media-left friend-box">
                                                <a href="#">
                                                    <img class="media-object img-radius" src="\assets\images\avatar-1.jpg" alt="">
                                                </a>
                                            </div>
                                            <div class="media-body">
                                                @if (!empty($message->attachment))
                                                    <a href="/assets/uploads/attachments/{{$message->attachment}}">
                                                        <img src="/assets/formats/jpg.png" alt="{{Auth::user()->tenant->company_name ?? 'CNX247 ERP Solution'}}" height="180" width="180">
                                                    </a>
                                                @elseif(!empty($message->message))
                                                    <p class="msg-send">
                                                        {!! $message->message  !!}
                                                    </p>
                                                @endif
                                                    <p><i class="icofont icofont-wall-clock f-12"></i> {{date(Auth::user()->tenant->dateFormat->format ?? 'd F, Y', strtotime($message->created_at))}} @ {{date('h:ia', strtotime($message->created_at))}}</p>
                                            </div>

                                        </div>
                                    @endif

                                @endforeach
                            @endif
                        </div>

                        <div class="messages-send" style="position: relative; bottom:0px; width:100%; margin-top:30px; background:none;">
                            <div class="form-group">
                                @if ($selectedUserId != null)
                                    <div class="row mb-1">
                                        <div class="col-md-12">
                                            <div class="btn-group " role="group" >
                                                <div wire:ignore style="display: inline;">
                                                    <button type="button" id="shareAttachment" class="btn btn-light btn-mini waves-effect waves-light">
                                                        <i class="icofont icofont-clip"></i></button>
                                                    <input type="file" hidden id="chatAttachment">
                                                </div>
                                                <button type="button" class="btn btn-light btn-mini waves-effect waves-light"><i class="icofont icofont-emo-heart-eyes"></i></button>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="input-group">
                                        <textarea wire:model.debounce.90000ms="message" style="height: 60px; resize:none; outline:none;" id="alighaddon2" class="form-control new-msg" placeholder="What’s on your mind.........."></textarea>
                                        <span class="input-group-addon bg-white" wire:click="sendMessage"><i class="icofont icofont-paper-plane f-18 text-primary"></i></span>
                                    </div>
                                @endif
                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>
</div>

