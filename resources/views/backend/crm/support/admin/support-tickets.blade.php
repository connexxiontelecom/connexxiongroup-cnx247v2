@extends('layouts.app')

@section('title')
	Invoice List
@endsection

@section('extra-styles')
	<link rel="stylesheet" type="text/css" href="\assets\bower_components\datatables.net-bs4\css\dataTables.bootstrap4.min.css">
	<link rel="stylesheet" type="text/css" href="\assets\pages\data-table\css\buttons.dataTables.min.css">
	<link rel="stylesheet" type="text/css" href="\assets\bower_components\datatables.net-responsive-bs4\css\responsive.bootstrap4.min.css">

	<style>
		/* The heart of the matter */

		.horizontal-scrollable > .row {
			overflow-x: auto;
			white-space: nowrap;
		}

		.horizontal-scrollable {
			overflow-x: scroll;
			overflow-y: hidden;
			white-space: nowrap;
		}
	</style>
@endsection

@section('content')
	<div class="card">
		<div class="card-block">
			<div class="row">
				<div class="col-md-12 col-sm-12 col-lg-12">
					<h5 class="sub-title text-center">
						Support Tickets
					</h5>
				</div>
			</div>

		</div>
	</div>
	<div class="row">
		<div class="col-xl-12 col-lg-12 filter-bar">
			<div class="row">
				<div class="col-sm-12">
					<div class="card card-border-primary">
						<div class="card-block">
							<div class="dt-responsive table-responsive">
								<table id="simpletable" class="table table-striped table-bordered nowrap">
									<thead>
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
									<tbody>
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
														<a href="{{route('view-ticket', $ticket->slug)}}">{{strlen($ticket->subject) > 15 ? substr($ticket->subject,0,15).'...' : $ticket->subject }}
															@if($ticket->ticketCategory->department != Auth::user()->department_id)
																<sup><label for="" class="badge badge-warning">Incoming</label></sup>
															@else
																<sup><label for="" class="badge badge-primary">Outgoing</label></sup>
															@endif
														</a>
													</td>
													<td>{{$ticket->ticketCategory->name}}</td>
													<td>
														@if ($ticket->status == 0)
															<span class="label label-default">Pending</span>
														@elseif($ticket->status == 1)
															<span class="label label-info">Open</span>
														@elseif($ticket->status == 2)
															<span class="label label-warning">In-progress</span>
															@elseif($ticket->status == 3)
															<span class="label label-success">Close</span>

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
									<tfoot>
									<tr>
										<th>#</th>
										<th>User</th>
										<th>Ticket No.</th>
										<th>Subject</th>
										<th>Category</th>
										<th>Status</th>
										<th>Date</th>
									</tr>
									</tfoot>
								</table>
							</div>

						</div>
					</div>
				</div>
			</div>
		</div>
	</div>

@endsection

@section('dialog-section')

@endsection
@section('extra-scripts')
	<script src="\assets\bower_components\datatables.net\js\jquery.dataTables.min.js"></script>
	<script src="\assets\bower_components\datatables.net-bs4\js\dataTables.bootstrap4.min.js"></script>
	<script src="\assets\bower_components\datatables.net-responsive\js\dataTables.responsive.min.js"></script>
	<script src="\assets\bower_components\datatables.net-responsive-bs4\js\responsive.bootstrap4.min.js"></script>
	<script src="\assets\pages\data-table\js\data-table-custom.js"></script>
@endsection
