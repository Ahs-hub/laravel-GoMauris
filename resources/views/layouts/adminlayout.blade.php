<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>RentTour Admin Panel</title>

    {{-- CSS Libraries --}}
    <link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.0/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/boxicons/2.1.4/css/boxicons.min.css" rel="stylesheet">

    {{-- Custom Styles (optional to extract into separate file) --}}
    <style>
        :root {
            --primary-color: #2c3e50;
            --secondary-color: #3498db;
            --accent-color: #e74c3c;
            --success-color: #27ae60;
            --warning-color: #f39c12;
            --sidebar-width: 250px;
        }

        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background-color: #f8f9fa;
        }

        .sidebar {
            position: fixed;
            top: 0;
            left: 0;
            height: 100vh;
            width: var(--sidebar-width);
            background: linear-gradient(135deg, var(--primary-color), #34495e);
            color: white;
            z-index: 1000;
        }

        .sidebar-header {
            padding: 1.5rem 1rem;
            border-bottom: 1px solid rgba(255,255,255,0.1);
        }

        .sidebar-header h4 {
            margin: 0;
            font-weight: 600;
            color: #ecf0f1;
        }

        .sidebar-menu {
            list-style: none;
            padding: 0;
            margin: 0;
        }

        .sidebar-menu li {
            border-bottom: 1px solid rgba(255,255,255,0.05);
        }

        .sidebar-menu a {
            display: flex;
            align-items: center;
            padding: 1rem 1.5rem;
            color: #bdc3c7;
            text-decoration: none;
            transition: all 0.3s ease;
        }

        .sidebar-menu a:hover,
        .sidebar-menu a.active {
            background-color: rgba(255,255,255,0.1);
            color: white;
            padding-left: 2rem;
        }

        .sidebar-menu i {
            margin-right: 10px;
            font-size: 1.2rem;
        }

        .main-content {
            margin-left: var(--sidebar-width);
            padding: 2rem;
        }

        .navbar {
            background: white;
            box-shadow: 0 2px 10px rgba(0,0,0,0.1);
            padding: 1rem 2rem;
            position: sticky;
            top: 0;
            z-index: 1001;
        }

        @media (max-width: 768px) {
            .sidebar {
                position: absolute;
                transform: translateX(-100%);
                transition: transform 0.3s ease-in-out;
            }

            .sidebar.show {
                transform: translateX(0);
            }

            .main-content {
                margin-left: 0;
            }
        }
    </style>

    @stack('styles')
</head>
<body>

    {{-- Sidebar --}}
    <div class="sidebar" id="adminSidebar">
        <div class="sidebar-header">
            <h4><i class="bx bx-car"></i> RentTour Admin</h4>
        </div>
        <ul class="sidebar-menu">
            <li><a href="/admin/dashboard"><i class="bx bx-home"></i> Dashboard</a></li>
            <li><a href="/admin/bookings"><i class="bx bx-calendar"></i> Bookings</a></li>
            <li><a href="/admin/vehicles"><i class="bx bx-car"></i> Vehicles</a></li>
            <li><a href="/admin/tours"><i class="bx bx-map"></i> Tours</a></li>
            <li><a href="/admin/calendar"><i class="bx bx-calendar-check"></i> Availability</a></li>
            <li><a href="/admin/customers"><i class="bx bx-user"></i> Customers</a></li>
            <li><a href="/admin/payments"><i class="bx bx-credit-card"></i> Payments</a></li>
            <li><a href="/admin/reports"><i class="bx bx-bar-chart"></i> Reports</a></li>
            <li><a href="/admin/settings"><i class="bx bx-cog"></i> Settings</a></li>
        </ul>
    </div>

    {{-- Main Content --}}
    <div class="main-content">
        {{-- Topbar --}}
        <nav class="navbar d-flex justify-content-between">
            <div class="d-flex align-items-center">
                <button class="btn btn-outline-secondary d-md-none" onclick="document.getElementById('adminSidebar').classList.toggle('show')">
                    <i class="bx bx-menu"></i>
                </button>
                <span class="ms-3 fw-bold fs-5 text-dark">Admin Panel</span>
            </div>
            <div>
                <div class="dropdown">
                    <button class="btn btn-light dropdown-toggle" data-bs-toggle="dropdown">
                        <i class="bx bx-user-circle"></i> Admin
                    </button>
                    <ul class="dropdown-menu dropdown-menu-end">
                        <li><a class="dropdown-item" href="#"><i class="bx bx-user"></i> Profile</a></li>
                        <li><a class="dropdown-item" href="#"><i class="bx bx-cog"></i> Settings</a></li>
                        <li><hr class="dropdown-divider"></li>
                        <li><a class="dropdown-item" href="#"><i class="bx bx-log-out"></i> Logout</a></li>
                    </ul>
                </div>
            </div>
        </nav>

        {{-- Page Content --}}
        <main>
            @yield('content')
        </main>
    </div>

    {{-- JS Libraries --}}
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

    @stack('scripts')
</body>
</html>
