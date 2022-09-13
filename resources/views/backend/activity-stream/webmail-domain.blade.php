@extends('layouts.app')

@section('title')
	Web mail
@endsection

@section('extra-styles')

@endsection

@section('content')
	<div class="card">
		<div class="card-header">
			<h5>Web mail</h5>
		</div>
		<div class="card-block">

		</div>
	</div>
	<div class="tab-pane active" id="timeline">
		<div class="row">
			<div class="col-md-12 timeline-dot">
				<iframe src="https://{{$domain}}/webmail" style="width: 100%; height: 100%;"></iframe>
			</div>
		</div>
	</div>
@endsection

@section('dialog-section')

@endsection

@section('extra-scripts')


@endsection
