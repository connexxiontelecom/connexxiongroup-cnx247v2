@extends('layouts.frontend-layout')

@section('title')
  Home
@endsection

@section('content')

  <section class="swiper-slider-hero position-relative d-block vh-100" id="home">
    <div class="swiper-container">
      <div class="swiper-wrapper">
        <div class="swiper-slide d-flex align-items-center overflow-hidden">
          <div class="slide-inner slide-bg-image d-flex align-items-center" style="background: center center;" data-background="{{asset('/frontend/images/bg-2.jpg')}}">
            <div class="bg-overlay"></div>
            <div class="container">
              <div class="row justify-content-center">
                <div class="col-12">
                  <div class="title-heading text-center">
                    <h1 class="heading text-white title-dark mb-4">Recreating Africa's Tomorrow</h1>
                    <p class="para-desc mx-auto text-white-50">An enterprise resource planning solution designed to suit the modern African workplace</p>

                    <div class="mt-4 pt-2">
                      <a href="{{route('pricing')}}" class="btn btn-primary">Get Started</a>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>

        <div class="swiper-slide d-flex align-items-center overflow-hidden">
          <div class="slide-inner slide-bg-image d-flex align-items-center" style="background: center center;" data-background="{{asset('/frontend/images/bg-4.jpg')}}">
            <div class="bg-overlay"></div>
            <div class="container">
              <div class="row justify-content-center">
                <div class="col-12">
                  <div class="title-heading text-center">
                    <h1 class="heading text-white title-dark mb-4">Your Enterprise Rediscovered</h1>
                    <p class="para-desc mx-auto text-white-50">Seamlessly integrate the management of your organization's key business processes with CNX247.</p>

                    <div class="mt-4 pt-2">
                      <a href="{{route('pricing')}}" class="btn btn-primary">Get Started</a>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
{{--      <div class="swiper-button-next border rounded-circle text-center"></div>--}}
{{--      <div class="swiper-button-prev border rounded-circle text-center"></div>--}}
    </div>
  </section>
  <section class="section">
    <div class="container">
      <div class="row justify-content-center">
        <div class="col-lg-12">
          <div class="features-absolute">
            <div class="row">
              <div class="col-lg-3 col-md-6 col-12">
                <div class="card features explore-feature p-4 px-md-3 border-0 rounded-md shadow text-center">
{{--                  <div class="icons rounded h2 text-center text-primary px-3">--}}
{{--                    <i class="uil uil-airplay"></i>--}}
{{--                  </div>--}}
                  <div class="icons rounded h2 text-center text-primary px-3">
                    <img src="{{asset('/frontend/images/icon/big.svg')}}" class="avatar avatar-small" alt="">
                  </div>
                  <div class="card-body p-0 content">
                    <h5 class="mt-4"><a href="javascript:void(0)" class="title text-dark">Structure</a></h5>
                    <p class="text-muted">
                      Tailored modules that help to promote your unique business processes, increase
                      productivity and prevent overwhelming you with information.
                    </p>
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
                    <p class="text-muted">
                      Digital space that transcends the local office setting and provides access to your organization tasks
                      across devices so you don't waste any of your time.
                    </p>
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
                    <p class="text-muted">
                      Software interface that eliminates complexity and bloatware allowing you to focus on what's
                      important so you can get more things done with less.
                    </p>
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
                    <p class="text-muted">
                      Software tools that minimize the necessary steps and enhances collaborative activities between multiple departments to
                      accomplish complex tasks.
                    </p>
                  </div>
                </div>
              </div><!--end col-->
            </div>
          </div>
        </div>
      </div><!--end row-->
    </div><!--end container-->
    <div class="container mt-5">
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
    {{--    <div class="container">--}}
    {{--        <div class="row">--}}
    {{--            <div class="col-md-4 col-12">--}}
    {{--                <div class="features">--}}
    {{--                    <div class="image position-relative d-inline-block">--}}
    {{--                        <img src="{{asset('/frontend/images/icon/user.svg')}}" class="avatar avatar-small" alt="">--}}
    {{--                    </div>--}}

    {{--                    <div class="content mt-4">--}}
    {{--                        <h4 class="title-2">Easy To Use</h4>--}}
    {{--                        <p class="text-muted mb-0">Nisi aenean vulputate eleifend tellus vitae eleifend enim a Aliquam eleifend aenean elementum semper.</p>--}}
    {{--                    </div>--}}
    {{--                </div>--}}
    {{--            </div>--}}

    {{--            <div class="col-md-4 col-12 mt-5 mt-sm-0">--}}
    {{--                <div class="features">--}}
    {{--                    <div class="image position-relative d-inline-block">--}}
    {{--                        <img src="{{asset('/frontend/images/icon/calendar.svg')}}" class="avatar avatar-small" alt="">--}}
    {{--                    </div>--}}

    {{--                    <div class="content mt-4">--}}
    {{--                        <h4 class="title-2">Daily Reports</h4>--}}
    {{--                        <p class="text-muted mb-0">Allegedly, a Latin scholar established the origin of the established text by compiling unusual word.</p>--}}
    {{--                    </div>--}}
    {{--                </div>--}}
    {{--            </div><!--end col-->--}}

    {{--            <div class="col-md-4 col-12 mt-5 mt-sm-0">--}}
    {{--                <div class="features">--}}
    {{--                    <div class="image position-relative d-inline-block">--}}
    {{--                        <img src="{{asset('/frontend/images/icon/sand-clock.svg')}}" class="avatar avatar-small" alt="">--}}
    {{--                    </div>--}}

    {{--                    <div class="content mt-4">--}}
    {{--                        <h4 class="title-2">Real Time Zone</h4>--}}
    {{--                        <p class="text-muted mb-0">It seems that only fragments of the original text remain in only fragments the Lorem Ipsum texts used today.</p>--}}
    {{--                    </div>--}}
    {{--                </div>--}}
    {{--            </div>--}}
    {{--        </div>--}}
    {{--    </div>--}}

    <div class="container mt-100 mt-60">
      <div class="row align-items-center">
        <div class="col-lg-6 col-md-6">
          <img src="{{asset('/frontend/images/saas/1.png')}}" class="img-fluid shadow rounded" alt="">
        </div><!--end col-->

        <div class="col-lg-6 col-md-6 mt-4 mt-sm-0 pt-2 pt-sm-0">
          <div class="section-title ml-lg-5">
            <h4 class="title mb-4">Great Product Analytics With Real Problem</h4>
            <p class="text-muted">Due to its widespread use as filler text for layouts, non-readability is of great importance: human perception is tuned to recognize certain patterns and repetitions in texts. If the distribution of letters visual impact.</p>
            <ul class="list-unstyled text-muted">
              <li class="mb-0"><span class="text-primary h5 mr-2"><i class="uim uim-check-circle"></i></span>Digital Marketing Solutions for Tomorrow</li>
              <li class="mb-0"><span class="text-primary h5 mr-2"><i class="uim uim-check-circle"></i></span>Create your own skin to match your brand</li>
            </ul>
            <a href="javascript:void(0)" class="mt-3 h6 text-primary">Find Out More <i class="mdi mdi-chevron-right"></i></a>
          </div>
        </div><!--end col-->
      </div><!--end row-->
    </div><!--end container-->

    <div class="container mt-100 mt-60">
      <div class="row align-items-center">
        <div class="col-lg-7 col-md-6 order-2 order-md-1 mt-4 mt-sm-0 pt-2 pt-sm-0">
          <div class="section-title mr-lg-5">
            <h4 class="title mb-4">Get Notified About Importent Email</h4>
            <p class="text-muted">This prevents repetitive patterns from impairing the overall visual impression and facilitates the comparison of different typefaces. Furthermore, it is advantageous when the dummy text is relatively realistic.</p>
            <ul class="list-unstyled text-muted">
              <li class="mb-0"><span class="text-primary h5 mr-2"><i class="uim uim-check-circle"></i></span>Digital Marketing Solutions for Tomorrow</li>
              <li class="mb-0"><span class="text-primary h5 mr-2"><i class="uim uim-check-circle"></i></span>Create your own skin to match your brand</li>
            </ul>
            <a href="javascript:void(0)" class="mt-3 h6 text-primary">Find Out More <i class="mdi mdi-chevron-right"></i></a>
          </div>
        </div>

        <div class="col-lg-5 col-md-6 order-1 order-md-2">
          <img src="{{asset('/frontend/images/illustrator/app_development_SVG.svg')}}" alt="">
        </div>
      </div>
    </div>

    <div class="container mt-100 mt-60">
      <div class="row justify-content-center">
        <div class="col-12 text-center">
          <div class="section-title mb-4 pb-2">
            <h4 class="title mb-4">Satisfied  <span class="text-primary">Clients</span></h4>
            <p class="text-muted para-desc mx-auto mb-0">Start working with <span class="text-primary font-weight-bold">Landrick</span> that can provide everything you need to generate awareness, drive traffic, connect.</p>
          </div>
        </div>
      </div>

      <div class="row justify-content-center">
        <div class="col-lg-12 mt-4">
          <div id="customer-testi" class="owl-carousel owl-theme">
            <div class="media customer-testi m-2">
              <img src="{{asset('/frontend/images/client/01.jpg')}}" class="avatar avatar-small mr-3 rounded shadow" alt="">
              <div class="media-body content p-3 shadow rounded bg-white position-relative">
                <ul class="list-unstyled mb-0">
                  <li class="list-inline-item"><i class="mdi mdi-star text-warning"></i></li>
                  <li class="list-inline-item"><i class="mdi mdi-star text-warning"></i></li>
                  <li class="list-inline-item"><i class="mdi mdi-star text-warning"></i></li>
                  <li class="list-inline-item"><i class="mdi mdi-star text-warning"></i></li>
                  <li class="list-inline-item"><i class="mdi mdi-star text-warning"></i></li>
                </ul>
                <p class="text-muted mt-2">" It seems that only fragments of the original text remain in the Lorem Ipsum texts used today. "</p>
                <h6 class="text-primary">- Thomas Israel <small class="text-muted">C.E.O</small></h6>
              </div>
            </div>

            <div class="media customer-testi m-2">
              <img src="{{asset('/frontend/images/client/02.jpg')}}" class="avatar avatar-small mr-3 rounded shadow" alt="">
              <div class="media-body content p-3 shadow rounded bg-white position-relative">
                <ul class="list-unstyled mb-0">
                  <li class="list-inline-item"><i class="mdi mdi-star text-warning"></i></li>
                  <li class="list-inline-item"><i class="mdi mdi-star text-warning"></i></li>
                  <li class="list-inline-item"><i class="mdi mdi-star text-warning"></i></li>
                  <li class="list-inline-item"><i class="mdi mdi-star text-warning"></i></li>
                  <li class="list-inline-item"><i class="mdi mdi-star-half text-warning"></i></li>
                </ul>
                <p class="text-muted mt-2">" One disadvantage of Lorum Ipsum is that in Latin certain letters appear more frequently than others. "</p>
                <h6 class="text-primary">- Barbara McIntosh <small class="text-muted">M.D</small></h6>
              </div>
            </div>

            <div class="media customer-testi m-2">
              <img src="images/client/03.jpg" class="avatar avatar-small mr-3 rounded shadow" alt="">
              <div class="media-body content p-3 shadow rounded bg-white position-relative">
                <ul class="list-unstyled mb-0">
                  <li class="list-inline-item"><i class="mdi mdi-star text-warning"></i></li>
                  <li class="list-inline-item"><i class="mdi mdi-star text-warning"></i></li>
                  <li class="list-inline-item"><i class="mdi mdi-star text-warning"></i></li>
                  <li class="list-inline-item"><i class="mdi mdi-star text-warning"></i></li>
                  <li class="list-inline-item"><i class="mdi mdi-star text-warning"></i></li>
                </ul>
                <p class="text-muted mt-2">" The most well-known dummy text is the 'Lorem Ipsum', which is said to have originated in the 16th century. "</p>
                <h6 class="text-primary">- Carl Oliver <small class="text-muted">P.A</small></h6>
              </div>
            </div>

            <div class="media customer-testi m-2">
              <img src="{{asset('/frontend/images/client/04.jpg')}}" class="avatar avatar-small mr-3 rounded shadow" alt="">
              <div class="media-body content p-3 shadow rounded bg-white position-relative">
                <ul class="list-unstyled mb-0">
                  <li class="list-inline-item"><i class="mdi mdi-star text-warning"></i></li>
                  <li class="list-inline-item"><i class="mdi mdi-star text-warning"></i></li>
                  <li class="list-inline-item"><i class="mdi mdi-star text-warning"></i></li>
                  <li class="list-inline-item"><i class="mdi mdi-star text-warning"></i></li>
                  <li class="list-inline-item"><i class="mdi mdi-star text-warning"></i></li>
                </ul>
                <p class="text-muted mt-2">" According to most sources, Lorum Ipsum can be traced back to a text composed by Cicero. "</p>
                <h6 class="text-primary">- Christa Smith <small class="text-muted">Manager</small></h6>
              </div>
            </div>

            <div class="media customer-testi m-2">
              <img src="{{asset('/frontend/images/client/05.jpg')}}" class="avatar avatar-small mr-3 rounded shadow" alt="">
              <div class="media-body content p-3 shadow rounded bg-white position-relative">
                <ul class="list-unstyled mb-0">
                  <li class="list-inline-item"><i class="mdi mdi-star text-warning"></i></li>
                  <li class="list-inline-item"><i class="mdi mdi-star text-warning"></i></li>
                  <li class="list-inline-item"><i class="mdi mdi-star text-warning"></i></li>
                  <li class="list-inline-item"><i class="mdi mdi-star text-warning"></i></li>
                  <li class="list-inline-item"><i class="mdi mdi-star text-warning"></i></li>
                </ul>
                <p class="text-muted mt-2">" There is now an abundance of readable dummy texts. These are usually used when a text is required. "</p>
                <h6 class="text-primary">- Dean Tolle <small class="text-muted">Developer</small></h6>
              </div>
            </div>

            <div class="media customer-testi m-2">
              <img src="{{asset('/frontend/images/client/06.jpg')}}" class="avatar avatar-small mr-3 rounded shadow" alt="">
              <div class="media-body content p-3 shadow rounded bg-white position-relative">
                <ul class="list-unstyled mb-0">
                  <li class="list-inline-item"><i class="mdi mdi-star text-warning"></i></li>
                  <li class="list-inline-item"><i class="mdi mdi-star text-warning"></i></li>
                  <li class="list-inline-item"><i class="mdi mdi-star text-warning"></i></li>
                  <li class="list-inline-item"><i class="mdi mdi-star text-warning"></i></li>
                  <li class="list-inline-item"><i class="mdi mdi-star text-warning"></i></li>
                </ul>
                <p class="text-muted mt-2">" Thus, Lorem Ipsum has only limited suitability as a visual filler for German texts. "</p>
                <h6 class="text-primary">- Jill Webb <small class="text-muted">Designer</small></h6>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
    <div class="container pb-lg-4 mb-md-5 mb-4 mt-100 mt-60">
      <div class="row justify-content-center">
        <div class="col-12 text-center">
          <div class="section-title">
            <h4 class="title mb-4">See everything about your employee in one place.</h4>
            <p class="text-muted para-desc mx-auto mb-0">Start working with <span class="text-primary font-weight-bold">{{config('app.name')}}</span>. The application provides everything you need to keep tabs on your staff or colleagues, get update on recent happenings and much more.</p>

            <div class="mt-4">
              <a href="{{route('pricing')}}" class="btn btn-primary mt-2 mr-2">Get Started Now</a>
              <a href="{{route('faqs')}}" class="btn btn-outline-primary mt-2">Learn more</a>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>
  <div class="position-relative">
    <div class="shape overflow-hidden text-footer">
      <svg viewBox="0 0 2880 250" fill="none" xmlns="http://www.w3.org/2000/svg">
        <path d="M720 125L2160 0H2880V250H0V125H720Z" fill="currentColor"></path>
      </svg>
    </div>
  </div>
@endsection
