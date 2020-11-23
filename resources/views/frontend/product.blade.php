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
						<h4 class="title text-light"> Product </h4>
						<div class="page-next">
							<nav aria-label="breadcrumb" class="d-inline-block">
								<ul class="breadcrumb bg-white rounded shadow mb-0">
									<li class="breadcrumb-item"><a href="{{route('home')}}">Home</a></li>
									<li class="breadcrumb-item active" aria-current="page">Product</li>
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
		<!-- Crypto Portfolio end -->
		<div class="container">
			<div class="row justify-content-center">
				<div class="col-12 text-center">
					<div class="section-title mb-4 pb-2">
						<h4 class="title mb-4">Create your cryptocurrency portfolio today</h4>
						<p class="text-muted para-desc mb-0 mx-auto">Start working with <span class="text-primary font-weight-bold">Landrick</span> that can provide everything you need to generate awareness, drive traffic, connect.</p>
					</div>
				</div><!--end col-->
			</div><!--end row-->

			<div class="row">
				<div class="col-12 mt-4 pt-2">
					<img src="{{asset('/frontend/images//crypto/portfolio.png')}}" class="img-fluid mx-auto d-block" alt="">
				</div><!--end col-->
			</div><!--end row-->
		</div><!--end container-->
	</section>
@endsection
