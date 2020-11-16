@extends('layouts.frontend-layout')

@section('title')
    Pricing
@endsection

@section('extra-styles')

    <style>
        .card{
            border-radius: 0px !important;
        }
    </style>
@endsection

@section('content')
	<!-- Hero Start -->
	<section class="bg-half bg-dark d-table w-100" style="background-image:url('{{asset('/frontend/images/bg-5.jpg')}}'); background-size:auto ;box-shadow:inset 0 0 0 2000px rgba(0, 0, 0, 0.60);">
		<div class="container">
			<div class="row justify-content-center">
				<div class="col-lg-12 text-center">
					<div class="page-next-level">
						<h4 class="title text-light"> Pricing </h4>
						<div class="page-next">
							<nav aria-label="breadcrumb" class="d-inline-block">
								<ul class="breadcrumb bg-white rounded shadow mb-0">
									<li class="breadcrumb-item"><a href="{{route('home')}}">Home</a></li>
									<li class="breadcrumb-item active" aria-current="page">Pricing</li>
								</ul>
							</nav>
						</div>
					</div>
				</div>  <!--end col-->
			</div><!--end row-->
		</div> <!--end container-->
	</section><!--end section-->
	<!-- Hero End -->
	<section class="section">
		<div class="container">
			<div class="row justify-content-center">
				<div class="col-12 text-center">
					<div class="section-title mb-4 pb-2">
						<h4 class="title mb-4">Pricing Plans That Suit You</h4>
						<p class="text-muted para-desc mb-0 mx-auto">We chose a pricing approach that is well-suited for companies or organizations of various sizes. Whatever may be your budget, <span class="text-primary font-weight-bold">CNX247</span> offers flexible pricing plans that will get your business up and running while you devote your time to other things.</p>
					</div>
				</div>
			</div>
			<div class="row align-items-center">
				<div class="col-12 mt-0 pt-0">
					<div class="text-center">
						<ul class="nav nav-pills rounded-pill justify-content-center d-inline-block border py-1 px-2" id="pills-tab" role="tablist">
							<li class="nav-item d-inline-block">
								<a class="nav-link px-3 rounded-pill active monthly" id="Monthly" data-toggle="pill" href="#Month" role="tab" aria-controls="Month" aria-selected="true">Monthly</a>
							</li>
							<li class="nav-item d-inline-block">
								<a class="nav-link px-3 rounded-pill monthly" id="Quarterly" data-toggle="pill" href="#Quarter" role="tab" aria-controls="Quarter" aria-selected="true">Quarterly <span class="badge badge-pill badge-outline-success"> -5%</span></a>
							</li>
							<li class="nav-item d-inline-block">
								<a class="nav-link px-3 rounded-pill yearly" id="Yearly" data-toggle="pill" href="#Year" role="tab" aria-controls="Year" aria-selected="false">Yearly <span class="badge badge-pill badge-outline-success"> -9%</span></a>
							</li>
						</ul>
					</div>
					<div class="tab-content" id="pills-tabContent">
						<div class="tab-pane fade active show" id="Month" role="tabpanel" aria-labelledby="Monthly">
							<div class="row">
								@if (count($plans) > 0)
									@foreach ($plans as $plan)
										@if ($plan->duration <= 30)
											<div class="col-lg-3 col-md-6 col-12 mt-4 pt-2">
												<div class="card pricing-rates business-rate shadow bg-light border-0 rounded">
													<div class="card-body">
														<h2 class="title text-uppercase mb-4">{{substr($plan->planName->name, 0, strpos($plan->planName->name,'-'))}}</h2>
														<div class="d-flex mb-1">
															<span class="h4 mb-0 mt-2">{{$plan->currency->symbol}} </span>
															<span class="price h1 mb-0"> {{number_format($plan->price)}}</span>
															<span class="h4 align-self-end">/mo</span>
														</div>
														<small class="text-center text-muted mb-4">
															{{$plan->description}}
														</small>
														<ul class="list-unstyled mt-4 mb-0 pl-0">
															<li class="h6 text-muted mb-0">
																@if($plan->calls != 0)
																	<span class="text-primary h5 mr-2"><i class="uim uim-check-circle"></i></span>Calls: {{number_format($plan->calls).' minutes/mo'}}
																@else
																	<span class="text-danger h5 mr-2"><i class="uim uim-times-circle"></i></span>Calls
																@endif
															</li>
															<li class="h6 text-muted mb-0">
																@if($plan->emails != 0)
																	<span class="text-primary h5 mr-2"><i class="uim uim-check-circle"></i></span>Emails: {{number_format($plan->emails).'/mo'}}
																@else
																	<span class="text-danger h5 mr-2"><i class="uim uim-times-circle"></i></span>Emails
																@endif
															</li>
															<li class="h6 text-muted mb-0">
																@if($plan->sms != 0)
																	<span class="text-primary h5 mr-2"><i class="uim uim-check-circle"></i></span>SMS: {{number_format($plan->sms).'/mo'}}
																@else
																	<span class="text-danger h5 mr-2"><i class="uim uim-times-circle"></i></span>SMS
																@endif
															</li>
															<li class="h6 text-muted mb-0">
																<span class="text-primary h5 mr-2"><i class="uim uim-check-circle"></i></span>Users: {{number_format($plan->team_size).' max users'}}
															</li>
															<li class="h6 text-muted mb-0">
																@if($plan->stream != 0)
																	<span class="text-primary h5 mr-2"><i class="uim uim-check-circle"></i></span>CNX Stream: {{number_format($plan->stream).' hrs/mo'}}
																@else
																	<span class="text-danger h5 mr-2"><i class="uim uim-times-circle"></i></span>CNX Stream
																@endif
															</li>
															<li class="h6 text-muted mb-0">
																@if($plan->storage_size != 0)
																	<span class="text-primary h5 mr-2"><i class="uim uim-check-circle"></i></span>CNX Drive: {{number_format($plan->storage_size).'GB'}}
																@else
																	<span class="text-danger h5 mr-2"><i class="uim uim-times-circle"></i></span>CNX Drive: {{number_format($plan->storage_size).'GB'}}
																@endif
															</li>
															<li class="h6 text-muted mb-0">
																@if($plan->chat != 0)
																	<span class="text-primary h5 mr-2"><i class="uim uim-check-circle"></i></span>Chat
																@else
																	<span class="text-danger h5 mr-2"><i class="uim uim-times-circle"></i></span>Chat
																@endif
															</li>
															<li class="h6 text-muted mb-0">
																@if($plan->workflow != 0)
																	<span class="text-primary h5 mr-2"><i class="uim uim-check-circle"></i></span>Workflow
																@else
																	<span class="text-danger h5 mr-2"><i class="uim uim-times-circle"></i></span>Workflow
																@endif
															</li>
															<li class="h6 text-muted mb-0">
																@if($plan->activity_stream != 0)
																	<span class="text-primary h5 mr-2"><i class="uim uim-check-circle"></i></span>Activity Stream
																@else
																	<span class="text-danger h5 mr-2"><i class="uim uim-times-circle"></i></span>Activity Stream
																@endif
															</li>
															<li class="h6 text-muted mb-0">
																@if($plan->crm != 0)
																	<span class="text-primary h5 mr-2"><i class="uim uim-check-circle"></i></span>CRM
																@else
																	<span class="text-danger h5 mr-2"><i class="uim uim-times-circle"></i></span>CRM
																@endif
															</li>
															<li class="h6 text-muted mb-0">
																@if($plan->project != 0)
																	<span class="text-primary h5 mr-2"><i class="uim uim-check-circle"></i></span>Project
																@else
																	<span class="text-danger h5 mr-2"><i class="uim uim-times-circle"></i></span>Project
																@endif
															</li>
															<li class="h6 text-muted mb-0">
																@if($plan->reports != 0)
																	<span class="text-primary h5 mr-2"><i class="uim uim-check-circle"></i></span>Report & Analytics
																@else
																	<span class="text-danger h5 mr-2"><i class="uim uim-times-circle"></i></span>Report & Analytics
																@endif
															</li>
															<li class="h6 text-muted mb-0">
																@if($plan->procurement != 0)
																	<span class="text-primary h5 mr-2"><i class="uim uim-check-circle"></i></span>Procurement
																@else
																	<span class="text-danger h5 mr-2"><i class="uim uim-times-circle"></i></span>Procurement
																@endif
															</li>
															<li class="h6 text-muted mb-0">
																@if($plan->task != 0)
																	<span class="text-primary h5 mr-2"><i class="uim uim-check-circle"></i></span>Task
																@else
																	<span class="text-danger h5 mr-2"><i class="uim uim-times-circle"></i></span>Task
																@endif
															</li>
															<li class="h6 text-muted mb-0">
																@if($plan->workgroup != 0)
																	<span class="text-primary h5 mr-2"><i class="uim uim-check-circle"></i></span>Workgroup
																@else
																	<span class="text-danger h5 mr-2"><i class="uim uim-times-circle"></i></span>Workgroup
																@endif
															</li>
															<li class="h6 text-muted mb-0">
																@if($plan->clock_in != 0)
																	<span class="text-primary h5 mr-2"><i class="uim uim-check-circle"></i></span>Clock In & Out
																@else
																	<span class="text-danger h5 mr-2"><i class="uim uim-times-circle"></i></span>Clock In & Out
																@endif
															</li>
															<li class="h6 text-muted mb-0">
																@if($plan->basic_accounting != 0)
																	<span class="text-primary h5 mr-2"><i class="uim uim-check-circle"></i></span>Basic Accounting
																@else
																	<span class="text-danger h5 mr-2"><i class="uim uim-times-circle"></i></span>Basic Accounting
																@endif
															</li>
															<li class="h6 text-muted mb-0">
																@if($plan->full_accounting != 0)
																	<span class="text-primary h5 mr-2"><i class="uim uim-check-circle"></i></span>Full Accounting
																@else
																	<span class="text-danger h5 mr-2"><i class="uim uim-times-circle"></i></span>Full Accounting
																@endif
															</li>
															<li class="h6 text-muted mb-0">
																@if($plan->hr != 0)
																	<span class="text-primary h5 mr-2"><i class="uim uim-check-circle"></i></span>HR
																@else
																	<span class="text-danger h5 mr-2"><i class="uim uim-times-circle"></i></span>HR
																@endif
															</li>
															<li class="h6 text-muted mb-0">
																@if($plan->logistics != 0)
																	<span class="text-primary h5 mr-2"><i class="uim uim-check-circle"></i></span>Logistics
																@else
																	<span class="text-danger h5 mr-2"><i class="uim uim-times-circle"></i></span>Logistics
																@endif
															</li>
														</ul>
														<a href="{{route('create-site', ['timestamp'=>sha1(time()), 'plan'=>$plan->slug])}}" class="btn btn-primary mt-4">Buy Now</a>
													</div>
												</div>
											</div>
										@endif
									@endforeach
								@else
									<p class="text-center">There are no plans</p>
								@endif
							</div>
						</div>
						<div class="tab-pane fade" id="Quarter" role="tabpanel" aria-labelledby="Quarterly">
							<div class="row">
								@if (count($plans) > 0)
									@foreach ($plans as $plan)
										@if ($plan->duration > 30 && $plan->duration <= 90 )
											<div class="col-lg-3 col-md-6 col-12 mt-4 pt-2">
												<div class="card pricing-rates business-rate shadow bg-light border-0 rounded">
													<div class="card-body">
														<h2 class="title text-uppercase mb-4">{{substr($plan->planName->name, 0, strpos($plan->planName->name,'-'))}}</h2>
														<div class="d-flex mb-1">
															<span class="h4 mb-0 mt-2">{{$plan->currency->symbol}}</span>
															<span class="price h1 mb-0">{{number_format($plan->price)}}</span>
															<span class="h4 align-self-end">/mo</span>
														</div>
														<small class="text-center text-muted mb-4">
															{{$plan->description}}
														</small>
														<ul class="list-unstyled mt-4 mb-0 pl-0">
															<li class="h6 text-muted mb-0">
																@if($plan->calls != 0)
																	<span class="text-primary h5 mr-2"><i class="uim uim-check-circle"></i></span>Calls: {{number_format($plan->calls).' minutes/mo'}}
																@else
																	<span class="text-danger h5 mr-2"><i class="uim uim-times-circle"></i></span>Calls
																@endif
															</li>
															<li class="h6 text-muted mb-0">
																@if($plan->emails != 0)
																	<span class="text-primary h5 mr-2"><i class="uim uim-check-circle"></i></span>Emails: {{number_format($plan->emails).'/mo'}}
																@else
																	<span class="text-danger h5 mr-2"><i class="uim uim-times-circle"></i></span>Emails
																@endif
															</li>
															<li class="h6 text-muted mb-0">
																@if($plan->sms != 0)
																	<span class="text-primary h5 mr-2"><i class="uim uim-check-circle"></i></span>SMS: {{number_format($plan->sms).'/mo'}}
																@else
																	<span class="text-danger h5 mr-2"><i class="uim uim-times-circle"></i></span>SMS
																@endif
															</li>
															<li class="h6 text-muted mb-0">
																<span class="text-primary h5 mr-2"><i class="uim uim-check-circle"></i></span>Users: {{number_format($plan->team_size).' max users'}}
															</li>
															<li class="h6 text-muted mb-0">
																@if($plan->stream != 0)
																	<span class="text-primary h5 mr-2"><i class="uim uim-check-circle"></i></span>CNX Stream: {{number_format($plan->stream).' hrs/mo'}}
																@else
																	<span class="text-danger h5 mr-2"><i class="uim uim-times-circle"></i></span>CNX Stream
																@endif
															</li>
															<li class="h6 text-muted mb-0">
																@if($plan->storage_size != 0)
																	<span class="text-primary h5 mr-2"><i class="uim uim-check-circle"></i></span>CNX Drive: {{number_format($plan->storage_size).'GB'}}
																@else
																	<span class="text-danger h5 mr-2"><i class="uim uim-times-circle"></i></span>CNX Drive: {{number_format($plan->storage_size).'GB'}}
																@endif
															</li>
															<li class="h6 text-muted mb-0">
																@if($plan->chat != 0)
																	<span class="text-primary h5 mr-2"><i class="uim uim-check-circle"></i></span>Chat
																@else
																	<span class="text-danger h5 mr-2"><i class="uim uim-times-circle"></i></span>Chat
																@endif
															</li>
															<li class="h6 text-muted mb-0">
																@if($plan->workflow != 0)
																	<span class="text-primary h5 mr-2"><i class="uim uim-check-circle"></i></span>Workflow
																@else
																	<span class="text-danger h5 mr-2"><i class="uim uim-times-circle"></i></span>Workflow
																@endif
															</li>
															<li class="h6 text-muted mb-0">
																@if($plan->activity_stream != 0)
																	<span class="text-primary h5 mr-2"><i class="uim uim-check-circle"></i></span>Activity Stream
																@else
																	<span class="text-danger h5 mr-2"><i class="uim uim-times-circle"></i></span>Activity Stream
																@endif
															</li>
															<li class="h6 text-muted mb-0">
																@if($plan->crm != 0)
																	<span class="text-primary h5 mr-2"><i class="uim uim-check-circle"></i></span>CRM
																@else
																	<span class="text-danger h5 mr-2"><i class="uim uim-times-circle"></i></span>CRM
																@endif
															</li>
															<li class="h6 text-muted mb-0">
																@if($plan->project != 0)
																	<span class="text-primary h5 mr-2"><i class="uim uim-check-circle"></i></span>Project
																@else
																	<span class="text-danger h5 mr-2"><i class="uim uim-times-circle"></i></span>Project
																@endif
															</li>
															<li class="h6 text-muted mb-0">
																@if($plan->reports != 0)
																	<span class="text-primary h5 mr-2"><i class="uim uim-check-circle"></i></span>Report & Analytics
																@else
																	<span class="text-danger h5 mr-2"><i class="uim uim-times-circle"></i></span>Report & Analytics
																@endif
															</li>
															<li class="h6 text-muted mb-0">
																@if($plan->procurement != 0)
																	<span class="text-primary h5 mr-2"><i class="uim uim-check-circle"></i></span>Procurement
																@else
																	<span class="text-danger h5 mr-2"><i class="uim uim-times-circle"></i></span>Procurement
																@endif
															</li>
															<li class="h6 text-muted mb-0">
																@if($plan->task != 0)
																	<span class="text-primary h5 mr-2"><i class="uim uim-check-circle"></i></span>Task
																@else
																	<span class="text-danger h5 mr-2"><i class="uim uim-times-circle"></i></span>Task
																@endif
															</li>
															<li class="h6 text-muted mb-0">
																@if($plan->workgroup != 0)
																	<span class="text-primary h5 mr-2"><i class="uim uim-check-circle"></i></span>Workgroup
																@else
																	<span class="text-danger h5 mr-2"><i class="uim uim-times-circle"></i></span>Workgroup
																@endif
															</li>
															<li class="h6 text-muted mb-0">
																@if($plan->clock_in != 0)
																	<span class="text-primary h5 mr-2"><i class="uim uim-check-circle"></i></span>Clock In & Out
																@else
																	<span class="text-danger h5 mr-2"><i class="uim uim-times-circle"></i></span>Clock In & Out
																@endif
															</li>
															<li class="h6 text-muted mb-0">
																@if($plan->basic_accounting != 0)
																	<span class="text-primary h5 mr-2"><i class="uim uim-check-circle"></i></span>Basic Accounting
																@else
																	<span class="text-danger h5 mr-2"><i class="uim uim-times-circle"></i></span>Basic Accounting
																@endif
															</li>
															<li class="h6 text-muted mb-0">
																@if($plan->full_accounting != 0)
																	<span class="text-primary h5 mr-2"><i class="uim uim-check-circle"></i></span>Full Accounting
																@else
																	<span class="text-danger h5 mr-2"><i class="uim uim-times-circle"></i></span>Full Accounting
																@endif
															</li>
															<li class="h6 text-muted mb-0">
																@if($plan->hr != 0)
																	<span class="text-primary h5 mr-2"><i class="uim uim-check-circle"></i></span>HR
																@else
																	<span class="text-danger h5 mr-2"><i class="uim uim-times-circle"></i></span>HR
																@endif
															</li>
															<li class="h6 text-muted mb-0">
																@if($plan->logistics != 0)
																	<span class="text-primary h5 mr-2"><i class="uim uim-check-circle"></i></span>Logistics
																@else
																	<span class="text-danger h5 mr-2"><i class="uim uim-times-circle"></i></span>Logistics
																@endif
															</li>
														</ul>
														<a href="{{route('create-site', ['timestamp'=>sha1(time()), 'plan'=>$plan->slug])}}" class="btn btn-primary mt-4">Buy Now</a>
													</div>
												</div>
											</div>
										@endif
									@endforeach
								@else
									<p class="text-center">There are no plans </p>
								@endif
							</div>
						</div>

						<div class="tab-pane fade" id="Year" role="tabpanel" aria-labelledby="Yearly">
							<div class="row">
								@if (count($plans) > 0)
									@foreach ($plans as $plan)
										@if ($plan->duration >= 360)
											<div class="col-lg-3 col-md-6 col-12 mt-4 pt-2">
												<div class="card pricing-rates business-rate shadow bg-light border-0 rounded">
													<div class="card-body">
														<h2 class="title text-uppercase mb-4">{{substr($plan->planName->name, 0, strpos($plan->planName->name,'-'))}}</h2>
														<div class="d-flex mb-1">
															<span class="h4 mb-0 mt-2">{{$plan->currency->symbol}}</span>
															<span class="price h1 mb-0">{{number_format($plan->price)}}</span>
															<span class="h4 align-self-end">/mo</span>
														</div>
														<small class="text-center text-muted mb-4">
															{{$plan->description}}
														</small>
														<ul class="list-unstyled mt-4 mb-0 pl-0">
															<li class="h6 text-muted mb-0">
																@if($plan->calls != 0)
																	<span class="text-primary h5 mr-2"><i class="uim uim-check-circle"></i></span>Calls: {{number_format($plan->calls).' minutes/mo'}}
																@else
																	<span class="text-danger h5 mr-2"><i class="uim uim-times-circle"></i></span>Calls
																@endif
															</li>
															<li class="h6 text-muted mb-0">
																@if($plan->emails != 0)
																	<span class="text-primary h5 mr-2"><i class="uim uim-check-circle"></i></span>Emails: {{number_format($plan->emails).'/mo'}}
																@else
																	<span class="text-danger h5 mr-2"><i class="uim uim-times-circle"></i></span>Emails
																@endif
															</li>
															<li class="h6 text-muted mb-0">
																@if($plan->sms != 0)
																	<span class="text-primary h5 mr-2"><i class="uim uim-check-circle"></i></span>SMS: {{number_format($plan->sms).'/mo'}}
																@else
																	<span class="text-danger h5 mr-2"><i class="uim uim-times-circle"></i></span>SMS
																@endif
															</li>
															<li class="h6 text-muted mb-0">
																<span class="text-primary h5 mr-2"><i class="uim uim-check-circle"></i></span>Users: {{number_format($plan->team_size).' max users'}}
															</li>
															<li class="h6 text-muted mb-0">
																@if($plan->stream != 0)
																	<span class="text-primary h5 mr-2"><i class="uim uim-check-circle"></i></span>CNX Stream: {{number_format($plan->stream).' hrs/mo'}}
																@else
																	<span class="text-danger h5 mr-2"><i class="uim uim-times-circle"></i></span>CNX Stream
																@endif
															</li>
															<li class="h6 text-muted mb-0">
																@if($plan->storage_size != 0)
																	<span class="text-primary h5 mr-2"><i class="uim uim-check-circle"></i></span>CNX Drive: {{number_format($plan->storage_size).'GB'}}
																@else
																	<span class="text-danger h5 mr-2"><i class="uim uim-times-circle"></i></span>CNX Drive: {{number_format($plan->storage_size).'GB'}}
																@endif
															</li>
															<li class="h6 text-muted mb-0">
																@if($plan->chat != 0)
																	<span class="text-primary h5 mr-2"><i class="uim uim-check-circle"></i></span>Chat
																@else
																	<span class="text-danger h5 mr-2"><i class="uim uim-times-circle"></i></span>Chat
																@endif
															</li>
															<li class="h6 text-muted mb-0">
																@if($plan->workflow != 0)
																	<span class="text-primary h5 mr-2"><i class="uim uim-check-circle"></i></span>Workflow
																@else
																	<span class="text-danger h5 mr-2"><i class="uim uim-times-circle"></i></span>Workflow
																@endif
															</li>
															<li class="h6 text-muted mb-0">
																@if($plan->activity_stream != 0)
																	<span class="text-primary h5 mr-2"><i class="uim uim-check-circle"></i></span>Activity Stream
																@else
																	<span class="text-danger h5 mr-2"><i class="uim uim-times-circle"></i></span>Activity Stream
																@endif
															</li>
															<li class="h6 text-muted mb-0">
																@if($plan->crm != 0)
																	<span class="text-primary h5 mr-2"><i class="uim uim-check-circle"></i></span>CRM
																@else
																	<span class="text-danger h5 mr-2"><i class="uim uim-times-circle"></i></span>CRM
																@endif
															</li>
															<li class="h6 text-muted mb-0">
																@if($plan->project != 0)
																	<span class="text-primary h5 mr-2"><i class="uim uim-check-circle"></i></span>Project
																@else
																	<span class="text-danger h5 mr-2"><i class="uim uim-times-circle"></i></span>Project
																@endif
															</li>
															<li class="h6 text-muted mb-0">
																@if($plan->reports != 0)
																	<span class="text-primary h5 mr-2"><i class="uim uim-check-circle"></i></span>Report & Analytics
																@else
																	<span class="text-danger h5 mr-2"><i class="uim uim-times-circle"></i></span>Report & Analytics
																@endif
															</li>
															<li class="h6 text-muted mb-0">
																@if($plan->procurement != 0)
																	<span class="text-primary h5 mr-2"><i class="uim uim-check-circle"></i></span>Procurement
																@else
																	<span class="text-danger h5 mr-2"><i class="uim uim-times-circle"></i></span>Procurement
																@endif
															</li>
															<li class="h6 text-muted mb-0">
																@if($plan->task != 0)
																	<span class="text-primary h5 mr-2"><i class="uim uim-check-circle"></i></span>Task
																@else
																	<span class="text-danger h5 mr-2"><i class="uim uim-times-circle"></i></span>Task
																@endif
															</li>
															<li class="h6 text-muted mb-0">
																@if($plan->workgroup != 0)
																	<span class="text-primary h5 mr-2"><i class="uim uim-check-circle"></i></span>Workgroup
																@else
																	<span class="text-danger h5 mr-2"><i class="uim uim-times-circle"></i></span>Workgroup
																@endif
															</li>
															<li class="h6 text-muted mb-0">
																@if($plan->clock_in != 0)
																	<span class="text-primary h5 mr-2"><i class="uim uim-check-circle"></i></span>Clock In & Out
																@else
																	<span class="text-danger h5 mr-2"><i class="uim uim-times-circle"></i></span>Clock In & Out
																@endif
															</li>
															<li class="h6 text-muted mb-0">
																@if($plan->basic_accounting != 0)
																	<span class="text-primary h5 mr-2"><i class="uim uim-check-circle"></i></span>Basic Accounting
																@else
																	<span class="text-danger h5 mr-2"><i class="uim uim-times-circle"></i></span>Basic Accounting
																@endif
															</li>
															<li class="h6 text-muted mb-0">
																@if($plan->full_accounting != 0)
																	<span class="text-primary h5 mr-2"><i class="uim uim-check-circle"></i></span>Full Accounting
																@else
																	<span class="text-danger h5 mr-2"><i class="uim uim-times-circle"></i></span>Full Accounting
																@endif
															</li>
															<li class="h6 text-muted mb-0">
																@if($plan->hr != 0)
																	<span class="text-primary h5 mr-2"><i class="uim uim-check-circle"></i></span>HR
																@else
																	<span class="text-danger h5 mr-2"><i class="uim uim-times-circle"></i></span>HR
																@endif
															</li>
															<li class="h6 text-muted mb-0">
																@if($plan->logistics != 0)
																	<span class="text-primary h5 mr-2"><i class="uim uim-check-circle"></i></span>Logistics
																@else
																	<span class="text-danger h5 mr-2"><i class="uim uim-times-circle"></i></span>Logistics
																@endif
															</li>
														</ul>
														<a href="{{route('create-site', ['timestamp'=>sha1(time()), 'plan'=>$plan->slug])}}" class="btn btn-primary mt-4">Buy Now</a>
													</div>
												</div>
											</div>
										@endif
									@endforeach
								@else
									<p class="text-center">There are no plans </p>
								@endif
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</section>
	<!-- FAQ n Contact Start -->
	<section class="section bg-light">
		<div class="container">
			<div class="row mt-sm-0 pt-sm-0 justify-content-center">
				<div class="col-12 text-center">
					<div class="section-title">
						<h4 class="title mb-4">Didn't Find a Suitable Plan?</h4>
						<p class="text-muted para-desc mx-auto">We can discuss a custom-tailored solution for your business.</p>
						<div class="mt-4 pt-2">
							<a href="javascript:void(0)" class="btn btn-primary">Contact Us <i class="mdi mdi-arrow-right"></i></a>
						</div>
					</div>
				</div><!--end col-->
			</div><!--end row-->
		</div><!--end container-->
	</section><!--end section-->
	<!-- FAQ n Contact End -->
@endsection
