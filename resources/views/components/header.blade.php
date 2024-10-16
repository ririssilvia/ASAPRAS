<!--start header-->
<header class="top-header">
    <nav class="navbar navbar-expand align-items-center gap-4">
        <div class="btn-toggle">
            <a href="javascript:;"><i class="material-icons-outlined">menu</i></a>
        </div>
        <div class="search-bar flex-grow-1">
            <div class="position-relative">
                <input class="form-control rounded-5 px-5 search-control d-lg-block d-none" type="text"
                    placeholder="Search">
                <span
                    class="material-icons-outlined position-absolute d-lg-block d-none ms-3 translate-middle-y start-0 top-50">search</span>
                <span
                    class="material-icons-outlined position-absolute me-3 translate-middle-y end-0 top-50 search-close">close</span>
                <div class="search-popup p-3">
                    <div class="card rounded-4 overflow-hidden">
                        <div class="card-header d-lg-none">
                            <div class="position-relative">
                                <input class="form-control rounded-5 px-5 mobile-search-control" type="text"
                                    placeholder="Search">
                                <span
                                    class="material-icons-outlined position-absolute ms-3 translate-middle-y start-0 top-50">search</span>
                                <span
                                    class="material-icons-outlined position-absolute me-3 translate-middle-y end-0 top-50 mobile-search-close">close</span>
                            </div>
                        </div>
                        <div class="card-body search-content">
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <ul class="navbar-nav gap-1 nav-right-links align-items-center">
            <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle dropdown-toggle-nocaret position-relative"
                    data-bs-auto-close="outside" data-bs-toggle="dropdown" href="javascript:;"><i
                        class="material-icons-outlined">notifications</i>
                    <span class="badge-notify">{{ $notifications->count() }}</span>
                </a>
                <div class="dropdown-menu dropdown-notify dropdown-menu-end shadow">
                    <div class="px-3 py-1 d-flex align-items-center justify-content-between border-bottom">
                        <h5 class="notiy-title mb-0">Notifications</h5>
                    </div>
                    <div class="notify-list" id="notify-list"></div>
                    <div class="px-3 py-1 d-flex align-items-center justify-content-center border-top">
                        <a href="{{ $readAll() }}">Read all</a>
                    </div>
                </div>
            </li>
            <li class="nav-item d-md-flex d-none">
            </li>
            <li class="nav-item dropdown">
                <a href="javascrpt:;" class="dropdown-toggle dropdown-toggle-nocaret" data-bs-toggle="dropdown">
                    <img src="{{ url('assets/images/avatars/11.png') }}" class="rounded-circle p-1 border"
                        width="45" height="45" alt="">
                </a>
                <div class="dropdown-menu dropdown-user dropdown-menu-end shadow">
                    @auth
                        <a class="dropdown-item  gap-2 py-2" href="javascript:;">
                            <div class="text-center">
                                <img src="{{ url('assets/images/avatars/11.png') }}" class="rounded-circle p-1 shadow mb-3"
                                    width="90" height="90" alt="">
                                <h5 class="user-name mb-0 fw-bold">Hello, {{ $user->name }}</h5>
                            </div>
                        </a>
                        <hr class="dropdown-divider">
                        <form action="{{ route('logout') }}" method="POST">
                            @csrf
                            <button type="submit" class="dropdown-item d-flex align-items-center gap-2 py-2"
                                href="javascript:;"><i class="material-icons-outlined">power_settings_new</i>Logout</button>
                        </form>
                    @else
                        <a class="dropdown-item d-flex align-items-center gap-2 py-2" href="{{ route('login') }}"><i
                                class="material-icons-outlined">power_settings_new</i>Login</a>
                    @endauth
                </div>
            </li>
        </ul>

    </nav>
</header>
<!--end top header-->

@push('scripts')
    <script>
        $(window).on('load', function() {
            const notifications = @json($notifications);
            notifications.forEach(notification => {
                $(`#notify-list`).append(`
                    <div>
                        <a class="dropdown-item border-bottom py-2" href="javascript:;">
                            <div class="d-flex align-items-center gap-3">
                                <div class="user-wrapper bg-danger text-danger bg-opacity-10">
                                    <i class="material-icons-outlined fs-5">error_outline</i>
                                </div>
                                <div class="">
                                    <h5 class="notify-title">${notification.title}</h5>
                                    <p class="mb-0 notify-desc">${notification.description}</p>
                                    <p class="mb-0 notify-time">${timeSince(notification.created_at)}</p>
                                </div>
                                <div class="notify-close position-absolute end-0 me-3">
                                    <i class="material-icons-outlined fs-6">close</i>
                                </div>
                            </div>
                        </a>
                    </div>
                `);
            });
        });
    </script>
@endpush
