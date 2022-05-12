@extends('layouts.app')

@section('title')
    Employees
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
			<div class="col-sm-6">
				<div class="card bg-c-pink text-white widget-visitor-card">
					<div class="card-block-small text-center">
						<h2>{{number_format($employees->where('account_status',2)->count())}}</h2>
						<h6>Terminated</h6>
						<i class="feather icon-user"></i>
					</div>
				</div>
			</div>
			<div class="col-sm-6">
				<div class="card bg-c-blue text-white widget-visitor-card">
					<div class="card-block-small text-center">
						<h2>{{number_format($employees->where('account_status',1)->count() - $employees->where('account_status',2)->count())}}</h2>
						<h6>Active</h6>
						<i class="feather icon-file-text"></i>
					</div>
				</div>
			</div>
		</div>
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
									<th>Email</th>
									<th>Mobile No.</th>
									<th>Position</th>
									<th>Department</th>
									<th>Status</th>
									<th>Action</th>
								</tr>
								</thead>
								<tbody>
								@php
									$serial = 1;
								@endphp
								@foreach($employees as $employee)
									<tr>
										<td>{{$serial++}}</td>
										<td>
											<img width="32" height="32" style="border-radius: 50%;" class="img-fluid img-radius" src="/assets/images/avatars/medium/{{$employee->avatar ?? '/assets/images/avatars/medium/avatar.png'}}" alt="{{$employee->first_name ?? ''}}  {{$employee->surname ?? ''}}">
											{{$employee->first_name ?? ''}} {{$employee->surname ?? ''}}</td>
										<td>{{$employee->email ?? ''}}</td>
										<td>{{$employee->mobile ?? '' }}</td>
										<td>{{$employee->position ?? '' }}</td>
										<td>{{$employee->department->department_name ?? ''}}</td>
										<td>
											@if ($employee->account_status == 1)
												<label for="" class="label label-success">Active</label>
											@elseif($employee->account_status == 2)
												<label for="" class="label label-danger">Terminated</label>
											@elseif($employee->account_status == 3)
												<label for="" class="label label-warning">Suspended</label>
											@endif
										</td>
										<td>
											<a href="{{route('view-profile', $employee->url)}}" class="btn-mini btn btn-info">View</a>
										</td>
									</tr>
								@endforeach
								</tbody>
								<tfoot>
								<tr>
									<th>#</th>
									<th>Full Name</th>
									<th>Email</th>
									<th>Mobile No.</th>
									<th>Position</th>
									<th>Department</th>
									<th>Status</th>
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

@section('extra-scripts')
	<script src="\assets\bower_components\datatables.net\js\jquery.dataTables.min.js"></script>
	<script src="\assets\bower_components\datatables.net-bs4\js\dataTables.bootstrap4.min.js"></script>
	<script src="\assets\bower_components\datatables.net-responsive\js\dataTables.responsive.min.js"></script>
	<script src="\assets\bower_components\datatables.net-responsive-bs4\js\responsive.bootstrap4.min.js"></script>
	<script src="\assets\pages\data-table\js\data-table-custom.js"></script>
@endsection
