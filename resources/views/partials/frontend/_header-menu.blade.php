    <header id="topnav" class="defaultscroll sticky">
        <div class="container">
            <div>
                <a class="logo" href="{{route('home')}}">
                    <img src="{{asset('/frontend/images/logo.png')}}" height="52" width="100" alt="{{config('app.name')}}">
                </a>
            </div>
            @if (!Auth::check())
                <div class="buy-button">
{{--                    <a href="{{route('pricing')}}" class="btn btn-primary">Sign up</a>--}}
                    <a href="{{route('signin')}}" class="btn btn-primary">Sign In</a>
                </div>
            @endif
            @if (Auth::check())
                <div class="buy-button">
                    <a href="{{route('my-profile')}}" class="btn btn-primary">My Account</a>
                </div>
            @endif
            <div class="menu-extras">
                <div class="menu-item">
                    <a class="navbar-toggle">
                        <div class="lines">
                            <span></span>
                            <span></span>
                            <span></span>
                        </div>
                    </a>
                </div>
            </div>

            <div id="navigation">
                <ul class="navigation-menu nav-right nav-light">
                    <li class="has-submenu">
											<a href="javascript:void(0)">Product</a><span class="menu-arrow"></span>
											<ul class="submenu">
												<li><a href="javascript:void(0)">Human Resource</a></li>
												<li><a href="javascript:void(0)">CRM</a></li>
												<li><a href="javascript:void(0)">Accounting</a></li>
												<li><a href="javascript:void(0)">Procurement <span class="badge badge-success rounded">New</span></a></li>
												<li><a href="javascript:void(0)">Logistics</a></li>
											</ul>
										</li>
                    <li><a href="{{route('pricing')}}">Pricing</a></li>
                    <li><a href="{{route('support')}}">Support</a></li>
                    <li><a href="{{route('faqs')}}">FAQs</a></li>
                </ul>
                @if (!Auth::check())
                    <div class="buy-menu-btn d-none">
                        <a href="{{route('pricing')}}"  class="btn btn-primary">Sign up</a>
                        <a href="{{route('signin')}}" class="btn btn-light">Sign in</a>
                    </div>
                @endif
            </div>
        </div>
    </header>
