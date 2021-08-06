<table id="datatable-assignment" class="table table-striped table-bordered nowrap">
	<thead>
	<tr class="text-uppercase">
		<th>#</th>
		<th>Title</th>
		<th>Description</th>
		<th>Status</th>
		<th>Date</th>
		<th>Action</th>
	</tr>
	</thead>
	<tbody>
	@php
		$i = 1;
	@endphp
	@foreach ($requests as $request)
		@foreach($request->responsiblePersons as $person)
			@if($person->user_id == Auth::user()->id && $person->is_seen == 1)
				<tr class="table-row ">
					<td class="serial-no">{{$i++}}</td>
					<td>
						<a href="{{ route('view-workflow-task', $request->post_url) }}">{!! strlen($request->post_title) > 18 ? substr($request->post_title, 0,15).'...' : $request->post_title !!}</a>
					</td>
					<td>
						{!! strlen($request->post_content ) > 35 ? substr($request->post_content, 0,35).'...' : $request->post_content  !!}
					</td>
					<td>
						@if($request->post_status == 'in-progress')
							<label class="badge badge-warning text-white special-badge"><small class="text-uppercase">in-progress</small></label>
						@elseif($request->post_status == 'approved')
							<label class="badge badge-success special-badge"><small class="text-uppercase">approved</small></label>

						@elseif($request->post_status == 'declined')
							<label class="badge badge-danger special-badge"><small class="text-uppercase">declined</small></label>
						@endif
					</td>
					<td> <small class="text-uppercase">{{date('d M, Y | h:i a', strtotime($request->created_at))}}</small> </td>
					<td>
						<div class="btn-group mt-2">
							@if($request->post_status == 'in-progress')
								{{--@foreach($request->responsiblePersons as $app)--}}
								@if($person->user_id == Auth::user()->id && $person->status == 'in-progress')
									<a href="{{ route('view-workflow-task', $request->post_url) }}" class="btn btn-mini btn-primary">View</a>
									<!--<button class="btn btn-out-dashed btn-danger btn-square btn-mini decline-request" value="$request->id}}" data-target="#transactionPasswordModal" data-toggle="modal"><i class="ti-na mr-2"></i> DECLINE</button>

									<button type="button" class="btn btn-success btn-out-dashed btn-square btn-mini approveBtn approve-request" value="request->id}}" data-target="#transactionPasswordModal" data-toggle="modal"> <i class="ti-check-box mr-2"></i>
											APPROVE
									</button>-->
								@elseif($person->user_id == Auth::user()->id && $person->status == 'decline')
									<i>Decline,(you)</i>
								@elseif($person->user_id == Auth::user()->id && $person->status == 'approve')
									<i>Approved,(you)</i>
								@endif
								{{--	@endforeach--}}
							@endif

						</div>
						@if (session()->has('done'))
							<div class="col-md-12">
								{!! session()->get('done') !!}
							</div>
						@endif
					</td>
				</tr>

			@endif

		@endforeach
	@endforeach


	</tbody>

</table>
<div class="d-flex justify-content-center">

</div>
