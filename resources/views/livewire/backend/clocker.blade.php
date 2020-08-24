<div class="btn-group " role="group">
    @if(empty($clocked_in))
        <button type="button" wire:click="clockinBtn" class="btn btn-success btn-mini waves-effect waves-light" data-toggle="tooltip" data-placement="top" title="" data-original-title="Clock-in">
            <i class="ti-alarm-clock"></i>Clock-in
        </button>
    @else
        @if($clocked_in->status == 1)
            <button type="button" wire:click="clockoutBtn" class="btn btn-danger btn-mini waves-effect waves-light" data-toggle="tooltip" data-placement="top" title="" data-original-title="Clock-out">
                <i class="ti-alarm-clock"></i>Clock-out
            </button>
            <button type="button" class="btn btn-inverse btn-mini waves-effect waves-light" data-toggle="tooltip" data-placement="top" title="" data-original-title="When you clocked in">
                <i class="ti-alarm-clock mr-2" wire:poll.5000ms="updateTimer"></i>{{ date('d M, Y | h:i a', strtotime($clocked_in->clock_in)) }}
            </button>
        @elseif($clocked_in->status == 0)
            <button type="button" wire:click="clockinBtn" class="btn btn-success btn-mini waves-effect waves-light" data-toggle="tooltip" data-placement="top" title="" data-original-title="Clock-in">
                <i class="ti-alarm-clock"></i>Clock-in
            </button>
        @endif
    @endif
</div>
