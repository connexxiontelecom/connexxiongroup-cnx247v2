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
						<a href="javascript:void(0)" class="btn btn-light">Start Free</a>
					</div>
				</div><!--end col-->
			</div><!--end row-->
		</div>
	</div><!--end container-->
	<div class="container mt-100 mt-60">
		<div class="row justify-content-center">
			<div class="col-12">
				<div class="section-title text-center mb-4 pb-2">
					<h4 class="title mb-4">Our Pricing Plans Are Transparent</h4>
					<p class="text-muted para-desc mb-0 mx-auto">View our available <a href="{{route('pricing')}}" class="text-primary">pricing</a> plan details and how they fit your teams' needs or you can get started for free. No credit card required.</p>
				</div>
			</div><!--end col-->
		</div><!--end row-->

		<div class="row align-items-end">
			<div class="col-lg-4 col-md-6 col-12 mt-4 pt-2">
				<div class="pricing text-center rounded overflow-hidden shadow">
					<div class="price-header border-bottom pt-5 pb-5">
						<h1 class="text-primary"><i class="uil uil-invoice"></i></h1>
						<h5 class="price-title">Sales Hub</h5>
						<p class="mb-0 text-muted">Suitable for 1-10 users</p>
					</div>
					<div class="border-bottom py-4">
						<h2 class="font-weight-bold">₦ 17,500</h2>
						<h6 class="text-muted mb-0 font-weight-normal">Billed monthly</h6>
						<a href="{{route('pricing')}}" class="btn btn-primary mt-4">View Details</a>
					</div>
					<div class="pricing-features text-left p-4">
						<h5>What's included</h5>
						<ul class="feature list-unstyled mb-0">
							<li class="text-muted"><i data-feather="arrow-right" class="fea icon-sm text-dark mr-2"></i>Email Campaign (10,000/mo)</li>
							<li class="text-muted mt-2"><i data-feather="arrow-right" class="fea icon-sm text-dark mr-2"></i>Bulk SMS (500/mo)</li>
							<li class="text-muted mt-2"><i data-feather="arrow-right" class="fea icon-sm text-dark mr-2"></i>Chat</li>
							<li class="text-muted mt-2"><i data-feather="arrow-right" class="fea icon-sm text-dark mr-2"></i>CRM</li>
							<li class="text-muted mt-2"><i data-feather="arrow-right" class="fea icon-sm text-dark mr-2"></i>CNX247 Drive (10GB)</li>
							<li class="text-muted mt-2"><i data-feather="arrow-right" class="fea icon-sm text-dark mr-2"></i>Basic Accounting</li>
						</ul>
					</div>
				</div><!--end price three-->
			</div><!--end col-->

			<div class="col-lg-4 col-md-6 col-12 mt-4 pt-2">
				<div class="pricing text-center rounded overflow-hidden shadow-lg">
					<div class="price-header border-bottom bg-primary pt-5 pb-5">
						<h1 class="text-white-50"><i class="uil uil-briefcase-alt"></i></h1>
						<h5 class="price-title text-white">Professional Hub</h5>
						<p class="mb-0 text-light">Suitable for 1-50 users</p>
					</div>
					<div class="border-bottom py-5">
						<h2 class="font-weight-bold">₦ 74,000</h2>
						<h6 class="text-muted mb-0 font-weight-normal">Billed monthly</h6>
						<a href="{{route('pricing')}}" class="btn btn-primary mt-4">View Details</a>
					</div>
					<div class="pricing-features text-left p-4">
						<h5>What's included</h5>
						<ul class="feature list-unstyled mb-0">
							<li class="text-muted"><i data-feather="arrow-right" class="fea icon-sm text-primary mr-2"></i>Calls (600 minutes/mo)</li>
							<li class="text-muted mt-2"><i data-feather="arrow-right" class="fea icon-sm text-primary mr-2"></i>CNX247 Stream (10 hours)</li>
							<li class="text-muted mt-2"><i data-feather="arrow-right" class="fea icon-sm text-primary mr-2"></i>Projects</li>
							<li class="text-muted mt-2"><i data-feather="arrow-right" class="fea icon-sm text-primary mr-2"></i>Reports & Analytics</li>
							<li class="text-muted mt-2"><i data-feather="arrow-right" class="fea icon-sm text-primary mr-2"></i>Human Resource</li>
							<li class="text-muted mt-2"><i data-feather="arrow-right" class="fea icon-sm text-primary mr-2"></i>Full Accounting</li>
						</ul>
						<p></p>
					</div>
				</div><!--end price three-->
			</div><!--end col-->

			<div class="col-lg-4 col-md-6 col-12 mt-4 pt-2">
				<div class="pricing text-center rounded overflow-hidden shadow">
					<div class="price-header border-bottom pt-5 pb-5">
						<h1 class="text-primary"><i class="uil uil-notes"></i></h1>
						<h5 class="price-title">Project Hub</h5>
						<p class="mb-0 text-muted">Suitable for 1-30 users</p>
					</div>
					<div class="border-bottom py-4">
						<h2 class="font-weight-bold">₦ 35,750</h2>
						<h6 class="text-muted mb-0 font-weight-normal">Billed monthly</h6>
						<a href="{{route('pricing')}}" class="btn btn-primary mt-4">View Details</a>
					</div>
					<div class="pricing-features text-left p-4">
						<h5>What's included</h5>
						<ul class="feature list-unstyled mb-0">
							<li class="text-muted"><i data-feather="arrow-right" class="fea icon-sm text-dark mr-2"></i>Activity Stream</li>
							<li class="text-muted mt-2"><i data-feather="arrow-right" class="fea icon-sm text-dark mr-2"></i>CNX247 Stream (10 hours)</li>
							<li class="text-muted mt-2"><i data-feather="arrow-right" class="fea icon-sm text-dark mr-2"></i>Projects</li>
							<li class="text-muted mt-2"><i data-feather="arrow-right" class="fea icon-sm text-dark mr-2"></i>Reports & Analytics</li>
							<li class="text-muted mt-2"><i data-feather="arrow-right" class="fea icon-sm text-dark mr-2"></i>Workgroups</li>
							<li class="text-muted mt-2"><i data-feather="arrow-right" class="fea icon-sm text-dark mr-2"></i>CNX247 (30GB)</li>
						</ul>
					</div>
				</div><!--end price three-->
			</div><!--end col-->
		</div><!--end row-->
	</div><!--end container-->
{{--	<div class="container mt-100 mt-60">--}}
{{--      <div class="row justify-content-center">--}}
{{--        <div class="col-12 text-center">--}}
{{--          <div class="section-title mb-4 pb-2">--}}
{{--            <h4 class="title mb-4">Satisfied  <span class="text-primary">Clients</span></h4>--}}
{{--            <p class="text-muted para-desc mx-auto mb-0">Start working with <span class="text-primary font-weight-bold">Landrick</span> that can provide everything you need to generate awareness, drive traffic, connect.</p>--}}
{{--          </div>--}}
{{--        </div>--}}
{{--      </div>--}}

