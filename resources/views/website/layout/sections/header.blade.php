<!-- Start Header news -->
<header class="bg-light">
    <!-- Navbar  Top-->
    <div class="topbar d-none d-sm-block">
        <div class="container ">
            <div class="row">
                <div class="col-sm-6 col-md-8">
                    <div class="topbar-left topbar-right d-flex">

                        <ul class="topbar-sosmed p-0">
                            <li>
                                <a href="{{ setting('social.facebook') }}" target="_blank"><i class="fa fa-facebook"></i></a>
                            </li>
                            <li>
                                <a href="{{ setting('social.twitter') }}" target="_blank"><i class="fa fa-twitter"></i></a>
                            </li>
                            <li>
                                <a href="{{ setting('social.telegram') }}" target="_blank"><i class="fa fa-telegram"></i></a>
                            </li>
                        </ul>
                        <div class="topbar-text">
{{--                            Friday, May 19, 2023--}}
                            {{ \Carbon\Carbon::parse(\Illuminate\Support\Facades\Date::today())->locale(app()->getLocale())->isoFormat('dddd, D MMMM YYYY') }}
                        </div>
                    </div>
                </div>
                <div class="col-sm-6 col-md-4">
                    <div class="list-unstyled topbar-right d-flex align-items-center justify-content-end">

                        <div class="topbar_language">
                            <select id="languageSelector">
                                @foreach(LaravelLocalization::getSupportedLocales() as $localeCode => $properties)
                                    <option value="{{ LaravelLocalization::getLocalizedURL($localeCode, null, [], true) }}"
                                            @if ($localeCode === LaravelLocalization::getCurrentLocale()) selected @endif>
                                        {{ $properties['native'] }}
                                    </option>
                                @endforeach
                            </select>

                        </div>

                        <ul class="topbar-link">
                           @auth('customer')
                                <li><a href="{{ route('logout') }}">{{__('website.logout')}}</a></li>
                           @else
                                <li><a href="{{ route('login') }}">{{__('website.login')}}</a></li>
                                <li><a href="{{ route('register') }}">{{__('website.register')}}</a></li>
                           @endauth
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- End Navbar Top  -->


    <!-- Navbar  -->
    <!-- Navbar menu  -->
    <div class="navigation-wrap navigation-shadow bg-white">
        <nav class="navbar navbar-hover navbar-expand-lg navbar-soft">
            <div class="container">
                <div class="offcanvas-header">
                    <div data-toggle="modal" data-target="#modal_aside_right" class="btn-md">
                        <span class="navbar-toggler-icon"></span>
                    </div>
                </div>
                <figure class="mb-0 mx-auto">
                    <a href="{{ route('home') }}">
                        <img src="{{ asset('website_assets/images/logo1.png') }}" alt="" class="img-fluid logo">
                    </a>
                </figure>

                <div class="collapse navbar-collapse justify-content-between" id="main_nav99">
                    <ul class="navbar-nav ml-auto ">
                        <li class="nav-item @if(Route::is('home')) active @endif">
                            <a class="nav-link" style="color: inherit" href="{{ route('home') }}">{{__('website.home')}}</a>
                        </li>


                        @foreach($nav_categories as $category)
                            <li class="nav-item " >
                                <a class="nav-link" style="color: inherit" href="{{ route('home') }}">{{$category->name}}</a>
                            </li>
                        @endforeach


                        <li class="nav-item dropdown">
                            <a class="nav-link" href="#">{{__('website.about')}} </a>
                        </li>
                        <li class="nav-item"><a class="nav-link" href="#"> {{__('website.contact')}} </a></li>
                    </ul>


                    <!-- Search bar.// -->
                    <ul class="navbar-nav ">
                        <li class="nav-item search hidden-xs hidden-sm "> <a class="nav-link" href="#">
                                <i class="fa fa-search"></i>
                            </a>
                        </li>
                    </ul>

                    <!-- Search content bar.// -->
                    <div class="top-search navigation-shadow">
                        <div class="container">
                            <div class="input-group ">
                                <form action="#">

                                    <div class="row no-gutters mt-3">
                                        <div class="col">
                                            <input class="form-control border-secondary border-right-0 rounded-0"
                                                   type="search" value="" placeholder="{{__('website.search')}}"
                                                   id="example-search-input4">
                                        </div>
                                        <div class="col-auto">
                                            <a class="btn btn-outline-secondary border-left-0 rounded-0 rounded-right"
                                               href="/search-result.html">
                                                <i class="fa fa-search"></i>
                                            </a>
                                        </div>
                                    </div>

                                </form>
                            </div>
                        </div>
                    </div>
                    <!-- Search content bar.// -->
                </div> <!-- navbar-collapse.// -->
            </div>
        </nav>
    </div>
    <!-- End Navbar menu  -->


    <!-- Navbar sidebar menu  -->
    <div id="modal_aside_right" class="modal fixed-left fade" tabindex="-1" role="dialog">
        <div class="modal-dialog modal-dialog-aside" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <div class="widget__form-search-bar  ">
                        <div class="row no-gutters">
                            <div class="col">
                                <input class="form-control border-secondary border-right-0 rounded-0" value=""
                                       placeholder="{{__('website.search')}}">
                            </div>
                            <div class="col-auto">
                                <button class="btn btn-outline-secondary border-left-0 rounded-0 rounded-right">
                                    <i class="fa fa-search"></i>
                                </button>
                            </div>
                        </div>
                    </div>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <nav class="list-group list-group-flush">
                        <ul class="navbar-nav ">
                            <li class="nav-item">
                                <a class="nav-link active text-dark" href="index.html"> {{__('website.home')}}</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link text-dark" href="about-us.html"> {{__('website.about')}} </a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link text-dark" href="blog.html">{{__('website.blog')}} </a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link active dropdown-toggle  text-dark" href="#"
                                   data-toggle="dropdown">{{__('website.pages')}} </a>
                                <ul class="dropdown-menu dropdown-menu-left">
                                    <li><a class="dropdown-item" href="blog_details.html">Blog details</a></li>
                                    <li><a class="dropdown-item" href="404.html"> 404 Error</a></li>

                                </ul>
                            </li>
                            <li class="nav-item"><a class="nav-link  text-dark" href="contact.html"> {{__('website.contact')}} </a>
                            </li>
                        </ul>

                    </nav>
                </div>
                <div class="modal-footer">
                    <p>© 2020 <a href="https://websolutionus.com/.com">WebSolutionUS</a>
                        -
                        Premium template news, blog & magazine &amp;
                        magazine theme by <a href="https://websolutionus.com/.com">websolutionus.com</a></p>
                </div>
            </div>
        </div>
    </div>
</header>
<!-- End Header news -->
