@extends('layouts.app')

@section('title')
	Confirmation Requests
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
	<div class="row">
		<div class="col-sm-12">
			<div class="card card-border-primary">
				<div class="card-block">
					<div class="dt-responsive table-responsive">
						<table id="simpletable" class="table table-striped table-bordered nowrap">
							<thead>
							<tr>
								<th>#</th>
								<th>Full Name</th>
								<th>Position</th>
								<th>Confirmation Date</th>
								<th>Effective Date</th>
								<th>Status</th>
							</tr>
							</thead>
							<tbody>
							@php
								$serial = 1;
							@endphp

							@foreach($confirmations as $confirmation)
								<tr>
									<td>{{$serial++}}</td>
									<td>{{$confirmation->getUser->first_name ?? ''}}</td>
									<td>{{$confirmation->position ?? ''}}</td>
									<td>{{date('d M, Y',  strtotime($confirmation->confirmation_date)) ?? ''}}</td>
									<td>{{date('d M, Y', strtotime($confirmation->effective_date)) ?? ''}}</td>
									<td>
										@switch($confirmation->status)
											@case(0)
											<label for="" class="label label-warning">Pending</label>
											@break
											@case(1)
											<label for="" class="label label-success">Accepted</label>
											@break
											@case(0)
											<label for="" class="label label-danger">Declined</label>
											@break
										@endswitch
									</td>
								</tr>
							@endforeach

							</tbody>
							<tfoot>
							<tr>
								<th>#</th>
								<th>Full Name</th>
								<th>Position</th>
								<th>Confirmation Date</th>
								<th>Effective Date</th>
								<th>Status</th>
							</tr>
							</tfoot>
						</table>
					</div>

				</div>
			</div>
		</div>
	</div>
@endsection

@section('extra-scripts')
	<script src="\assets\bower_components\datatables.net\js\jquery.dataTables.min.js"></script>
	<script src="\assets\bower_components\datatables.net-bs4\js\dataTables.bootstrap4.min.js"></script>
	<script src="\assets\bower_components\datatables.net-responsive\js\dataTables.responsive.min.js"></script>
	<script src="\assets\bower_components\datatables.net-responsive-bs4\js\responsive.bootstrap4.min.js"></script>
	<script src="\assets\pages\data-table\js\data-table-custom.js"></script>
@endsection
