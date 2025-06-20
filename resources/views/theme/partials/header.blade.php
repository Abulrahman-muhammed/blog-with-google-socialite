@php
    $headercategories = App\Models\Category::all();
@endphp
<header class="header_area">
    <div class="main_menu">
        <nav class="navbar navbar-expand-lg navbar-light">
            <div class="container box_1620">
                <!-- Brand and toggle get grouped for better mobile display -->
                <a class="navbar-brand logo_h" href="{{ route('theme.index') }}">
                    <img src="{{ asset('assets') }}/img/logo.png" alt="">
                </a>
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent"
                    aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <!-- Collect the nav links, forms, and other content for toggling -->
                <div class="collapse navbar-collapse offset" id="navbarSupportedContent">
                    <ul class="nav navbar-nav menu_nav justify-content-center" style="{{ app()->getLocale() == 'ar' ? 'gap: 1rem; flex-direction: row-reverse;' : '' }}">
                        <li class="nav-item @yield('home-active')">
                            <a class="nav-link" href="{{ route('theme.index') }}"> {{ __('nav.home') }} </a>
                        </li>
                        <li class="nav-item submenu dropdown @yield('categories-active')">
                            <a href="#" class="nav-link dropdown-toggle" data-toggle="dropdown" role="button"
                                aria-haspopup="true" aria-expanded="false"> {{ __('nav.categories') }} </a>
                            @if (count($headercategories) > 0)
                                <ul class="dropdown-menu">
                                    {{-- Display Categories --}}
                                    @foreach ($headercategories as $category)
                                        <li class="nav-item">
                                            <a class="nav-link" href="{{ route('theme.category', $category->id) }}">
                                                {{ $category->name }}
                                            </a>
                                        </li>
                                    @endforeach
                                </ul>
                            @endif
                        </li>
                        <li class="nav-item @yield('contact-active')">
                            <a class="nav-link" href="{{ route('theme.contact') }}"> {{ __('nav.contact') }} </a>
                        </li>
                        {{-- <li class="nav-item submenu dropdown">
                            <a href="#" class="nav-link dropdown-toggle" data-toggle="dropdown" role="button"
                                aria-haspopup="true" aria-expanded="false">
                                🌍 {{ __('nav.language') }}
                            </a>
                            <ul class="dropdown-menu">
                                @foreach(LaravelLocalization::getSupportedLocales() as $localeCode => $properties)
                                    <li class="nav-item">
                                        <a class="nav-link" rel="alternate" hreflang="{{ $localeCode }}" href="{{ LaravelLocalization::getLocalizedURL($localeCode, null, [], true) }}">
                                            {{ $properties['native'] }}
                                        </a>
                                    </li>
                                @endforeach
                            </ul>
                        </li> --}}

                    </ul>

                    <!-- Add new blog -->
                    @if (Auth::check())
                        <a href="{{ route('blog.create') }}" class="btn btn-sm btn-primary mr-2"> {{ __('nav.addnew') }} </a>
                    @endif
                    <!-- End - Add new blog -->

                    <ul class="nav navbar-nav navbar-right navbar-social">
                        @if (Auth::check())
                            <li class="nav-item submenu dropdown">
                                <a href="#" class="nav-link dropdown-toggle" data-toggle="dropdown" role="button"
                                    aria-haspopup="true" aria-expanded="false">
                                    {{ auth()->user()->name }}
                                </a>
                                <ul class="dropdown-menu">
                                    <li class="nav-item">
                                        <a class="nav-link" href="{{ route('blog.myblogs') }}"> {{ __('nav.my_blogs') }} </a>
                                    </li>
                                    <li class="nav-item">
                                        <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                            @csrf
                                        </form>
                                        <a class="nav-link" href="#" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                                            {{ __('nav.logout') }}
                                        </a>
                                    </li>
                                </ul>
                            </li>
                        @else
                            <a href="{{ route('register') }}" class="btn btn-sm btn-warning">
                                {{ __('nav.register') }} / {{ __('nav.login') }}
                            </a>
                        @endif
                    </ul>
                </div>
            </div>
        </nav>
    </div>
</header>
