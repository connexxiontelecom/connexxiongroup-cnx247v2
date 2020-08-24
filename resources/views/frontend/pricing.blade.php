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
            <section class="section">
                <div class="container mt-100 mt-60">
                    <div class="row justify-content-center">
                        <div class="col-12 text-center">
                            <div class="section-title mb-4 pb-2">
                                <h4 class="title mb-4">Our Pricing</h4>
                                <p class="text-muted para-desc mb-0 mx-auto">We chose a pricing approach that is well-suited for companies or organizations of various sizes. Whatever may be your budget, <span class="text-primary font-weight-bold">{{config('app.name')}}</span> offers flexible pricing plans that will get your business up and running while you devote your time to other things.</p>
                            </div>
                        </div>
                    </div>

                    <div class="row align-items-center">
                        <div class="col-12 mt-4 pt-2">
                            <div class="text-center">
                                <ul class="nav nav-pills rounded-pill justify-content-center d-inline-block border py-1 px-2" id="pills-tab" role="tablist">
                                    <li class="nav-item d-inline-block">
                                        <a class="nav-link px-3 rounded-pill active monthly" id="Monthly" data-toggle="pill" href="#Month" role="tab" aria-controls="Month" aria-selected="true">Monthly</a>
                                    </li>
                                    <li class="nav-item d-inline-block">
                                        <a class="nav-link px-3 rounded-pill yearly" id="Yearly" data-toggle="pill" href="#Year" role="tab" aria-controls="Year" aria-selected="false">Yearly <span class="badge badge-pill badge-success">15% Off </span></a>
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
                                                                <h2 class="title text-uppercase mb-4">{{$plan->planName->name}}</h2>
                                                                <div class="d-flex mb-4">
                                                                    <span class="h5 mb-0 mt-0">{{$plan->currency->symbol}}</span>
                                                                    <span class="price h5 mb-0">{{number_format($plan->price,2)}}</span>
                                                                    <span class="h5 align-self-end mb-1">/mo</span>
                                                                </div>

                                                                <p class="text-center text-muted">
                                                                    {{$plan->description}}
                                                                </p>
                                                                <a href="{{route('create-site', ['timestamp'=>sha1(time()), 'plan'=>$plan->slug])}}" class="btn btn-primary mt-4">Buy Now</a>
                                                            </div>
                                                        </div>
                                                    </div>
                                                @endif
                                            @endforeach
                                        @else
                                            <p class="text-center">There're no plans </p>
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
                                                            <h2 class="title text-uppercase mb-4">{{$plan->planName->name}}</h2>
                                                            <div class="d-flex mb-4">
                                                                <span class="h5 mb-0 mt-0">{{$plan->currency->symbol}}</span>
                                                                <span class="price h5 mb-0">{{number_format($plan->price,2)}}</span>
                                                                <span class="h5 align-self-end mb-1">/mo</span>
                                                            </div>

                                                            <p class="text-center text-muted">
                                                                {{$plan->description}}
                                                            </p>
                                                            <a href="{{route('create-site', ['timestamp'=>sha1(time()), 'plan'=>$plan->slug])}}" class="btn btn-primary mt-4">Buy Now</a>
                                                        </div>
                                                    </div>
                                                </div>
                                            @endif
                                        @endforeach
                                    @else
                                        <p class="text-center">There're no plans </p>
                                    @endif
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="container mt-100 mt-60">
                    <div class="row justify-content-center">
                        <div class="col-12 text-center">
                            <div class="section-title mb-4 pb-2">
                                <h4 class="title mb-4">Client Reviews</h4>
                                <p class="text-muted para-desc mx-auto mb-0">In the words of an anonymous, "Great products advertises itself; but the recommendation of a satisfied client shouldn't be taken lightly." Share in the experience of our clients who have used our product and what they have to say.</p>
                            </div>
                        </div>
                    </div>

                    <div class="row justify-content-center">
                        <div class="col-lg-12 mt-4">
                            <div id="customer-testi" class="owl-carousel owl-theme">
                                <div class="media customer-testi m-2">
                                    <img src="images/client/01.jpg" class="avatar avatar-small mr-3 rounded shadow" alt="">
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
                                    <img src="images/client/02.jpg" class="avatar avatar-small mr-3 rounded shadow" alt="">
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
                                    <img src="images/client/04.jpg" class="avatar avatar-small mr-3 rounded shadow" alt="">
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
                                    <img src="images/client/05.jpg" class="avatar avatar-small mr-3 rounded shadow" alt="">
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
                                    <img src="images/client/06.jpg" class="avatar avatar-small mr-3 rounded shadow" alt="">
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
            </section>

            <!-- FAQ n Contact Start -->
            <section class="section bg-light">
                <div class="container">
                    <div class="row">
                        <div class="col-md-6 col-12">
                            <div class="media">
                                <i data-feather="help-circle" class="fea icon-ex-md text-primary mr-2 mt-1"></i>
                                <div class="media-body">
                                    <h5 class="mt-0">How our <span class="text-primary">Landrick</span> work ?</h5>
                                    <p class="answer text-muted mb-0">Due to its widespread use as filler text for layouts, non-readability is of great importance: human perception is tuned to recognize certain patterns and repetitions in texts.</p>
                                </div>
                            </div>
                        </div><!--end col-->

                        <div class="col-md-6 col-12 mt-4 mt-sm-0 pt-2 pt-sm-0">
                            <div class="media">
                                <i data-feather="help-circle" class="fea icon-ex-md text-primary mr-2 mt-1"></i>
                                <div class="media-body">
                                    <h5 class="mt-0"> What is the main process open account ?</h5>
                                    <p class="answer text-muted mb-0">If the distribution of letters and 'words' is random, the reader will not be distracted from making a neutral judgement on the visual impact</p>
                                </div>
                            </div>
                        </div><!--end col-->

                        <div class="col-md-6 col-12 mt-4 pt-2">
                            <div class="media">
                                <i data-feather="help-circle" class="fea icon-ex-md text-primary mr-2 mt-1"></i>
                                <div class="media-body">
                                    <h5 class="mt-0"> How to make unlimited data entry ?</h5>
                                    <p class="answer text-muted mb-0">Furthermore, it is advantageous when the dummy text is relatively realistic so that the layout impression of the final publication is not compromised.</p>
                                </div>
                            </div>
                        </div><!--end col-->

                        <div class="col-md-6 col-12 mt-4 pt-2">
                            <div class="media">
                                <i data-feather="help-circle" class="fea icon-ex-md text-primary mr-2 mt-1"></i>
                                <div class="media-body">
                                    <h5 class="mt-0"> Is <span class="text-primary">Landrick</span> safer to use with my account ?</h5>
                                    <p class="answer text-muted mb-0">The most well-known dummy text is the 'Lorem Ipsum', which is said to have originated in the 16th century. Lorem Ipsum is composed in a pseudo-Latin language which more or less corresponds to 'proper' Latin.</p>
                                </div>
                            </div>
                        </div><!--end col-->
                    </div><!--end row-->

                    <div class="row mt-md-5 pt-md-3 mt-4 pt-2 mt-sm-0 pt-sm-0 justify-content-center">
                        <div class="col-12 text-center">
                            <div class="section-title">
                                <h4 class="title mb-4">Have Question ? Get in touch!</h4>
                                <p class="text-muted para-desc mx-auto">Start working with <span class="text-primary font-weight-bold">Landrick</span> that can provide everything you need to generate awareness, drive traffic, connect.</p>
                                <div class="mt-4 pt-2">
                                    <a href="page-contact-two.html" class="btn btn-primary">Contact us <i class="mdi mdi-arrow-right"></i></a>
                                </div>
                            </div>
                        </div><!--end col-->
                    </div><!--end row-->
                </div><!--end container-->
            </section><!--end section-->
            <!-- FAQ n Contact End -->

@endsection