{{--      <div class="row justify-content-center">--}}
{{--        <div class="col-lg-12 mt-4">--}}
{{--          <div id="customer-testi" class="owl-carousel owl-theme">--}}
{{--            <div class="media customer-testi m-2">--}}
{{--              <img src="{{asset('/frontend/images/client/01.jpg')}}" class="avatar avatar-small mr-3 rounded shadow" alt="">--}}
{{--              <div class="media-body content p-3 shadow rounded bg-white position-relative">--}}
{{--                <ul class="list-unstyled mb-0">--}}
{{--                  <li class="list-inline-item"><i class="mdi mdi-star text-warning"></i></li>--}}
{{--                  <li class="list-inline-item"><i class="mdi mdi-star text-warning"></i></li>--}}
{{--                  <li class="list-inline-item"><i class="mdi mdi-star text-warning"></i></li>--}}
{{--                  <li class="list-inline-item"><i class="mdi mdi-star text-warning"></i></li>--}}
{{--                  <li class="list-inline-item"><i class="mdi mdi-star text-warning"></i></li>--}}
{{--                </ul>--}}
{{--                <p class="text-muted mt-2">" It seems that only fragments of the original text remain in the Lorem Ipsum texts used today. "</p>--}}
{{--                <h6 class="text-primary">- Thomas Israel <small class="text-muted">C.E.O</small></h6>--}}
{{--              </div>--}}
{{--            </div>--}}

{{--            <div class="media customer-testi m-2">--}}
{{--              <img src="{{asset('/frontend/images/client/02.jpg')}}" class="avatar avatar-small mr-3 rounded shadow" alt="">--}}
{{--              <div class="media-body content p-3 shadow rounded bg-white position-relative">--}}
{{--                <ul class="list-unstyled mb-0">--}}
{{--                  <li class="list-inline-item"><i class="mdi mdi-star text-warning"></i></li>--}}
{{--                  <li class="list-inline-item"><i class="mdi mdi-star text-warning"></i></li>--}}
{{--                  <li class="list-inline-item"><i class="mdi mdi-star text-warning"></i></li>--}}
{{--                  <li class="list-inline-item"><i class="mdi mdi-star text-warning"></i></li>--}}
{{--                  <li class="list-inline-item"><i class="mdi mdi-star-half text-warning"></i></li>--}}
{{--                </ul>--}}
{{--                <p class="text-muted mt-2">" One disadvantage of Lorum Ipsum is that in Latin certain letters appear more frequently than others. "</p>--}}
{{--                <h6 class="text-primary">- Barbara McIntosh <small class="text-muted">M.D</small></h6>--}}
{{--              </div>--}}
{{--            </div>--}}

