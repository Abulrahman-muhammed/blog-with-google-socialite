<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}" dir="{{ app()->getLocale() == 'ar' ? 'rtl' : 'ltr' }}">

@include('theme.partials.head')


<body>
    @include('theme.partials.header')


        @yield('content')

        @include('theme.partials.footer')

        @include('theme.partials.scripts')

</body>

</html>
