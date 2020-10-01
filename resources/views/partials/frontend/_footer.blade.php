<footer class="footer">
    <div class="container">
        <div class="row">
            <div class="col-lg-4 col-12 mb-0 mb-md-4 pb-0 pb-md-2">
                <a href="#" class="logo-footer">
                    <img src="images/logo-light.png" height="24" alt="">
                </a>
                <p class="mt-4">{{config('app.name')}} offers you the opportunity to remotely collaborate on tasks, monitor daily activities within your organization as they occur in real-time.</p>
                <ul class="list-unstyled social-icon social mb-0 mt-4">
                    <li class="list-inline-item"><a href="javascript:void(0)" class="rounded"><i data-feather="facebook" class="fea icon-sm fea-social"></i></a></li>
                    <li class="list-inline-item"><a href="javascript:void(0)" class="rounded"><i data-feather="instagram" class="fea icon-sm fea-social"></i></a></li>
                    <li class="list-inline-item"><a href="javascript:void(0)" class="rounded"><i data-feather="twitter" class="fea icon-sm fea-social"></i></a></li>
                    <li class="list-inline-item"><a href="javascript:void(0)" class="rounded"><i data-feather="linkedin" class="fea icon-sm fea-social"></i></a></li>
                </ul>
            </div>

            <div class="col-lg-2 col-md-4 col-12 mt-4 mt-sm-0 pt-2 pt-sm-0">
                <h4 class="text-light footer-head">Company</h4>
                <ul class="list-unstyled footer-list mt-4">
                    <li><a href="page-aboutus.html" class="text-foot"><i class="mdi mdi-chevron-right mr-1"></i> About us</a></li>
                    <li><a href="page-services.html" class="text-foot"><i class="mdi mdi-chevron-right mr-1"></i> Products</a></li>
                    <li><a href="page-pricing.html" class="text-foot"><i class="mdi mdi-chevron-right mr-1"></i> Pricing</a></li>
                    <li><a href="page-work-modern.html" class="text-foot"><i class="mdi mdi-chevron-right mr-1"></i> Support</a></li>
                    <li><a href="page-jobs.html" class="text-foot"><i class="mdi mdi-chevron-right mr-1"></i> FAQs</a></li>
                </ul>
            </div>

            <div class="col-lg-3 col-md-4 col-12 mt-4 mt-sm-0 pt-2 pt-sm-0">
                <h4 class="text-light footer-head">Usefull Links</h4>
                <ul class="list-unstyled footer-list mt-4">
                    <li><a href="page-terms.html" class="text-foot"><i class="mdi mdi-chevron-right mr-1"></i> Terms of Services</a></li>
                    <li><a href="page-privacy.html" class="text-foot"><i class="mdi mdi-chevron-right mr-1"></i> Privacy Policy</a></li>
                    <li><a href="documentation.html" class="text-foot"><i class="mdi mdi-chevron-right mr-1"></i> Documentation</a></li>
                    <li><a href="changelog.html" class="text-foot"><i class="mdi mdi-chevron-right mr-1"></i> Changelog</a></li>
                    <li><a href="components.html" class="text-foot"><i class="mdi mdi-chevron-right mr-1"></i> Components</a></li>
                </ul>
            </div>

            <div class="col-lg-3 col-md-4 col-12 mt-4 mt-sm-0 pt-2 pt-sm-0">
                <h4 class="text-light footer-head">Start today</h4>
                <p class="mt-4">Get your team on board and start collaborating.</p>
                <form>
                    <div class="row">
                        <div class="col-lg-12">
                            <a href="{{route('signup')}}" class="btn btn-soft-primary btn-block">Signup</a>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</footer>
<footer class="footer footer-bar">
    <div class="container text-center">
        <div class="row align-items-center">
            <div class="col-sm-6">
                <div class="text-sm-left">
                    <p class="mb-0">© {{date('Y')}} All Rights Reserved <a href="https://telecom.connexxiongroup.com/" target="_blank" class="text-reset">Connexxiong Telecom</a>.</p>
                </div>
            </div>
        </div>
    </div>
</footer>

<a href="#" class="btn btn-icon btn-soft-primary back-to-top"><i data-feather="arrow-up" class="icons"></i></a>

<script src="{{asset('/frontend/js/jquery-3.5.1.min.js')}}"></script>
<script src="{{asset('/frontend/js/bootstrap.bundle.min.js')}}"></script>
<script src="{{asset('/frontend/js/jquery.easing.min.js')}}"></script>
<script src="{{asset('/frontend/js/scrollspy.min.js')}}"></script>
<script src="{{asset('/frontend/js/owl.carousel.min.js')}}"></script>
<script src="{{asset('/frontend/js/owl.init.js')}}"></script>
<script src="{{asset('/frontend/js/feather.min.js')}}"></script>
<script type="text/javascript" src="{{asset('/assets/js/cus/axios.min.js')}}"></script>
<script type="text/javascript" src="{{asset('/assets/js/cus/notify.js')}}"></script>
@livewireScripts
@yield('extra-scripts')
<script src="{{asset('/frontend/js/app.js')}}"></script>
</body>
</html>
