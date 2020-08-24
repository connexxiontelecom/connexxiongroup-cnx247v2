<div>
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-block">
                    <h4 class="sub-title">Ticket > <label for="" class="label label-primary">{{$ticket->subject ?? ''}}</label></h4>
                    <div class="btn-group d-flex justify-content-end">
                        <a href="{{route('ticket')}}" class="btn btn-mini btn-primary" type="button"><i class="ti-plus"></i> New Support Ticket</a>
                        <a href="{{route('ticket-history')}}" class="btn btn-mini btn-danger"><i class="ti-support"></i> Ticket History</a>
                    </div>
                    @if (session()->has('success'))
                        <div class="alert alert-success background-success mt-3">
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                <i class="icofont icofont-close-line-circled text-white"></i>
                            </button>
                            {!! session()->get('success') !!}
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>

    <div class="card" style="margin-top:-30px;">
        <div class="card-block email-card">
            <div class="row">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-block">
                            </h5>
                            <div class="row mt-3">
                                <div class="col-md-12 btn-add-task">
                                    @if (session()->has('success'))
                                        <div class="alert alert-success background-success mt-3">
                                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                                <i class="icofont icofont-close-line-circled text-white"></i>
                                            </button>
                                            {!! session()->get('success') !!}
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
</div>
