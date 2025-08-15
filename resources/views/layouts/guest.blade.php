<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Session Expired</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
    <style>
        body {
            background-color: #f8f9fa;
        }
        .card {
            border: none;
            border-radius: 1rem;
            box-shadow: 0 0.25rem 1rem rgba(0, 0, 0, 0.1);
        }
        .icon-circle {
            width: 60px;
            height: 60px;
            border-radius: 50%;
            background-color: #ffc107;
            display: flex;
            align-items: center;
            justify-content: center;
            margin-bottom: 1rem;
        }
    </style>
</head>
<body>
    <div class="container d-flex align-items-center justify-content-center min-vh-100">
        <div class="card p-5 text-center">
            <div class="icon-circle mx-auto">
                <i class='bx bx-time bx-lg text-dark'></i>
            </div>
            <h4 class="mb-3">Session Expired</h4>
            <p class="text-muted">Your session has timed out due to inactivity. Please log in again to continue.</p>
            <a href="{{ route('admin.login') }}" class="btn btn-warning mt-3">
                <i class='bx bx-log-in-circle'></i> Login Again
            </a>
        </div>
    </div>
</body>
</html>