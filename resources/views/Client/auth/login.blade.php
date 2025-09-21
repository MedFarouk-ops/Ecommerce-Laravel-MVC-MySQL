<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>User Login - Farouk Electronics</title>
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
<link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css" rel="stylesheet">
<link href="{{ asset('css/client.css') }}" rel="stylesheet">
<style>
body {
    background-color: #f8f9fa;
}
.auth-card {
    max-width: 400px;
    margin: 80px auto;
    background-color: #fff;
    padding: 2rem;
    border-radius: 0.25rem;
    box-shadow: 0 4px 15px rgba(0,0,0,0.08);
}
</style>
</head>
<body>

<div class="auth-card">
    <h3 class="text-center mb-4 fw-bold"><i class="bi bi-person-circle me-2 text-secondary"></i>User Login</h3>

    <form method="POST" action="#">
        @csrf
        <div class="mb-3">
            <label for="email" class="form-label fw-semibold">Email</label>
            <input type="email" class="form-control" id="email" placeholder="Enter your email" required>
        </div>

        <div class="mb-3">
            <label for="password" class="form-label fw-semibold">Password</label>
            <input type="password" class="form-control" id="password" placeholder="Enter your password" required>
        </div>

        <button type="submit" class="btn btn-secondary w-100 fw-semibold">Login</button>
    </form>

    <div class="text-center mt-3">
        <a href="{{ route('client.register') }}" class="text-decoration-none">Don't have an account? Register</a>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
