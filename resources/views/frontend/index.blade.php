@extends('layouts.frontend-layout')

@section('title')
  Home
@endsection

@section('content')

{{--  <section class="swiper-slider-hero position-relative d-block vh-100" id="home">--}}
{{--    <div class="swiper-container">--}}
{{--      <div class="swiper-wrapper">--}}
{{--        <div class="swiper-slide d-flex align-items-center overflow-hidden">--}}
{{--          <div class="slide-inner slide-bg-image d-flex align-items-center" style="background: center center;" data-background="{{asset('/frontend/images/bg-2.jpg')}}">--}}
{{--            <div class="bg-overlay"></div>--}}
{{--            <div class="container">--}}
{{--              <div class="row justify-content-center">--}}
{{--                <div class="col-12">--}}
{{--                  <div class="title-heading text-center">--}}
{{--                    <h1 class="heading text-white title-dark mb-4">Recreating Africa's Tomorrow</h1>--}}
{{--                    <p class="para-desc mx-auto text-white-50">An enterprise resource planning solution designed to suit the modern African workplace</p>--}}

{{--                    <div class="mt-4 pt-2">--}}
{{--                      <a href="{{route('pricing')}}" class="btn btn-primary">Get Started</a>--}}
{{--                    </div>--}}
{{--                  </div>--}}
{{--                </div>--}}
{{--              </div>--}}
{{--            </div>--}}
{{--          </div>--}}
{{--        </div>--}}

{{--        <div class="swiper-slide d-flex align-items-center overflow-hidden">--}}
{{--          <div class="slide-inner slide-bg-image d-flex align-items-center" style="background: center center;" data-background="{{asset('/frontend/images/bg-4.jpg')}}">--}}
{{--            <div class="bg-overlay"></div>--}}
{{--            <div class="container">--}}
{{--              <div class="row justify-content-center">--}}
{{--                <div class="col-12">--}}
{{--                  <div class="title-heading text-center">--}}
{{--                    <h1 class="heading text-white title-dark mb-4">Your Enterprise Rediscovered</h1>--}}
{{--                    <p class="para-desc mx-auto text-white-50">Seamlessly integrate the management of your organization's key business processes with CNX247.</p>--}}

{{--                    <div class="mt-4 pt-2">--}}
{{--                      <a href="{{route('pricing')}}" class="btn btn-primary">Get Started</a>--}}
{{--                    </div>--}}
{{--                  </div>--}}
{{--                </div>--}}
{{--              </div>--}}
{{--            </div>--}}
{{--          </div>--}}
{{--        </div>--}}
{{--      </div>--}}
{{--      <div class="swiper-button-next border rounded-circle text-center"></div>--}}
{{--      <div class="swiper-button-prev border rounded-circle text-center"></div>--}}
{{--    </div>--}}
{{--  </section>--}}
<!-- Hero Start -->
<section class="main-slider">
  <ul class="slides">
    <li class="bg-slider d-flex align-items-center" style="background-image:url('{{asset('/frontend/images/bg-2.jpg')}}')">
      <div class="bg-overlay"></div>
      <div class="container">
        <div class="row justify-content-center">
          <div class="col-12 text-center">
            <div class="title-heading text-white mt-4">
              <h1 class="display-4 title-dark font-weight-bold mb-3">Manage Your Business Smartly</h1>
              <p class="para-desc para-dark mx-auto text-light">An enterprise resource planning solution designed to suit the modern African workplace.</p>
              <div class="mt-4">
                <a href="{{route('pricing')}}" class="btn btn-primary mt-2 mouse-down">Get Started</a>
              </div>
            </div>
          </div><!--end col-->
        </div><!--end row-->
      </div>
    </li>
    <li class="bg-slider d-flex align-items-center" style="background-image:url('{{asset('/frontend/images/bg-4.jpg')}}')">
      <div class="bg-overlay"></div>
      <div class="container">
        <div class="row justify-content-center">
          <div class="col-12 text-center">
            <div class="title-heading text-white mt-4">
              <h1 class="display-4 title-dark font-weight-bold mb-3">Your Enterprise Rediscovered</h1>
              <p class="para-desc para-dark mx-auto text-light">Seamlessly integrate the management of your organization's key business processes with CNX247.</p>
              <div class="mt-4">
                <a href="{{route('pricing')}}" class="btn btn-primary mt-2 mouse-down">Get Started</a>
              </div>
            </div>
          </div><!--end col-->
        </div><!--end row-->
      </div>
    </li>
{{--    <li class="bg-slider d-flex align-items-center" style="background-image:url('images/course/bg05.jpg')">--}}
{{--      <div class="bg-overlay"></div>--}}
{{--      <div class="container">--}}
{{--        <div class="row justify-content-center">--}}
{{--          <div class="col-12 text-center">--}}
{{--            <div class="title-heading text-white mt-4">--}}
{{--              <h1 class="display-4 title-dark font-weight-bold mb-3">Education Is The Key of Success</h1>--}}
{{--              <p class="para-desc para-dark mx-auto text-light">Launch your campaign and benefit from our expertise on designing and managing conversion centered bootstrap4 html page.</p>--}}
{{--              <div class="mt-4">--}}
{{--                <a href="#instructors" class="btn btn-primary mt-2 mouse-down"><i class="mdi mdi-account"></i> Instructors</a>--}}
{{--              </div>--}}
{{--            </div>--}}
{{--          </div><!--end col-->--}}
{{--        </div><!--end row-->--}}
{{--      </div>--}}
{{--    </li>--}}
  </ul>
</section><!--end section-->
<!-- Hero End -->
<!-- FEATURES START -->
<section class="section">
  <div class="container">
    <div class="row justify-content-center">
      <div class="col-lg-12">
        <div class="features-absolute">
          <div class="row">
            <div class="col-lg-3 col-md-6 col-12">
              <div class="card features explore-feature p-4 px-md-3 border-0 rounded-md shadow text-center">
                <div class="icons rounded h2 text-center text-primary px-3">
                  <img src="{{asset('/frontend/images/icon/big.svg')}}" class="avatar avatar-small" alt="">
                </div>
                <div class="card-body p-0 content">
                  <h5 class="mt-4"><a href="javascript:void(0)" class="title text-dark">Structure</a></h5>
                  <p class="text-muted">Tailored modules that help to promote your unique business processes, increase productivity and prevent overwhelming you with information.</p>
                </div>
              </div>
            </div><!--end col-->

            <div class="col-lg-3 col-md-6 col-12 mt-4 mt-md-0 pt-2 pt-md-0">
              <div class="card features explore-feature p-4 px-md-3 border-0 rounded-md shadow text-center">
                <div class="icons rounded h2 text-center text-primary px-3">
                  <img src="{{asset('/frontend/images/icon/cloud.svg')}}" class="avatar avatar-small" alt="">
                </div>
                <div class="card-body p-0 content">
                  <h5 class="mt-4"><a href="javascript:void(0)" class="title text-dark">Cohesion</a></h5>
                  <p class="text-muted">Digital space that transcends the local office setting and provides access to your organization tasks across devices so you don't waste your time.</p>
                </div>
              </div>
            </div><!--end col-->

            <div class="col-lg-3 col-md-6 col-12 mt-4 mt-lg-0 pt-2 pt-lg-0">
              <div class="card features explore-feature p-4 px-md-3 border-0 rounded-md shadow text-center">
                <div class="icons rounded h2 text-center text-primary px-3">
                  <img src="{{asset('/frontend/images/icon/computer.svg')}}" class="avatar avatar-small" alt="">
                </div>
                <div class="card-body p-0 content">
                  <h5 class="mt-4"><a href="javascript:void(0)" class="title text-dark">Accessibility</a></h5>
                  <p class="text-muted">Software interface that eliminates complexity and bloatware allowing you to focus on what is important to you so you can get more done with less.</p>
                </div>
              </div>
            </div><!--end col-->

            <div class="col-lg-3 col-md-6 col-12 mt-4 mt-lg-0 pt-2 pt-lg-0">
              <div class="card features explore-feature p-4 px-md-3 border-0 rounded-md shadow text-center">
                <div class="icons rounded h2 text-center text-primary px-3">
                  <img src="{{asset('/frontend/images/icon/customer-service.svg')}}" class="avatar avatar-small" alt="">
                </div>
                <div class="card-body p-0 content">
                  <h5 class="mt-4"><a href="javascript:void(0)" class="title text-dark">Collaboration</a></h5>
                  <p class="text-muted">Software tools that minimize the necessary steps and enhances collaborative activities between multiple departments to accomplish complex tasks.</p>
                </div>
              </div>
            </div><!--end col-->
          </div>
        </div>
      </div>
    </div><!--end row-->
  </div><!--end container-->
</section><!--end section-->
<!-- FEATURES END -->

<section class="section pt-0">
  <div class="container">
    <div class="row justify-content-center">
      <div class="col-12 text-center">
        <div class="section-title mb-4 pb-2">
          <h4 class="title mb-3">How We Transform Your Business</h4>
          <p class="text-muted para-desc mb-0 mx-auto">Start working with <span class="text-primary font-weight-bold">CNX247</span> modules to centralize your business processes, simplify file storage, and enhance teamwork.</p>
        </div>
      </div><!--end col-->
    </div><!--end row-->
    <div class="row">
      <div class="col-lg-3 col-md-4 mt-4 pt-2">
        <div class="card features fea-primary rounded p-4 bg-light text-center position-relative overflow-hidden border-0">
          <span class="h1 icon2 text-primary">
            <i class="uil uil-chart-line"></i>
          </span>
          <div class="card-body p-0 content">
            <h5>Accounting</h5>
            <p class="para text-muted mb-0">Financial tools to enhance your back office operations.</p>
          </div>
          <span class="big-icon text-center">
            <i class="uil uil-chart-line"></i>
          </span>
        </div>
      </div><!--end col-->

      <div class="col-lg-3 col-md-4 mt-4 pt-2">
        <div class="card features fea-primary rounded p-4 bg-light text-center position-relative overflow-hidden border-0">
          <span class="h1 icon2 text-primary">
            <i class="uil uil-folder"></i>
          </span>
          <div class="card-body p-0 content">
            <h5>File Management</h5>
            <p class="para text-muted mb-0">Share and organize files securely among your team.</p>
          </div>
          <span class="big-icon text-center">
            <i class="uil uil-folder"></i>
          </span>
        </div>
      </div><!--end col-->

      <div class="col-lg-3 col-md-4 mt-4 pt-2">
        <div class="card features fea-primary rounded p-4 bg-light text-center position-relative overflow-hidden border-0">
          <span class="h1 icon2 text-primary">
            <i class="uil uil-briefcase-alt"></i>
          </span>
          <div class="card-body p-0 content">
            <h5>CRM</h5>
            <p class="para text-muted mb-0">Convert leads and engage with clients to grow revenue.</p>
          </div>
          <span class="big-icon text-center">
            <i class="uil uil-briefcase-alt"></i>
          </span>
        </div>
      </div><!--end col-->

      <div class="col-lg-3 col-md-4 mt-4 pt-2">
        <div class="card features fea-primary rounded p-4 bg-light text-center position-relative overflow-hidden border-0">
          <span class="h1 icon2 text-primary">
            <i class="uil uil-map"></i>
          </span>
          <div class="card-body p-0 content">
            <h5>Logistics</h5>
            <p class="para text-muted mb-0">Centralized management of your company's vehicles.</p>
          </div>
          <span class="big-icon text-center">
            <i class="uil uil-map"></i>
          </span>
        </div>
      </div><!--end col-->

      <div class="col-lg-3 col-md-4 mt-4 pt-2">
        <div class="card features fea-primary rounded p-4 bg-light text-center position-relative overflow-hidden border-0">
          <span class="h1 icon2 text-primary">
            <i class="uil uil-transaction"></i>
          </span>
          <div class="card-body p-0 content">
            <h5>Procurement</h5>
            <p class="para text-muted mb-0">Order management tools to streamline your purchases.</p>
          </div>
          <span class="big-icon text-center">
            <i class="uil uil-transaction"></i>
          </span>
        </div>
      </div><!--end col-->

      <div class="col-lg-3 col-md-4 mt-4 pt-2">
        <div class="card features fea-primary rounded p-4 bg-light text-center position-relative overflow-hidden border-0">
          <span class="h1 icon2 text-primary">
            <i class="uil uil-users-alt"></i>
          </span>
          <div class="card-body p-0 content">
            <h5>HR Management</h5>
            <p class="para text-muted mb-0">Tools for HR processes so you can manage your team.</p>
          </div>
          <span class="big-icon text-center">
            <i class="uil uil-users-alt"></i>
          </span>
        </div>
      </div><!--end col-->

      <div class="col-lg-3 col-md-4 mt-4 pt-2">
        <div class="card features fea-primary rounded p-4 bg-light text-center position-relative overflow-hidden border-0">
          <span class="h1 icon2 text-primary">
            <i class="uil uil-envelopes"></i>
          </span>
          <div class="card-body p-0 content">
            <h5>Communication</h5>
            <p class="para text-muted mb-0">Keep in touch with your team, wherever you are.</p>
          </div>
          <span class="big-icon text-center">
            <i class="uil uil-envelopes"></i>
          </span>
        </div>
      </div><!--end col-->

      <div class="col-lg-3 col-md-4 mt-4 pt-2">
        <div class="card features fea-primary rounded p-4 bg-light text-center position-relative overflow-hidden border-0">
          <span class="h1 icon2 text-primary">
            <i class="uil uil-schedule"></i>
          </span>
          <div class="card-body p-0 content">
            <h5>Project Management</h5>
            <p class="para text-muted mb-0">Plan and assign tasks efficiently for your projects.</p>
          </div>
          <span class="big-icon text-center">
            <i class="uil uil-schedule"></i>
          </span>
        </div>
      </div><!--end col-->
    </div><!--end row-->
  </div>
  <div class="container mt-100">
    <div class="row justify-content-start">
      <div class="col-12 text-left">
        <div class="section-title mb-4 pb-2">
          <h4 class="title mb-2"><span class="text-primary">Unlimited</span> Productivity</h4>
          <p class="text-muted mb-0 mx-auto">
            <span class="text-primary font-weight-bold">CNX247</span> allows you bring your office with you on the go. Keep up
            <br> with all the latest activities, assign and view your daily tasks, and
            <br> generate or respond to the workflows in your organization remotely.
          </p>
        </div>
      </div><!--end col-->
    </div><!--end row-->
    <div class="container">
      <div class="row align-items-center">
        <div class="col-md-5">
          <ul class="nav nav-pills nav-justified flex-column rounded" id="pills-tab" role="tablist">
            <li class="nav-item">
              <a class="nav-link rounded active" id="pills-cloud-tab" data-toggle="pill" href="#pills-cloud" role="tab" aria-controls="pills-cloud" aria-selected="false">
                <div class="p-3 text-left">
                  <h4 class="title font-weight-bold">Activity Stream</h4>
                  <p class="text-muted tab-para mb-0">Keep up with all the latest activities, news & events that concern you and your organization as a whole regardless of where you are or the role you play.</p>
{{--                  <p class="text-muted tab-para mb-0">Dummy text is text that is used in the publishing industry or by web designers to occupy the space which will later be filled with 'real' content.</p>--}}
                </div>
              </a><!--end nav link-->
            </li><!--end nav item-->

            <li class="nav-item">
              <a class="nav-link border-top rounded" id="pills-smart-tab" data-toggle="pill" href="#pills-smart" role="tab" aria-controls="pills-smart" aria-selected="false">
                <div class="p-3 text-left">
                  <h4 class="title font-weight-bold">Project & Task Management</h4>
                  <p class="text-muted tab-para mb-0">Breakdown projects into manageable tasks and monitor each task through its various stages from start to finish with the goal of successfully completing it.</p>
{{--                  <p class="text-muted tab-para mb-0">Dummy text is text that is used in the publishing industry or by web designers to occupy the space which will later be filled with 'real' content.</p>--}}
                </div>
              </a><!--end nav link-->
            </li><!--end nav item-->

            <li class="nav-item">
              <a class="nav-link border-top rounded" id="pills-apps-tab" data-toggle="pill" href="#pills-apps" role="tab" aria-controls="pills-apps" aria-selected="false">
                <div class="p-3 text-left">
                  <h4 class="title font-weight-bold">Workflows</h4>
                  <p class="text-muted tab-para mb-0">Automate the multilevel approval workflow processes in your organization to get things done quickly and effectively.</p>
                </div>
              </a><!--end nav link-->
            </li><!--end nav item-->
          </ul><!--end nav pills-->
        </div><!--end col-->

        <div class="col-md-7 col-12 mt-4 pt-2 mt-sm-0 pt-sm-0">
          <div class="position-relative">
            <div class="tab-content ml-lg-4" id="pills-tabContent">
              <div class="tab-pane fade show active" id="pills-cloud" role="tabpanel" aria-labelledby="pills-cloud-tab">
                <img src="{{asset('/frontend/images/activity-stream-screen.png')}}" class="img-fluid mx-auto" alt="">
              </div><!--end teb pane-->

              <div class="tab-pane fade" id="pills-smart" role="tabpanel" aria-labelledby="pills-smart-tab">
                <img src="{{asset('/frontend/images/task-screen.png')}}" class="img-fluid mx-auto" alt="">
              </div><!--end teb pane-->

              <div class="tab-pane fade" id="pills-apps" role="tabpanel" aria-labelledby="pills-apps-tab">
                <img src="{{asset('/frontend/images/workflow-screen.png')}}" class="img-fluid mx-auto" alt="">
              </div><!--end teb pane-->
            </div><!--end tab content-->
          </div>
        </div><!--end col-->
      </div><!--end row-->
    </div><!--end container-->
  </div><!--end container-->

	<div class="container mt-100">
		<div class="row justify-content-start">
			<div class="col-12 text-left">
				<div class="section-title mb-4 pb-2">
					<h4 class="title mb-2"><span class="text-primary">Seamless</span> Collaboration</h4>
					<p class="text-muted mb-0 mx-auto">
						Send and receive messages, host meetings, and webinars,
						<br> create, store, share, and collaborate on your files and documents
						<br> all remotely with <span class="text-primary font-weight-bold">CNX247</span>.
					</p>
				</div>
			</div><!--end col-->
		</div><!--end row-->
		<div class="container">
			<div class="row align-items-center">
				<div class="col-md-5">
					<ul class="nav nav-pills nav-justified flex-column rounded" id="pills-tab" role="tablist">
						<li class="nav-item">
							<a class="nav-link rounded active" id="pills-cloud-tab" data-toggle="pill" href="#pills-cloud-1" role="tab" aria-controls="pills-cloud" aria-selected="false">
								<div class="p-3 text-left">
									<h4 class="title font-weight-bold">Chats & Calls</h4>
									<p class="text-muted tab-para mb-0">Send and receive messages and make phone calls to your team efficiently with the simple and interactive chat & call features.</p>
								</div>
							</a><!--end nav link-->
						</li><!--end nav item-->

						<li class="nav-item">
							<a class="nav-link border-top rounded" id="pills-smart-tab" data-toggle="pill" href="#pills-smart-1" role="tab" aria-controls="pills-smart" aria-selected="false">
								<div class="p-3 text-left">
									<h4 class="title font-weight-bold">CNX247 Stream</h4>
									<p class="text-muted tab-para mb-0">Easily set up web conferencing meetings from any location with CNX247 Stream to collaborate with your team across multiple locations.</p>
								</div>
							</a><!--end nav link-->
						</li><!--end nav item-->

						<li class="nav-item">
							<a class="nav-link border-top rounded" id="pills-apps-tab" data-toggle="pill" href="#pills-apps-1" role="tab" aria-controls="pills-apps" aria-selected="false">
								<div class="p-3 text-left">
									<h4 class="title font-weight-bold">CNX247 Drive</h4>
									<p class="text-muted tab-para mb-0">Upload and store documents, images, videos, and audios on CNX247 Drive for sharing with other individuals in your team.</p>
								</div>
							</a><!--end nav link-->
						</li><!--end nav item-->
					</ul><!--end nav pills-->
				</div><!--end col-->

				<div class="col-md-7 col-12 mt-4 pt-2 mt-sm-0 pt-sm-0">
					<div class="position-relative">
						<div class="tab-content ml-lg-4" id="pills-tabContent">
							<div class="tab-pane fade show active" id="pills-cloud-1" role="tabpanel" aria-labelledby="pills-cloud-tab">
								<img src="{{asset('/frontend/images/chats-calls-screen.png')}}" class="img-fluid mx-auto" alt="">
							</div><!--end teb pane-->

							<div class="tab-pane fade" id="pills-smart-1" role="tabpanel" aria-labelledby="pills-smart-tab">
								<img src="{{asset('/frontend/images/stream-screen.png')}}" class="img-fluid mx-auto" alt="">
							</div><!--end teb pane-->

							<div class="tab-pane fade" id="pills-apps-1" role="tabpanel" aria-labelledby="pills-apps-tab">
								<img src="{{asset('/frontend/images/drive-screen.png')}}" class="img-fluid mx-auto" alt="">
							</div><!--end teb pane-->
						</div><!--end tab content-->
					</div>
				</div><!--end col-->
			</div><!--end row-->
		</div><!--end container-->
	</div>
	<div class="container mt-100 mt-60">
		<div class="rounded bg-primary p-lg-5 p-4">
			<div class="row align-items-end">
				<div class="col-md-8">
					<div class="section-title text-md-left text-center">
						<h4 class="title mb-3 text-white title-dark">Start your free 2 week trial today</h4>
						<p class="text-white-50 mb-0">Start working with CNX247 free today to see how we suit your business needs.</p>
					</div>
				</div><!--end col-->
				<div class="col-md-4 mt-4 mt-sm-0">
					<div class="text-md-right text-center">
						<a href="{{route('start-trial')}}" class="btn btn-light">Start Free</a>
					</div>
				</div><!--end col-->
			</div><!--end row-->
		</div>
	</div><!--end container-->

{{--	<section class="section">--}}
{{--		<div class="container">--}}
{{--			<div class="row justify-content-center">--}}
{{--				<div class="col-12 text-center">--}}
{{--					<div class="section-title mb-4 pb-2">--}}
{{--						<h4 class="title mb-4">Pricing Plans That Suit You</h4>--}}
{{--						<p class="text-muted para-desc mb-0 mx-auto">Our Pricing Plans Are Transparent and well-suited for companies or organizations of various sizes. Whatever may be your budget, <span class="text-primary font-weight-bold">CNX247</span> offers flexible pricing plans that will get your business up and running while you devote your time to other things.</p>--}}
{{--					</div>--}}
{{--				</div>--}}
{{--			</div>--}}
{{--			<div class="row align-items-center">--}}
{{--				<div class="col-12 mt-0 pt-0">--}}
{{--					<div class="text-center">--}}
{{--						<ul class="nav nav-pills rounded-pill justify-content-center d-inline-block border py-1 px-2" id="pills-tab" role="tablist">--}}
{{--							<li class="nav-item d-inline-block">--}}
{{--								<a class="nav-link px-3 rounded-pill active monthly" id="Monthly" data-toggle="pill" href="#Month" role="tab" aria-controls="Month" aria-selected="true">Monthly</a>--}}
{{--							</li>--}}
{{--							<li class="nav-item d-inline-block">--}}
{{--								<a class="nav-link px-3 rounded-pill monthly" id="Quarterly" data-toggle="pill" href="#Quarter" role="tab" aria-controls="Quarter" aria-selected="true">Quarterly <span class="badge badge-pill badge-outline-success"> -5%</span></a>--}}
{{--							</li>--}}
{{--							<li class="nav-item d-inline-block">--}}
{{--								<a class="nav-link px-3 rounded-pill yearly" id="Yearly" data-toggle="pill" href="#Year" role="tab" aria-controls="Year" aria-selected="false">Yearly <span class="badge badge-pill badge-outline-success"> -9%</span></a>--}}
{{--							</li>--}}
{{--						</ul>--}}
{{--					</div>--}}
{{--					<div class="tab-content" id="pills-tabContent">--}}
{{--						<div class="tab-pane fade active show" id="Month" role="tabpanel" aria-labelledby="Monthly">--}}
{{--							<div class="row">--}}
{{--								@if (count($plans) > 0)--}}
{{--									@foreach ($plans as $plan)--}}
{{--										@if ($plan->duration <= 30)--}}
{{--											<div class="col-lg-3 col-md-6 col-12 mt-4 pt-2">--}}
{{--												<div class="card pricing-rates business-rate shadow bg-light border-0 rounded">--}}
{{--													<div class="card-body">--}}
{{--														<h2 class="title text-uppercase mb-4">{{substr($plan->planName->name, 0, strpos($plan->planName->name,'-'))}}</h2>--}}
{{--														<div class="d-flex mb-1">--}}
{{--															<span class="h4 mb-0 mt-2">{{$plan->currency->symbol}} </span>--}}
{{--															<span class="price h1 mb-0"> {{number_format($plan->price)}}</span>--}}
{{--															<span class="h4 align-self-end">/mo</span>--}}
{{--														</div>--}}
{{--														<small class="text-center text-muted mb-4">--}}
{{--															{{$plan->description}}--}}
{{--														</small>--}}
{{--														<ul class="list-unstyled mt-4 mb-0 pl-0">--}}
{{--															<li class="h6 text-muted mb-0">--}}
{{--																@if($plan->calls != 0)--}}
{{--																	<span class="text-primary h5 mr-2"><i class="uim uim-check-circle"></i></span>Calls: {{number_format($plan->calls).' minutes/mo'}}--}}
{{--																@else--}}
{{--																	<span class="text-danger h5 mr-2"><i class="uim uim-times-circle"></i></span>Calls--}}
{{--																@endif--}}
{{--															</li>--}}
{{--															<li class="h6 text-muted mb-0">--}}
{{--																@if($plan->emails != 0)--}}
{{--																	<span class="text-primary h5 mr-2"><i class="uim uim-check-circle"></i></span>Emails: {{number_format($plan->emails).'/mo'}}--}}
{{--																@else--}}
{{--																	<span class="text-danger h5 mr-2"><i class="uim uim-times-circle"></i></span>Emails--}}
{{--																@endif--}}
{{--															</li>--}}
{{--															<li class="h6 text-muted mb-0">--}}
{{--																@if($plan->sms != 0)--}}
{{--																	<span class="text-primary h5 mr-2"><i class="uim uim-check-circle"></i></span>SMS: {{number_format($plan->sms).'/mo'}}--}}
{{--																@else--}}
{{--																	<span class="text-danger h5 mr-2"><i class="uim uim-times-circle"></i></span>SMS--}}
{{--																@endif--}}
{{--															</li>--}}
{{--															<li class="h6 text-muted mb-0">--}}
{{--																<span class="text-primary h5 mr-2"><i class="uim uim-check-circle"></i></span>Users: {{number_format($plan->team_size).' max users'}}--}}
{{--															</li>--}}
{{--															<li class="h6 text-muted mb-0">--}}
{{--																@if($plan->stream != 0)--}}
{{--																	<span class="text-primary h5 mr-2"><i class="uim uim-check-circle"></i></span>CNX Stream: {{number_format($plan->stream).' hrs/mo'}}--}}
{{--																@else--}}
{{--																	<span class="text-danger h5 mr-2"><i class="uim uim-times-circle"></i></span>CNX Stream--}}
{{--																@endif--}}
{{--															</li>--}}
{{--															<li class="h6 text-muted mb-0">--}}
{{--																@if($plan->storage_size != 0)--}}
{{--																	<span class="text-primary h5 mr-2"><i class="uim uim-check-circle"></i></span>CNX Drive: {{number_format($plan->storage_size).'GB'}}--}}
{{--																@else--}}
{{--																	<span class="text-danger h5 mr-2"><i class="uim uim-times-circle"></i></span>CNX Drive: {{number_format($plan->storage_size).'GB'}}--}}
{{--																@endif--}}
{{--															</li>--}}
{{--															<li class="h6 text-muted mb-0">--}}
{{--																@if($plan->chat != 0)--}}
{{--																	<span class="text-primary h5 mr-2"><i class="uim uim-check-circle"></i></span>Chat--}}
{{--																@else--}}
{{--																	<span class="text-danger h5 mr-2"><i class="uim uim-times-circle"></i></span>Chat--}}
{{--																@endif--}}
{{--															</li>--}}
{{--															<li class="h6 text-muted mb-0">--}}
{{--																@if($plan->workflow != 0)--}}
{{--																	<span class="text-primary h5 mr-2"><i class="uim uim-check-circle"></i></span>Workflow--}}
{{--																@else--}}
{{--																	<span class="text-danger h5 mr-2"><i class="uim uim-times-circle"></i></span>Workflow--}}
{{--																@endif--}}
{{--															</li>--}}
{{--															<li class="h6 text-muted mb-0">--}}
{{--																@if($plan->activity_stream != 0)--}}
{{--																	<span class="text-primary h5 mr-2"><i class="uim uim-check-circle"></i></span>Activity Stream--}}
{{--																@else--}}
{{--																	<span class="text-danger h5 mr-2"><i class="uim uim-times-circle"></i></span>Activity Stream--}}
{{--																@endif--}}
{{--															</li>--}}
{{--															<li class="h6 text-muted mb-0">--}}
{{--																@if($plan->crm != 0)--}}
{{--																	<span class="text-primary h5 mr-2"><i class="uim uim-check-circle"></i></span>CRM--}}
{{--																@else--}}
{{--																	<span class="text-danger h5 mr-2"><i class="uim uim-times-circle"></i></span>CRM--}}
{{--																@endif--}}
{{--															</li>--}}
{{--															<li class="h6 text-muted mb-0">--}}
{{--																@if($plan->project != 0)--}}
{{--																	<span class="text-primary h5 mr-2"><i class="uim uim-check-circle"></i></span>Project--}}
{{--																@else--}}
{{--																	<span class="text-danger h5 mr-2"><i class="uim uim-times-circle"></i></span>Project--}}
{{--																@endif--}}
{{--															</li>--}}
{{--															<li class="h6 text-muted mb-0">--}}
{{--																@if($plan->reports != 0)--}}
{{--																	<span class="text-primary h5 mr-2"><i class="uim uim-check-circle"></i></span>Report & Analytics--}}
{{--																@else--}}
{{--																	<span class="text-danger h5 mr-2"><i class="uim uim-times-circle"></i></span>Report & Analytics--}}
{{--																@endif--}}
{{--															</li>--}}
{{--															<li class="h6 text-muted mb-0">--}}
{{--																@if($plan->procurement != 0)--}}
{{--																	<span class="text-primary h5 mr-2"><i class="uim uim-check-circle"></i></span>Procurement--}}
{{--																@else--}}
{{--																	<span class="text-danger h5 mr-2"><i class="uim uim-times-circle"></i></span>Procurement--}}
{{--																@endif--}}
{{--															</li>--}}
{{--															<li class="h6 text-muted mb-0">--}}
{{--																@if($plan->task != 0)--}}
{{--																	<span class="text-primary h5 mr-2"><i class="uim uim-check-circle"></i></span>Task--}}
{{--																@else--}}
{{--																	<span class="text-danger h5 mr-2"><i class="uim uim-times-circle"></i></span>Task--}}
{{--																@endif--}}
{{--															</li>--}}
{{--															<li class="h6 text-muted mb-0">--}}
{{--																@if($plan->workgroup != 0)--}}
{{--																	<span class="text-primary h5 mr-2"><i class="uim uim-check-circle"></i></span>Workgroup--}}
{{--																@else--}}
{{--																	<span class="text-danger h5 mr-2"><i class="uim uim-times-circle"></i></span>Workgroup--}}
{{--																@endif--}}
{{--															</li>--}}
{{--															<li class="h6 text-muted mb-0">--}}
{{--																@if($plan->clock_in != 0)--}}
{{--																	<span class="text-primary h5 mr-2"><i class="uim uim-check-circle"></i></span>Clock In & Out--}}
{{--																@else--}}
{{--																	<span class="text-danger h5 mr-2"><i class="uim uim-times-circle"></i></span>Clock In & Out--}}
{{--																@endif--}}
{{--															</li>--}}
{{--															<li class="h6 text-muted mb-0">--}}
{{--																@if($plan->basic_accounting != 0)--}}
{{--																	<span class="text-primary h5 mr-2"><i class="uim uim-check-circle"></i></span>Basic Accounting--}}
{{--																@else--}}
{{--																	<span class="text-danger h5 mr-2"><i class="uim uim-times-circle"></i></span>Basic Accounting--}}
{{--																@endif--}}
{{--															</li>--}}
{{--															<li class="h6 text-muted mb-0">--}}
{{--																@if($plan->full_accounting != 0)--}}
{{--																	<span class="text-primary h5 mr-2"><i class="uim uim-check-circle"></i></span>Full Accounting--}}
{{--																@else--}}
{{--																	<span class="text-danger h5 mr-2"><i class="uim uim-times-circle"></i></span>Full Accounting--}}
{{--																@endif--}}
{{--															</li>--}}
{{--															<li class="h6 text-muted mb-0">--}}
{{--																@if($plan->hr != 0)--}}
{{--																	<span class="text-primary h5 mr-2"><i class="uim uim-check-circle"></i></span>HR--}}
{{--																@else--}}
{{--																	<span class="text-danger h5 mr-2"><i class="uim uim-times-circle"></i></span>HR--}}
{{--																@endif--}}
{{--															</li>--}}
{{--															<li class="h6 text-muted mb-0">--}}
{{--																@if($plan->logistics != 0)--}}
{{--																	<span class="text-primary h5 mr-2"><i class="uim uim-check-circle"></i></span>Logistics--}}
{{--																@else--}}
{{--																	<span class="text-danger h5 mr-2"><i class="uim uim-times-circle"></i></span>Logistics--}}
{{--																@endif--}}
{{--															</li>--}}
{{--														</ul>--}}
{{--														<a href="{{route('create-site', ['timestamp'=>sha1(time()), 'plan'=>$plan->slug])}}" class="btn btn-primary mt-4">Buy Now</a>--}}
{{--													</div>--}}
{{--												</div>--}}
{{--											</div>--}}
{{--										@endif--}}
{{--									@endforeach--}}
{{--								@else--}}
{{--									<p class="text-center">There are no plans</p>--}}
{{--								@endif--}}
{{--							</div>--}}
{{--						</div>--}}
{{--						<div class="tab-pane fade" id="Quarter" role="tabpanel" aria-labelledby="Quarterly">--}}
{{--							<div class="row">--}}
{{--								@if (count($plans) > 0)--}}
{{--									@foreach ($plans as $plan)--}}
{{--										@if ($plan->duration > 30 && $plan->duration <= 90 )--}}
{{--											<div class="col-lg-3 col-md-6 col-12 mt-4 pt-2">--}}
{{--												<div class="card pricing-rates business-rate shadow bg-light border-0 rounded">--}}
{{--													<div class="card-body">--}}
{{--														<h2 class="title text-uppercase mb-4">{{substr($plan->planName->name, 0, strpos($plan->planName->name,'-'))}}</h2>--}}
{{--														<div class="d-flex mb-1">--}}
{{--															<span class="h4 mb-0 mt-2">{{$plan->currency->symbol}}</span>--}}
{{--															<span class="price h1 mb-0">{{number_format($plan->price)}}</span>--}}
{{--															<span class="h4 align-self-end">/mo</span>--}}
{{--														</div>--}}
{{--														<small class="text-center text-muted mb-4">--}}
{{--															{{$plan->description}}--}}
{{--														</small>--}}
{{--														<ul class="list-unstyled mt-4 mb-0 pl-0">--}}
{{--															<li class="h6 text-muted mb-0">--}}
{{--																@if($plan->calls != 0)--}}
{{--																	<span class="text-primary h5 mr-2"><i class="uim uim-check-circle"></i></span>Calls: {{number_format($plan->calls).' minutes/mo'}}--}}
{{--																@else--}}
{{--																	<span class="text-danger h5 mr-2"><i class="uim uim-times-circle"></i></span>Calls--}}
{{--																@endif--}}
{{--															</li>--}}
{{--															<li class="h6 text-muted mb-0">--}}
{{--																@if($plan->emails != 0)--}}
{{--																	<span class="text-primary h5 mr-2"><i class="uim uim-check-circle"></i></span>Emails: {{number_format($plan->emails).'/mo'}}--}}
{{--																@else--}}
{{--																	<span class="text-danger h5 mr-2"><i class="uim uim-times-circle"></i></span>Emails--}}
{{--																@endif--}}
{{--															</li>--}}
{{--															<li class="h6 text-muted mb-0">--}}
{{--																@if($plan->sms != 0)--}}
{{--																	<span class="text-primary h5 mr-2"><i class="uim uim-check-circle"></i></span>SMS: {{number_format($plan->sms).'/mo'}}--}}
{{--																@else--}}
{{--																	<span class="text-danger h5 mr-2"><i class="uim uim-times-circle"></i></span>SMS--}}
{{--																@endif--}}
{{--															</li>--}}
{{--															<li class="h6 text-muted mb-0">--}}
{{--																<span class="text-primary h5 mr-2"><i class="uim uim-check-circle"></i></span>Users: {{number_format($plan->team_size).' max users'}}--}}
{{--															</li>--}}
{{--															<li class="h6 text-muted mb-0">--}}
{{--																@if($plan->stream != 0)--}}
{{--																	<span class="text-primary h5 mr-2"><i class="uim uim-check-circle"></i></span>CNX Stream: {{number_format($plan->stream).' hrs/mo'}}--}}
{{--																@else--}}
{{--																	<span class="text-danger h5 mr-2"><i class="uim uim-times-circle"></i></span>CNX Stream--}}
{{--																@endif--}}
{{--															</li>--}}
{{--															<li class="h6 text-muted mb-0">--}}
{{--																@if($plan->storage_size != 0)--}}
{{--																	<span class="text-primary h5 mr-2"><i class="uim uim-check-circle"></i></span>CNX Drive: {{number_format($plan->storage_size).'GB'}}--}}
{{--																@else--}}
{{--																	<span class="text-danger h5 mr-2"><i class="uim uim-times-circle"></i></span>CNX Drive: {{number_format($plan->storage_size).'GB'}}--}}
{{--																@endif--}}
{{--															</li>--}}
{{--															<li class="h6 text-muted mb-0">--}}
{{--																@if($plan->chat != 0)--}}
{{--																	<span class="text-primary h5 mr-2"><i class="uim uim-check-circle"></i></span>Chat--}}
{{--																@else--}}
{{--																	<span class="text-danger h5 mr-2"><i class="uim uim-times-circle"></i></span>Chat--}}
{{--																@endif--}}
{{--															</li>--}}
{{--															<li class="h6 text-muted mb-0">--}}
{{--																@if($plan->workflow != 0)--}}
{{--																	<span class="text-primary h5 mr-2"><i class="uim uim-check-circle"></i></span>Workflow--}}
{{--																@else--}}
{{--																	<span class="text-danger h5 mr-2"><i class="uim uim-times-circle"></i></span>Workflow--}}
{{--																@endif--}}
{{--															</li>--}}
{{--															<li class="h6 text-muted mb-0">--}}
{{--																@if($plan->activity_stream != 0)--}}
{{--																	<span class="text-primary h5 mr-2"><i class="uim uim-check-circle"></i></span>Activity Stream--}}
{{--																@else--}}
{{--																	<span class="text-danger h5 mr-2"><i class="uim uim-times-circle"></i></span>Activity Stream--}}
{{--																@endif--}}
{{--															</li>--}}
{{--															<li class="h6 text-muted mb-0">--}}
{{--																@if($plan->crm != 0)--}}
{{--																	<span class="text-primary h5 mr-2"><i class="uim uim-check-circle"></i></span>CRM--}}
{{--																@else--}}
{{--																	<span class="text-danger h5 mr-2"><i class="uim uim-times-circle"></i></span>CRM--}}
{{--																@endif--}}
{{--															</li>--}}
{{--															<li class="h6 text-muted mb-0">--}}
{{--																@if($plan->project != 0)--}}
{{--																	<span class="text-primary h5 mr-2"><i class="uim uim-check-circle"></i></span>Project--}}
{{--																@else--}}
{{--																	<span class="text-danger h5 mr-2"><i class="uim uim-times-circle"></i></span>Project--}}
{{--																@endif--}}
{{--															</li>--}}
{{--															<li class="h6 text-muted mb-0">--}}
{{--																@if($plan->reports != 0)--}}
{{--																	<span class="text-primary h5 mr-2"><i class="uim uim-check-circle"></i></span>Report & Analytics--}}
{{--																@else--}}
{{--																	<span class="text-danger h5 mr-2"><i class="uim uim-times-circle"></i></span>Report & Analytics--}}
{{--																@endif--}}
{{--															</li>--}}
{{--															<li class="h6 text-muted mb-0">--}}
{{--																@if($plan->procurement != 0)--}}
{{--																	<span class="text-primary h5 mr-2"><i class="uim uim-check-circle"></i></span>Procurement--}}
{{--																@else--}}
{{--																	<span class="text-danger h5 mr-2"><i class="uim uim-times-circle"></i></span>Procurement--}}
{{--																@endif--}}
{{--															</li>--}}
{{--															<li class="h6 text-muted mb-0">--}}
{{--																@if($plan->task != 0)--}}
{{--																	<span class="text-primary h5 mr-2"><i class="uim uim-check-circle"></i></span>Task--}}
{{--																@else--}}
{{--																	<span class="text-danger h5 mr-2"><i class="uim uim-times-circle"></i></span>Task--}}
{{--																@endif--}}
{{--															</li>--}}
{{--															<li class="h6 text-muted mb-0">--}}
{{--																@if($plan->workgroup != 0)--}}
{{--																	<span class="text-primary h5 mr-2"><i class="uim uim-check-circle"></i></span>Workgroup--}}
{{--																@else--}}
{{--																	<span class="text-danger h5 mr-2"><i class="uim uim-times-circle"></i></span>Workgroup--}}
{{--																@endif--}}
{{--															</li>--}}
{{--															<li class="h6 text-muted mb-0">--}}
{{--																@if($plan->clock_in != 0)--}}
{{--																	<span class="text-primary h5 mr-2"><i class="uim uim-check-circle"></i></span>Clock In & Out--}}
{{--																@else--}}
{{--																	<span class="text-danger h5 mr-2"><i class="uim uim-times-circle"></i></span>Clock In & Out--}}
{{--																@endif--}}
{{--															</li>--}}
{{--															<li class="h6 text-muted mb-0">--}}
{{--																@if($plan->basic_accounting != 0)--}}
{{--																	<span class="text-primary h5 mr-2"><i class="uim uim-check-circle"></i></span>Basic Accounting--}}
{{--																@else--}}
{{--																	<span class="text-danger h5 mr-2"><i class="uim uim-times-circle"></i></span>Basic Accounting--}}
{{--																@endif--}}
{{--															</li>--}}
{{--															<li class="h6 text-muted mb-0">--}}
{{--																@if($plan->full_accounting != 0)--}}
{{--																	<span class="text-primary h5 mr-2"><i class="uim uim-check-circle"></i></span>Full Accounting--}}
{{--																@else--}}
{{--																	<span class="text-danger h5 mr-2"><i class="uim uim-times-circle"></i></span>Full Accounting--}}
{{--																@endif--}}
{{--															</li>--}}
{{--															<li class="h6 text-muted mb-0">--}}
{{--																@if($plan->hr != 0)--}}
{{--																	<span class="text-primary h5 mr-2"><i class="uim uim-check-circle"></i></span>HR--}}
{{--																@else--}}
{{--																	<span class="text-danger h5 mr-2"><i class="uim uim-times-circle"></i></span>HR--}}
{{--																@endif--}}
{{--															</li>--}}
{{--															<li class="h6 text-muted mb-0">--}}
{{--																@if($plan->logistics != 0)--}}
{{--																	<span class="text-primary h5 mr-2"><i class="uim uim-check-circle"></i></span>Logistics--}}
{{--																@else--}}
{{--																	<span class="text-danger h5 mr-2"><i class="uim uim-times-circle"></i></span>Logistics--}}
{{--																@endif--}}
{{--															</li>--}}
{{--														</ul>--}}
{{--														<a href="{{route('create-site', ['timestamp'=>sha1(time()), 'plan'=>$plan->slug])}}" class="btn btn-primary mt-4">Buy Now</a>--}}
{{--													</div>--}}
{{--												</div>--}}
{{--											</div>--}}
{{--										@endif--}}
{{--									@endforeach--}}
{{--								@else--}}
{{--									<p class="text-center">There are no plans </p>--}}
{{--								@endif--}}
{{--							</div>--}}
{{--						</div>--}}

{{--						<div class="tab-pane fade" id="Year" role="tabpanel" aria-labelledby="Yearly">--}}
{{--							<div class="row">--}}
{{--								@if (count($plans) > 0)--}}
{{--									@foreach ($plans as $plan)--}}
{{--										@if ($plan->duration >= 360)--}}
{{--											<div class="col-lg-3 col-md-6 col-12 mt-4 pt-2">--}}
{{--												<div class="card pricing-rates business-rate shadow bg-light border-0 rounded">--}}
{{--													<div class="card-body">--}}
{{--														<h2 class="title text-uppercase mb-4">{{substr($plan->planName->name, 0, strpos($plan->planName->name,'-'))}}</h2>--}}
{{--														<div class="d-flex mb-1">--}}
{{--															<span class="h4 mb-0 mt-2">{{$plan->currency->symbol}}</span>--}}
{{--															<span class="price h1 mb-0">{{number_format($plan->price)}}</span>--}}
{{--															<span class="h4 align-self-end">/mo</span>--}}
{{--														</div>--}}
{{--														<small class="text-center text-muted mb-4">--}}
{{--															{{$plan->description}}--}}
{{--														</small>--}}
{{--														<ul class="list-unstyled mt-4 mb-0 pl-0">--}}
{{--															<li class="h6 text-muted mb-0">--}}
{{--																@if($plan->calls != 0)--}}
{{--																	<span class="text-primary h5 mr-2"><i class="uim uim-check-circle"></i></span>Calls: {{number_format($plan->calls).' minutes/mo'}}--}}
{{--																@else--}}
{{--																	<span class="text-danger h5 mr-2"><i class="uim uim-times-circle"></i></span>Calls--}}
{{--																@endif--}}
{{--															</li>--}}
{{--															<li class="h6 text-muted mb-0">--}}
{{--																@if($plan->emails != 0)--}}
{{--																	<span class="text-primary h5 mr-2"><i class="uim uim-check-circle"></i></span>Emails: {{number_format($plan->emails).'/mo'}}--}}
{{--																@else--}}
{{--																	<span class="text-danger h5 mr-2"><i class="uim uim-times-circle"></i></span>Emails--}}
{{--																@endif--}}
{{--															</li>--}}
{{--															<li class="h6 text-muted mb-0">--}}
{{--																@if($plan->sms != 0)--}}
{{--																	<span class="text-primary h5 mr-2"><i class="uim uim-check-circle"></i></span>SMS: {{number_format($plan->sms).'/mo'}}--}}
{{--																@else--}}
{{--																	<span class="text-danger h5 mr-2"><i class="uim uim-times-circle"></i></span>SMS--}}
{{--																@endif--}}
{{--															</li>--}}
{{--															<li class="h6 text-muted mb-0">--}}
{{--																<span class="text-primary h5 mr-2"><i class="uim uim-check-circle"></i></span>Users: {{number_format($plan->team_size).' max users'}}--}}
{{--															</li>--}}
{{--															<li class="h6 text-muted mb-0">--}}
{{--																@if($plan->stream != 0)--}}
{{--																	<span class="text-primary h5 mr-2"><i class="uim uim-check-circle"></i></span>CNX Stream: {{number_format($plan->stream).' hrs/mo'}}--}}
{{--																@else--}}
{{--																	<span class="text-danger h5 mr-2"><i class="uim uim-times-circle"></i></span>CNX Stream--}}
{{--																@endif--}}
{{--															</li>--}}
{{--															<li class="h6 text-muted mb-0">--}}
{{--																@if($plan->storage_size != 0)--}}
{{--																	<span class="text-primary h5 mr-2"><i class="uim uim-check-circle"></i></span>CNX Drive: {{number_format($plan->storage_size).'GB'}}--}}
{{--																@else--}}
{{--																	<span class="text-danger h5 mr-2"><i class="uim uim-times-circle"></i></span>CNX Drive: {{number_format($plan->storage_size).'GB'}}--}}
{{--																@endif--}}
{{--															</li>--}}
{{--															<li class="h6 text-muted mb-0">--}}
{{--																@if($plan->chat != 0)--}}
{{--																	<span class="text-primary h5 mr-2"><i class="uim uim-check-circle"></i></span>Chat--}}
{{--																@else--}}
{{--																	<span class="text-danger h5 mr-2"><i class="uim uim-times-circle"></i></span>Chat--}}
{{--																@endif--}}
{{--															</li>--}}
{{--															<li class="h6 text-muted mb-0">--}}
{{--																@if($plan->workflow != 0)--}}
{{--																	<span class="text-primary h5 mr-2"><i class="uim uim-check-circle"></i></span>Workflow--}}
{{--																@else--}}
{{--																	<span class="text-danger h5 mr-2"><i class="uim uim-times-circle"></i></span>Workflow--}}
{{--																@endif--}}
{{--															</li>--}}
{{--															<li class="h6 text-muted mb-0">--}}
{{--																@if($plan->activity_stream != 0)--}}
{{--																	<span class="text-primary h5 mr-2"><i class="uim uim-check-circle"></i></span>Activity Stream--}}
{{--																@else--}}
{{--																	<span class="text-danger h5 mr-2"><i class="uim uim-times-circle"></i></span>Activity Stream--}}
{{--																@endif--}}
{{--															</li>--}}
{{--															<li class="h6 text-muted mb-0">--}}
{{--																@if($plan->crm != 0)--}}
{{--																	<span class="text-primary h5 mr-2"><i class="uim uim-check-circle"></i></span>CRM--}}
{{--																@else--}}
{{--																	<span class="text-danger h5 mr-2"><i class="uim uim-times-circle"></i></span>CRM--}}
{{--																@endif--}}
{{--															</li>--}}
{{--															<li class="h6 text-muted mb-0">--}}
{{--																@if($plan->project != 0)--}}
{{--																	<span class="text-primary h5 mr-2"><i class="uim uim-check-circle"></i></span>Project--}}
{{--																@else--}}
{{--																	<span class="text-danger h5 mr-2"><i class="uim uim-times-circle"></i></span>Project--}}
{{--																@endif--}}
{{--															</li>--}}
{{--															<li class="h6 text-muted mb-0">--}}
{{--																@if($plan->reports != 0)--}}
{{--																	<span class="text-primary h5 mr-2"><i class="uim uim-check-circle"></i></span>Report & Analytics--}}
{{--																@else--}}
{{--																	<span class="text-danger h5 mr-2"><i class="uim uim-times-circle"></i></span>Report & Analytics--}}
{{--																@endif--}}
{{--															</li>--}}
{{--															<li class="h6 text-muted mb-0">--}}
{{--																@if($plan->procurement != 0)--}}
{{--																	<span class="text-primary h5 mr-2"><i class="uim uim-check-circle"></i></span>Procurement--}}
{{--																@else--}}
{{--																	<span class="text-danger h5 mr-2"><i class="uim uim-times-circle"></i></span>Procurement--}}
{{--																@endif--}}
{{--															</li>--}}
{{--															<li class="h6 text-muted mb-0">--}}
{{--																@if($plan->task != 0)--}}
{{--																	<span class="text-primary h5 mr-2"><i class="uim uim-check-circle"></i></span>Task--}}
{{--																@else--}}
{{--																	<span class="text-danger h5 mr-2"><i class="uim uim-times-circle"></i></span>Task--}}
{{--																@endif--}}
{{--															</li>--}}
{{--															<li class="h6 text-muted mb-0">--}}
{{--																@if($plan->workgroup != 0)--}}
{{--																	<span class="text-primary h5 mr-2"><i class="uim uim-check-circle"></i></span>Workgroup--}}
{{--																@else--}}
{{--																	<span class="text-danger h5 mr-2"><i class="uim uim-times-circle"></i></span>Workgroup--}}
{{--																@endif--}}
{{--															</li>--}}
{{--															<li class="h6 text-muted mb-0">--}}
{{--																@if($plan->clock_in != 0)--}}
{{--																	<span class="text-primary h5 mr-2"><i class="uim uim-check-circle"></i></span>Clock In & Out--}}
{{--																@else--}}
{{--																	<span class="text-danger h5 mr-2"><i class="uim uim-times-circle"></i></span>Clock In & Out--}}
{{--																@endif--}}
{{--															</li>--}}
{{--															<li class="h6 text-muted mb-0">--}}
{{--																@if($plan->basic_accounting != 0)--}}
{{--																	<span class="text-primary h5 mr-2"><i class="uim uim-check-circle"></i></span>Basic Accounting--}}
{{--																@else--}}
{{--																	<span class="text-danger h5 mr-2"><i class="uim uim-times-circle"></i></span>Basic Accounting--}}
{{--																@endif--}}
{{--															</li>--}}
{{--															<li class="h6 text-muted mb-0">--}}
{{--																@if($plan->full_accounting != 0)--}}
{{--																	<span class="text-primary h5 mr-2"><i class="uim uim-check-circle"></i></span>Full Accounting--}}
{{--																@else--}}
{{--																	<span class="text-danger h5 mr-2"><i class="uim uim-times-circle"></i></span>Full Accounting--}}
{{--																@endif--}}
{{--															</li>--}}
{{--															<li class="h6 text-muted mb-0">--}}
{{--																@if($plan->hr != 0)--}}
{{--																	<span class="text-primary h5 mr-2"><i class="uim uim-check-circle"></i></span>HR--}}
{{--																@else--}}
{{--																	<span class="text-danger h5 mr-2"><i class="uim uim-times-circle"></i></span>HR--}}
{{--																@endif--}}
{{--															</li>--}}
{{--															<li class="h6 text-muted mb-0">--}}
{{--																@if($plan->logistics != 0)--}}
{{--																	<span class="text-primary h5 mr-2"><i class="uim uim-check-circle"></i></span>Logistics--}}
{{--																@else--}}
{{--																	<span class="text-danger h5 mr-2"><i class="uim uim-times-circle"></i></span>Logistics--}}
{{--																@endif--}}
{{--															</li>--}}
{{--														</ul>--}}
{{--														<a href="{{route('create-site', ['timestamp'=>sha1(time()), 'plan'=>$plan->slug])}}" class="btn btn-primary mt-4">Buy Now</a>--}}
{{--													</div>--}}
{{--												</div>--}}
{{--											</div>--}}
{{--										@endif--}}
{{--									@endforeach--}}
{{--								@else--}}
{{--									<p class="text-center">There are no plans </p>--}}
{{--								@endif--}}
{{--							</div>--}}
{{--						</div>--}}
{{--					</div>--}}
{{--				</div>--}}
{{--			</div>--}}
{{--		</div>--}}
{{--	</section>--}}

	<div class="container mt-100 mt-60">
		<div class="row justify-content-center">
			<div class="col-lg-4 col-12">
				<div class="sticky-bar">
					<div class="section-title text-lg-left text-center mb-4 mb-lg-0 pb-2 pb-lg-0">
						<h4 class="title mb-4">Flexible Pricing Hubs Suited To Your Use Case</h4>
{{--						<p class="text-muted para-desc mb-0 mx-auto">Start working with <span class="text-primary font-weight-bold">Landrick</span> that can provide everything you need to generate awareness, drive traffic, connect.</p>--}}
					</div>
				</div>
			</div><!--end col-->

			<div class="col-lg-8 col-12">
				<div class="row align-items-center">
					<div class="col-md-6">
						<div class="row">
							<div class="col-12 mt-4 mt-lg-0 pt-2 pt-lg-0">
								<div class="card features fea-primary work-process border-0 rounded shadow">
									<div class="card-body">
										<h4 class="title">Sales Hub</h4>
										<ul class="list-unstyled d-flex justify-content-between mb-0 mt-2">
											<li class="h6 mb-2 font-weight-light">₦ 17,500 per month</li>
										</ul>
										<p class="text-muted para">Reduce the paperwork involved with maintaining an overview of your clients, leads, & deals and engaging basic accounting features.</p>
									</div>
								</div>
							</div><!--end col-->

							<div class="col-12 mt-4 pt-2">
								<div class="card features fea-primary work-process border-0 rounded shadow">
									<div class="card-body">
										<h4 class="title">Project Hub</h4>
										<ul class="list-unstyled d-flex justify-content-between mb-0 mt-2">
											<li class="h6 mb-2 font-weight-light">₦ 35,750 per month</li>
										</ul>
										<p class="text-muted para">Centralize the processes involved in the management of your projects and teams to efficiently reach your organization's goals.</p>
									</div>
								</div>
							</div><!--end col-->

							<div class="col-12 mt-4 pt-2">
								<div class="card features fea-primary work-process border-0 rounded shadow">
									<div class="card-body">
										<h4 class="title">Professional Hub</h4>
										<ul class="list-unstyled d-flex justify-content-between mb-0 mt-2">
											<li class="h6 mb-2 font-weight-light">₦ 74,000 per month</li>
										</ul>
										<p class="text-muted para">Bring all your teams of professionals together and enjoy the experience of the full capabilities of the CNX247 ERP Solution.</p>
									</div>
								</div>
							</div><!--end col-->
						</div><!--end row-->
					</div><!--end col-->

					<div class="col-md-6">
						<div class="row">
							<div class="col-12 mt-4 mt-sm-0 pt-2 pt-sm-0">
								<div class="card features fea-primary work-process border-0 rounded shadow">
									<div class="card-body">
										<h4 class="title">Essential Sales Hub</h4>
										<ul class="list-unstyled d-flex justify-content-between mb-0 mt-2">
											<li class="h6 mb-2 font-weight-light">₦ 24,800 per month</li>
										</ul>
										<p class="text-muted para">Extend the Sales Hub features to meet the demands of a larger team including reporting & analytics capabilities and the activity stream.</p>
									</div>
								</div>
							</div><!--end col-->

							<div class="col-12 mt-4 pt-2">
								<div class="card features fea-primary work-process border-0 rounded shadow">
									<div class="card-body">
										<h4 class="title">Work Hub</h4>
										<ul class="list-unstyled d-flex justify-content-between mb-0 mt-2">
											<li class="h6 mb-2 font-weight-light">₦ 44,000 per month</li>
										</ul>
										<p class="text-muted para">Move your workplace online and streamline your workflows with communication, procurement, time management, and HR features.</p>
									</div>
								</div>
							</div><!--end col-->

							<div class="col-12 mt-4 pt-2 text-center text-md-left">
								<a href="{{route('pricing')}}" class="btn btn-primary">View Details <i data-feather="arrow-right" class="fea icon-sm"></i></a>
							</div><!--end col-->
						</div><!--end row-->
					</div><!--end col-->
				</div><!--end row-->
			</div><!--end col-->
		</div><!--end row-->
	</div><!--end container-->

	<div class="container mb-md-1 mb-1 mt-100 mt-60">
		<div class="row justify-content-center">
			<div class="col-12 text-center">
				<div class="section-title">
					<h4 class="title mb-4">See everything about your employee in one place.</h4>
					<p class="text-muted para-desc mx-auto mb-0">Start working with <span class="text-primary font-weight-bold">{{config('app.name')}}</span>. The application provides everything you need to keep tabs on your staff or colleagues, get update on recent happenings and much more.</p>

					<div class="mt-4">
						<a href="{{route('pricing')}}" class="btn btn-primary mt-2 mr-2">Get Started Now</a>
{{--              <a href="{{route('faqs')}}" class="btn btn-outline-primary mt-2">Learn More</a>--}}
					</div>
				</div>
			</div>
		</div>
	</div>
</section>
@endsection
