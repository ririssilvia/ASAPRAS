<!doctype html>
<html lang="en" data-bs-theme="light">

<meta name="csrf-token" content="{{ csrf_token() }}">


<!-- Mirrored from codervent.com/maxton/demo/vertical-menu/pages-starter-page.html by HTTrack Website Copier/3.x [XR&CO'2014], Tue, 23 Jul 2024 16:19:36 GMT -->

@include('components.styles')

<body>
    <x-header></x-header>
    @include('components.sidebar')

    <!--start main wrapper-->
    <main class="main-wrapper">

        @if (session('success'))
            <div class="alert alert-border-success alert-dismissible fade show">
                <div class="d-flex align-items-center">
                    <div class="font-35 text-success"><span class="material-icons-outlined fs-2">check_circle</span>
                    </div>
                    <div class="ms-3">
                        <h6 class="mb-0 text-success">Success Alerts</h6>
                        <div class="">{{ session('success') }}</div>
                    </div>
                </div>
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif

        @yield('main-content')

    </main>
    <!--end main wrapper-->

    <!--start overlay-->
    <div class="overlay btn-toggle">

    </div>
    <!--end overlay-->

    @include('components.footer')
    @include('components.switcher')
    @include('components.scripts')
</body>


<!-- Mirrored from codervent.com/maxton/demo/vertical-menu/pages-starter-page.html by HTTrack Website Copier/3.x [XR&CO'2014], Tue, 23 Jul 2024 16:19:36 GMT -->

</html>