{{--            <div class="media customer-testi m-2">--}}
{{--              <img src="images/client/03.jpg" class="avatar avatar-small mr-3 rounded shadow" alt="">--}}
{{--              <div class="media-body content p-3 shadow rounded bg-white position-relative">--}}
{{--                <ul class="list-unstyled mb-0">--}}
{{--                  <li class="list-inline-item"><i class="mdi mdi-star text-warning"></i></li>--}}
{{--                  <li class="list-inline-item"><i class="mdi mdi-star text-warning"></i></li>--}}
{{--                  <li class="list-inline-item"><i class="mdi mdi-star text-warning"></i></li>--}}
{{--                  <li class="list-inline-item"><i class="mdi mdi-star text-warning"></i></li>--}}
{{--                  <li class="list-inline-item"><i class="mdi mdi-star text-warning"></i></li>--}}
{{--                </ul>--}}
{{--                <p class="text-muted mt-2">" The most well-known dummy text is the 'Lorem Ipsum', which is said to have originated in the 16th century. "</p>--}}
{{--                <h6 class="text-primary">- Carl Oliver <small class="text-muted">P.A</small></h6>--}}
{{--              </div>--}}
{{--            </div>--}}

{{--            <div class="media customer-testi m-2">--}}
{{--              <img src="{{asset('/frontend/images/client/04.jpg')}}" class="avatar avatar-small mr-3 rounded shadow" alt="">--}}
{{--              <div class="media-body content p-3 shadow rounded bg-white position-relative">--}}
{{--                <ul class="list-unstyled mb-0">--}}
{{--                  <li class="list-inline-item"><i class="mdi mdi-star text-warning"></i></li>--}}
{{--                  <li class="list-inline-item"><i class="mdi mdi-star text-warning"></i></li>--}}
{{--                  <li class="list-inline-item"><i class="mdi mdi-star text-warning"></i></li>--}}
{{--                  <li class="list-inline-item"><i class="mdi mdi-star text-warning"></i></li>--}}
{{--                  <li class="list-inline-item"><i class="mdi mdi-star text-warning"></i></li>--}}
{{--                </ul>--}}
{{--                <p class="text-muted mt-2">" According to most sources, Lorum Ipsum can be traced back to a text composed by Cicero. "</p>--}}
{{--                <h6 class="text-primary">- Christa Smith <small class="text-muted">Manager</small></h6>--}}
{{--              </div>--}}
{{--            </div>--}}

{{--            <div class="media customer-testi m-2">--}}
{{--              <img src="{{asset('/frontend/images/client/05.jpg')}}" class="avatar avatar-small mr-3 rounded shadow" alt="">--}}
{{--              <div class="media-body content p-3 shadow rounded bg-white position-relative">--}}
{{--                <ul class="list-unstyled mb-0">--}}
{{--                  <li class="list-inline-item"><i class="mdi mdi-star text-warning"></i></li>--}}
{{--                  <li class="list-inline-item"><i class="mdi mdi-star text-warning"></i></li>--}}
{{--                  <li class="list-inline-item"><i class="mdi mdi-star text-warning"></i></li>--}}
{{--                  <li class="list-inline-item"><i class="mdi mdi-star text-warning"></i></li>--}}
{{--                  <li class="list-inline-item"><i class="mdi mdi-star text-warning"></i></li>--}}
{{--                </ul>--}}
{{--                <p class="text-muted mt-2">" There is now an abundance of readable dummy texts. These are usually used when a text is required. "</p>--}}
{{--                <h6 class="text-primary">- Dean Tolle <small class="text-muted">Developer</small></h6>--}}
{{--              </div>--}}
{{--            </div>--}}

{{--            <div class="media customer-testi m-2">--}}
{{--              <img src="{{asset('/frontend/images/client/06.jpg')}}" class="avatar avatar-small mr-3 rounded shadow" alt="">--}}
{{--              <div class="media-body content p-3 shadow rounded bg-white position-relative">--}}
{{--                <ul class="list-unstyled mb-0">--}}
{{--                  <li class="list-inline-item"><i class="mdi mdi-star text-warning"></i></li>--}}
{{--                  <li class="list-inline-item"><i class="mdi mdi-star text-warning"></i></li>--}}
{{--                  <li class="list-inline-item"><i class="mdi mdi-star text-warning"></i></li>--}}
{{--                  <li class="list-inline-item"><i class="mdi mdi-star text-warning"></i></li>--}}
{{--                  <li class="list-inline-item"><i class="mdi mdi-star text-warning"></i></li>--}}
{{--                </ul>--}}
{{--                <p class="text-muted mt-2">" Thus, Lorem Ipsum has only limited suitability as a visual filler for German texts. "</p>--}}
{{--                <h6 class="text-primary">- Jill Webb <small class="text-muted">Designer</small></h6>--}}
{{--              </div>--}}
{{--            </div>--}}
{{--          </div>--}}
{{--        </div>--}}
{{--      </div>--}}
{{--    </div>--}}

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
