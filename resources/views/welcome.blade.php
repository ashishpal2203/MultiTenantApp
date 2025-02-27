<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">

    <title>Multi-Tenant SaaS</title>

    <!-- Bootstrap 5 CDN -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body>

    <!-- Hero Section -->
    <section class="hero-section d-flex align-items-center text-center text-white">
        <div class="container">
            <h1 class="display-4 fw-bold">Power Your Business with Multi-Tenant SaaS</h1>
            <p class="lead mb-4">
                A scalable, secure, and efficient platform for managing multiple tenants seamlessly.
            </p>

            <div class="d-flex justify-content-center gap-3">
                @if(auth()->check())
                <a href="{{ route('employees.index') }}" class="btn btn-success btn-lg fw-semibold shadow-lg">Dashboard</a>
                @else
                <a href="{{ route('register') }}" class="btn btn-light btn-lg fw-semibold shadow-lg">Register</a>
                <a href="{{ route('login') }}" class="btn btn-primary btn-lg fw-semibold shadow-lg">Login</a>
                @endif
            </div>
        </div>
    </section>

    <!-- Custom CSS -->
    <style>
        .hero-section {
            position: relative;
            background-image: url("{{ asset('images/wmremove-transformed.jpeg') }}");
            background-size: cover;
            background-position: center;
            min-height: 100vh;
            z-index: 1;

        }

        .hero-section::before {
            content: "";
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: linear-gradient(to bottom, rgba(0, 0, 0, 0.6), rgba(0, 0, 0, 0.2));
            pointer-events: none;
            /* Ensures it doesn’t interfere with clicks */
            z-index: -1;
        }
    </style>

    <!-- Bootstrap JS Bundle (Optional for components like modals) -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

</body>

</html>