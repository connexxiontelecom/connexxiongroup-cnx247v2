<div>
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-block">
                    <h4 class="sub-title">Tickets</h4>
                    <div class="btn-group d-flex justify-content-end">
                        <button type="button" data-toggle="modal" data-target="#ticketCategory" class="btn btn-mini btn-primary"><i class="ti-plus"></i> New Ticket Category</button>
                        <!--<button type="button" class="btn btn-mini btn-danger"><i class="ti-support"></i> Ticket Category</button> -->
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
                <div class="col-xl-4">
                    <div class="card">
                        <div class="card-block">
                            <table class="table matrics-table">
                                <tbody>
                                    <tr>
                                        <td>
                                            <strong>Categories</strong>
                                        </td>

                                    </tr>
                                    @foreach ($categories as $category)
                                        <tr>
                                            <td>
                                                <strong>{{$category->name}}</strong>
                                            </td>

                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
                <div class="col-xl-8">
                    <div class="card">
                        <div class="card-block">
                            <div class="table-responsive">
                                <table id="issue-list-table" class="table dt-responsive width-100">
                                    <thead class="text-left">
                                        <tr>
                                            <th>#</th>
																					<th>User</th>
																					<th>Ticket No.</th>
                                            <th>Subject</th>
                                            <th>Category</th>
                                            <th>Status</th>
                                            <th>Date</th>
                                        </tr>
                                    </thead>
                                    <tbody class="text-left">
                                        @php
                                            $index = 1;
                                        @endphp
                                        @if (count($tickets) > 0)
                                        @foreach ($tickets as $ticket)
																						@if($ticket->ticketCategory->department == Auth::user()->department_id)
																							<tr>
																								<td class="txt-primary">{{$index++}}</td>
																								<td>
																									{{$ticket->getUser->first_name ?? ''}} {{$ticket->getUser->surname ?? ''}}
																								</td>
																								<td>
																									<label for="" class="label label-primary">{{$ticket->ticket_no}}</label>
																								</td>
																								<td>
																									<a href="{{route('view-ticket', $ticket->slug)}}">{{strlen($ticket->subject) > 15 ? substr($ticket->subject,0,15).'...' : $ticket->subject }}</a>
																								</td>
																								<td>{{$ticket->ticketCategory->name}}</td>
																								<td>
																									@if ($ticket->status == 0)
																										<span class="label label-warning">Open</span>
																									@elseif($ticket->status == 1)
																										<span class="label label-success">In-progress</span>
																									@elseif($ticket->status == 2)
																										<span class="label label-success">Closed</span>
																									@endif
																								</td>
																								<td><span class="label label-danger">{{date('d-M-Y', strtotime($ticket->created_at))}}|<small>{{date('h:ia', strtotime($ticket->created_at))}}</small></span></td>
																							</tr>
																						@endif

                                        @endforeach
                                        @else
                                            <tr>
                                                <td colspan="7"> You're doing well. There're currently no tickets.</td>
                                            </tr>
                                        @endif
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@push('ticket-scripts')
    <script>
        $(document).ready(function(){
            $(document).on('click', '#addCategoryBtn', function(e){
                e.preventDefault();
                if($('#category_name').val() == ''){
                    $.notify("Ooops! Something went wrong. Try again.", "error");
                }else{
                axios.post('/crm/support/ticket/category/new', {category_name:$('#category_name').val(),
								department:$('#department').val()})
                .then(response=>{
                    $.notify(response.data.message, 'success');
                    $('#ticketCategory').modal('hide');
                    $('#category_name').val('');
									location.reload();
                })
                .catch(error=>{
                    $.notify("Ooops! We couldn't save new category. Try again.", "error");
                });

                }
            });
        });
    </script>
@endpush
