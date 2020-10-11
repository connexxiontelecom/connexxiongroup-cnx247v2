    <header id="topnav" class="defaultscroll sticky">
        <div class="container">
            <div>
                <a class="logo" href="{{route('home')}}">
                    <img src="{{asset('/frontend/images/logo.png')}}" height="52" width="82" alt="{{config('app.name')}}">
                </a>
            </div>
            @if (!Auth::check())
                <div class="buy-button">
                    <a href="{{route('pricing')}}" class="btn btn-primary">Sign up</a>
                    <a href="{{route('signin')}}" class="btn btn-light">Sign in</a>
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
                <ul class="navigation-menu">
                    <li><a href="index.html">Product</a></li>
                    <li><a href="{{route('pricing')}}">Pricing</a></li>
                    <li><a href="{{route('support')}}">Support</a></li>
                    <li><a href="{{route('faqs')}}">FAQs</a></li>
                </ul>
                @if (!Auth::check())
                    <div class="buy-menu-btn d-none">
                        <a href="{{route('pricing')}}"  class="btn btn-primary">Sign up</a>
                    </div>
                @endif
            </div>
        </div>
    </header>
