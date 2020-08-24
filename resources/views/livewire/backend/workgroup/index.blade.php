<div class="row">
    <div class="col-sm-12">
        <div class="card">
            <div class="card-header">
                <h5>Workgroups</h5>
                <span>You can only access a workgroup to which you're a member. </span>
                <a href="{{ route('new-workgroup') }}" class="float-right btn btn-primary btn-mini waves-effect waves-light" ><i class="ti-plus mr-2"></i>New Workgroup</a>
            </div>
            <div class="card-block">
                <div class="row">
                    <div class="col-sm-12">
                        <div class="grid">
                            @if (count($groups) > 0)
                                @foreach ($groups as $group)
                                    <figure class="effect-winston">
                                        <img src="\assets\images\light-box\l2.jpg" alt="img30">
                                        <figcaption>
                                            <h2 style="font-size: 18px; letter-spacing:1px; color:#fff;"> <a href="{{ route('view-workgroup', $group->url) }}" style="color: #fff;">{{ $group->group_name ?? ''}}</a> </h2>
                                            <span style="display:block; font-size:12px; letter-spacing:1px; text-transform:none; margin-top:30px;">{!! $group->description ?? ''!!}</span>
                                            <p>
                                                <a href="{{ route('view-workgroup', $group->url) }}"><i class="fa fa-users"></i> <span><small style="font-size: 12px;">{{count($group->member) + count($group->workgroupModerators)}}</small></span></a>
                                                <a href="{{ route('view-workgroup', $group->url) }}"><i class="fa fa-fw fa-comments-o"></i><span><small style="font-size: 12px;">{{count($group->workgroupComments)}}</small></span></a>
                                                <a href="{{ route('view-workgroup', $group->url) }}"><i class="fa fa-folder-open"></i><span><small style="font-size: 12px;">{{count($group->workgroupAttachments)}}</small></span></a>
                                            </p>

                                        </figcaption>
                                    </figure>
                                @endforeach
                            @else
                                <h5 class="text-center text-danger">Ooops! You do not have the permission to view the profile of this group.</h5>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- Gallery advance card end -->
    </div>
</div>
