@extends('layouts.app')

@section('title')
    Clients
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
				<div class="col-md-12">
					<a href="{{route('new-client')}}" class="btn btn-primary btn-mini mb-4 float-right">Add New Client</a>
					<div class="dt-responsive table-responsive">
						<table id="simpletable" class="table table-striped table-bordered nowrap">
							<thead>
							<tr>
								<th>#</th>
								<th>Company Name</th>
								<th>Contact Person</th>
								<th>Mobile No.</th>
								<th>Email</th>
								<th>Action</th>
							</tr>
							</thead>
							<tbody>
							@php
								$serial = 1;
							@endphp
								@foreach($clients as $client)
									<tr>
										<td>{{$serial++}}</td>
										<td>{{$client->company_name ?? ''}}</td>
										<td>{{$client->first_name ?? ''}} {{$client->surname ?? ''}}</td>
										<td>{{$client->mobile_no ?? ''}}</td>
										<td>{{$client->email ?? ''}}</td>
										<td>
											<a href="{{route('view-client', $client->slug)}}" class="btn btn-mini btn-primary"><i class="ti-eye mr-2"></i>View</a>
										</td>
									</tr>
								@endforeach
							</tbody>
							<tfoot>
							<tr>
								<th>#</th>
								<th>Company Name</th>
								<th>Contact Person</th>
								<th>Mobile No.</th>
								<th>Email</th>
								<th>Action</th>
							</tr>
							</tfoot>
						</table>
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

@stack('client-script')
@endsection
