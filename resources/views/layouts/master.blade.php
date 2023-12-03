<!doctype html>
<html lang="en">
@include('layouts.head')
<body data-sidebar="dark">
<!-- Begin page -->
<div id="layout-wrapper">
        @include('layouts.header')
        @include('layouts.menu')
    <!-- ============================================================== -->
    <!-- Start right Content here -->
    <!-- ============================================================== -->
    <div class="main-content">
        @yield('content')

        @include('layouts.footer')
    </div>

</div>
<div id="loader">
    <img class="loader-gif" src="{{asset('assets/images/loader.gif')}}" alt="Loading...">
</div>
@include('layouts.script')
</body>
</html>
