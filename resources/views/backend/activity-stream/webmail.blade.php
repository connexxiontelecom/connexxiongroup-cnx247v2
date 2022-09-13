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
				<div class="btn-group">
					<a href="{{route('webmail-domain', 'connexxiongroup.com')}}" class="btn btn-primary">Connexxion Group Web Mail</a>
				</div>
			</div>
		</div>
	</div>
@endsection

@section('dialog-section')

@endsection

@section('extra-scripts')


@endsection
