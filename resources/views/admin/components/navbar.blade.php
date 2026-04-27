<div class="main-header">
    <nav class="navbar navbar-expand-lg navbar-light bg-white border-bottom px-3">
        <div class="container-fluid">

            <!-- Right Menu -->
            <ul class="navbar-nav ms-auto align-items-center">

                <!-- Search (Mobile Only) -->
                <li class="nav-item d-lg-none me-2">
                    <form class="d-flex">
                        <input type="text" class="form-control form-control-sm" placeholder="Search...">
                    </form>
                </li>

                <!-- User Dropdown -->
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle d-flex align-items-center" href="#" role="button"
                        data-bs-toggle="dropdown">

                        <img src="assets/img/profile.jpg" class="rounded-circle" width="35" height="35"
                            style="object-fit: cover;">

                        <span class="ms-2 d-none d-sm-inline">
                            Hi, <strong>{{ auth()->user()->name }}</strong>
                        </span>
                    </a>

                    <!-- Dropdown Menu -->
                    <ul class="dropdown-menu dropdown-menu-end">
                        <li><span class="dropdown-item-text text-muted small">{{ ucfirst(str_replace('_', ' ', auth()->user()->role)) }}</span></li>
                        <li><hr class="dropdown-divider"></li>
                        <li>
                            <form action="{{ route('logout') }}" method="POST">
                                @csrf
                                <button type="submit" class="dropdown-item text-danger">Logout</button>
                            </form>
                        </li>
                    </ul>
                </li>

            </ul>

        </div>
    </nav>
</div>