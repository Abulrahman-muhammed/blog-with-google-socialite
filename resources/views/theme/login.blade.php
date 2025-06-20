@extends('theme.master')
@section('title', 'Login')
@section('content')

    @include('theme.partials.hero', ['title' => 'Login'])

    <!-- ================ contact section start ================= -->
    <section class="section-margin--small section-margin">
        <div class="container">
            <div class="row">
                <div class="col-6 mx-auto">
                    <form method="POST" action="{{ route('login') }}" class="form-contact contact_form" id="contactForm">
                        @csrf
                        <div class="form-group">
                            <input class="form-control border" name="email" id="email" type="email"
                                :value="old('email')" placeholder="Enter email address">
                            <x-input-error :messages="$errors->get('email')" class="mt-2" />
                        </div>

                        <div class="form-group">
                            <input class="form-control border" name="password" id="name" type="password"
                                placeholder="Enter your password">
                            <x-input-error :messages="$errors->get('password')" class="mt-2" />
                        </div>

                        <div class="form-group text-center mt-3">
                            {{-- زر تسجيل الدخول بجوجل --}}
                            <a href="{{route('socialite.login')}}"
                                class="btn btn-outline-dark w-100 d-flex align-items-center justify-content-center mb-2"
                                style="gap: 10px;">
                                <img src="https://www.gstatic.com/firebasejs/ui/2.0.0/images/auth/google.svg" width="20"
                                    alt="Google Logo">
                                <span>Login with Google</span>
                            </a>


                            {{-- زر تسجيل الدخول العادي --}}
                            <button type="submit" class="btn btn-primary w-100 mb-3">
                                Login
                            </button>

                            {{-- رابط التسجيل --}}
                            <p class="mt-2 mb-0">
                                Don't have an account?
                                <a href="{{ route('register') }}">Sign Up Instead</a>
                            </p>
                        </div>

                    </form>
                </div>
            </div>
        </div>
    </section>
    <!-- ================ contact section end ================= -->
@endsection
