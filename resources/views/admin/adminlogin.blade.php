<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Admin Login</title>

  <!-- Bootstrap 5 CDN -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" />

  <!-- Boxicons CDN -->
  <link href="https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css" rel="stylesheet" />

  <style>
    body {
      background-color: #f0f2f5;
      height: 100vh;
      display: flex;
      align-items: center;
      justify-content: center;
    }

    .login-box {
      background-color: #fff;
      padding: 2rem;
      border-radius: 10px;
      box-shadow: 0 10px 25px rgba(0, 0, 0, 0.1);
      width: 100%;
      max-width: 400px;
    }

    .form-icon {
      position: absolute;
      top: 50%;
      transform: translateY(-50%);
      left: 15px;
      color: #6c757d;
    }

    .form-control {
      padding-left: 2.5rem;
    }

    @media (max-width: 480px) {
      .login-box {
        padding: 1.5rem;
      }
    }
  </style>
</head>
<body>

  <div class="login-box">
    <h3 class="text-center mb-4">Admin Login</h3>
    <form method="POST" action="{{ route('admin.login') }}">
      @csrf
      <div class="mb-3 position-relative">
        <i class='bx bx-envelope form-icon'></i>
        <input type="email" name="email" class="form-control" placeholder="Email" required value="{{ old('email') }}">
      </div>
      <div class="mb-3 position-relative">
        <i class='bx bx-lock-alt form-icon'></i>
        <input type="password" name="password" class="form-control" placeholder="Password" required>
      </div>
      @error('email')
        <div class="text-danger mb-2">{{ $message }}</div>
      @enderror
      <button type="submit" class="btn btn-primary w-100">Login</button>
    </form>
  </div>

</body>
</html>
