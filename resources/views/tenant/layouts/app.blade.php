<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>@yield('title') - {{ tenant('id') }}</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        .sidebar {
            min-height: 100vh;
            background: #343a40;
            padding-top: 20px;
        }
        .sidebar .nav-link {
            color: #fff;
            padding: 15px 20px;
            margin: 5px 0;
        }
        .sidebar .nav-link:hover {
            background: #495057;
        }
        .sidebar .nav-link.active {
            background: #495057;
        }
        .sidebar .nav-link i {
            margin-right: 10px;
        }
        .main-content {
            min-height: 100vh;
            padding: 20px;
            margin-left: 250px;
        }
        .top-navbar {
            margin-left: 250px;
            background: #343a40;
        }
    </style>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
</head>
<body>
    <!-- Sidebar -->
    <div class="sidebar position-fixed" style="width: 250px;">
        <div class="px-3 mb-4">
            <h4 class="text-white">{{ tenant('id') }}</h4>
        </div>
        <ul class="nav flex-column">
            <li class="nav-item">
                <a class="nav-link {{ request()->routeIs('tenant.admin.dashboard') ? 'active' : '' }}" 
                   href="{{ route('tenant.admin.dashboard', ['tenant' => tenant('id')]) }}">
                    <i class="fas fa-tachometer-alt"></i> Dashboard
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link {{ request()->routeIs('tenant.students.*') ? 'active' : '' }}" 
                   href="{{ route('tenant.students.index', ['tenant' => tenant('id')]) }}">
                    <i class="fas fa-users"></i> Students
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link {{ request()->routeIs('tenant.staff.*') ? 'active' : '' }}" 
                   href="{{ route('tenant.staff.index', ['tenant' => tenant('id')]) }}">
                    <i class="fas fa-chalkboard-teacher"></i> Staff
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link {{ request()->routeIs('tenant.courses.*') ? 'active' : '' }}" 
                   href="{{ route('tenant.courses.index', ['tenant' => tenant('id')]) }}">
                    <i class="fas fa-book"></i> Courses
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link {{ request()->routeIs('tenant.requirements.*') ? 'active' : '' }}" 
                   href="{{ route('tenant.requirements.index', ['tenant' => tenant('id')]) }}">
                    <i class="fas fa-clipboard-list"></i> Requirements
                </a>
            </li>
            <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle {{ request()->routeIs('tenant.reports.*') ? 'active' : '' }}" 
                   href="#" id="reportsDropdown" role="button" data-bs-toggle="dropdown">
                    <i class="fas fa-chart-bar"></i> Reports
                </a>
                <ul class="dropdown-menu dropdown-menu-dark">
                    <li>
                        <a class="dropdown-item" href="{{ route('tenant.reports.students', ['tenant' => tenant('id')]) }}">
                            Student Reports
                        </a>
                    </li>
                    <li>
                        <a class="dropdown-item" href="{{ route('tenant.reports.staff', ['tenant' => tenant('id')]) }}">
                            Staff Reports
                        </a>
                    </li>
                    <li>
                        <a class="dropdown-item" href="{{ route('tenant.reports.courses', ['tenant' => tenant('id')]) }}">
                            Course Reports
                        </a>
                    </li>
                    <li>
                        <a class="dropdown-item" href="{{ route('tenant.reports.requirements', ['tenant' => tenant('id')]) }}">
                            Requirements Reports
                        </a>
                    </li>
                </ul>
            </li>
        </ul>
    </div>

    <!-- Top Navbar -->
    <nav class="navbar navbar-expand-lg navbar-dark top-navbar">
        <div class="container-fluid">
            <div class="ms-auto">
                <form action="{{ route('logout') }}" method="POST" class="d-flex">
                    @csrf
                    <button class="btn btn-outline-light" type="submit">
                        <i class="fas fa-sign-out-alt"></i> Logout
                    </button>
                </form>
            </div>
        </div>
    </nav>

    <!-- Main Content -->
    <div class="main-content">
        @yield('content')
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    @stack('scripts')
</body>
</html>