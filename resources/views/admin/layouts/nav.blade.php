<nav class="navbar navbar-expand-lg border-bottom sticky shadow-sm">
    <div class="container-fluid px-4">
        <!-- Logo & Title -->
        <a class="navbar-brand d-flex align-items-center gap-2 text-dark font-weight-bold" href="{{ route('home') }}">
            <svg class="text-warning" style="width: 32px; height: 32px;" fill="currentColor" viewBox="0 0 24 24">
                <path
                    d="M12 2a.75.75 0 0 1 .75.75v1.5a.75.75 0 0 1-1.5 0v-1.5A.75.75 0 0 1 12 2zm0 3.5c.83 0 1.5.67 1.5 1.5s-.67 1.5-1.5 1.5-1.5-.67-1.5-1.5.67-1.5 1.5-1.5zm1.2 4.14A3.48 3.48 0 0 0 12 9a3.48 3.48 0 0 0-1.2.64L12 14l1.2-4.36zM12 15c-1.66 0-3-1.34-3-3l1.35-4.86c.15-.55.65-.94 1.23-.94s1.08.39 1.23.94L14.35 12c0 1.66-1.34 3-3 3zm-4.5 3h9l-1-2.5h-7l-1 2.5zm-2.5 3h14l-1-2.5h-12l-1 2.5z" />
            </svg>
            <div class="d-flex flex-column lh-1">
                <span class="fw-bold text-dark fs-5">Pagoda</span>
                <small class="text-muted fw-semibold" style="font-size: 10px;">Digital Directory</small>
            </div>
        </a>

        <!-- User Profile Dropdown -->
        <div class="dropdown me-3">
            <button class="btn p-0 border-0 shadow-none d-flex align-items-center justify-content-center" type="button"
                id="userDropdown" data-bs-toggle="dropdown" aria-expanded="false"
                style="background: transparent; border: none !important; outline: none !important;">

                <!-- User Avatar Circle -->
                <div class="rounded-circle text-white d-flex align-items-center justify-content-center fw-bold shadow-sm"
                    style="width: 36px; height: 36px; font-size: 15px; background-color: #fd7e14 !important; cursor: pointer;">
                    {{ strtoupper(substr(Auth::user()->name ?? 'K', 0, 1)) }}
                </div>

            </button>

            <ul class="dropdown-menu dropdown-menu-end user-dropdown-menu" aria-labelledby="userDropdown">

                <!-- Header Info Inside Dropdown -->
                <li class="px-3 py-2 border-bottom mb-1">
                    <div class="fw-bold text-dark" style="font-size: 0.85rem;">
                        {{ Auth::user()->name ?? 'Khaing Thazin' }}</div>
                    <div class="text-muted" style="font-size: 0.75rem;">{{ Auth::user()->email ?? 'admin@gmail.com' }}
                    </div>
                </li>

                <!-- Change Password -->
                <li>
                    <a class="dropdown-menu-item user-dropdown-item" href="{{ route('profile.edit') ?? '#' }}">
                        <i class="fas fa-key me-2.5 text-warning" style="color: #fd7e14 !important; width: 18px;"></i>
                        <span>Change Password</span>
                    </a>
                </li>

                <!-- Divider -->
                <li>
                    <hr class="dropdown-divider my-1">
                </li>

                <!-- Log Out -->
                <li>
                    <form method="POST" action="{{ route('logout') }}" id="logout-form">
                        @csrf
                        <a class="dropdown-menu-item user-dropdown-item logout-item text-danger"
                            href="{{ route('logout') }}"
                            onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                            <i class="fas fa-sign-out-alt me-2.5 text-danger" style="width: 18px;"></i>
                            <span>Log Out</span>
                        </a>
                    </form>
                </li>

            </ul>
        </div>
    </div>
</nav>
