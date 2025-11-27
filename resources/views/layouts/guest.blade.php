{{-- resources/views/layouts/guest.blade.php --}}
<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>@yield('title', 'PetShop Care')</title>

    <!-- Google Font: Source Sans Pro -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <!-- AdminLTE -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/admin-lte@3.2/dist/css/adminlte.min.css">

    <style>
        body {
            background: #f4f6f9;
        }

        .login-page, .register-page {
            background: #f4f6f9;
        }

        .card {
            border: none;
            border-radius: 10px;
            box-shadow: 0 2px 10px rgba(0,0,0,0.08);
        }

        .card-header {
            background: transparent;
            border-bottom: none;
            padding: 2rem 2rem 0;
        }

        .card-body {
            padding: 2rem;
        }

        .login-logo, .register-logo {
            font-size: 2rem;
            font-weight: 600;
            margin-bottom: 1.5rem;
            color: #495057;
        }

        .login-logo i, .register-logo i {
            color: #3498db;
            margin-right: 0.5rem;
        }

        .btn-primary {
            background: #3498db;
            border-color: #3498db;
            border-radius: 5px;
            padding: 0.6rem 1.5rem;
            font-weight: 500;
            transition: all 0.3s ease;
        }

        .btn-primary:hover {
            background: #2980b9;
            border-color: #2980b9;
            transform: translateY(-1px);
            box-shadow: 0 4px 8px rgba(52, 152, 219, 0.3);
        }

        .btn-outline-primary {
            border: 2px solid #3498db;
            color: #3498db;
            border-radius: 5px;
            padding: 0.5rem 1.5rem;
            font-weight: 500;
            background: transparent;
            transition: all 0.3s ease;
        }

        .btn-outline-primary:hover {
            background: #3498db;
            border-color: #3498db;
            color: #fff;
            transform: translateY(-1px);
        }

        .form-control {
            border-radius: 5px;
            border: 1px solid #dee2e6;
            padding: 0.6rem 1rem;
            transition: all 0.3s ease;
        }

        .form-control:focus {
            border-color: #3498db;
            box-shadow: 0 0 0 0.2rem rgba(52, 152, 219, 0.15);
        }

        .input-group-text {
            border-radius: 5px 0 0 5px;
            background: #fff;
            border: 1px solid #dee2e6;
            color: #6c757d;
        }

        .login-card-body .input-group .form-control,
        .register-card-body .input-group .form-control {
            border-left: none;
        }

        .login-card-body .input-group .form-control:focus,
        .register-card-body .input-group .form-control:focus {
            border-left: none;
        }

        .input-group:focus-within .input-group-text {
            border-color: #3498db;
        }

        .text-link {
            color: #3498db;
            text-decoration: none;
            transition: color 0.3s ease;
        }

        .text-link:hover {
            color: #2980b9;
            text-decoration: underline;
        }

        .icheck-primary {
            margin-top: 0.25rem;
        }

        .alert {
            border-radius: 5px;
            border: none;
        }

        .invalid-feedback {
            font-size: 0.875rem;
        }

        .hero-section {
            text-align: center;
            padding: 2rem 0;
            color: #495057;
        }

        .hero-section h1 {
            font-size: 1.75rem;
            font-weight: 600;
            margin-bottom: 0.5rem;
        }

        .hero-section p {
            color: #6c757d;
            font-size: 1rem;
        }

        .pet-icon {
            font-size: 3rem;
            margin-bottom: 1rem;
            color: #3498db;
        }

        @media (max-width: 576px) {
            .card-body {
                padding: 1.5rem;
            }
            
            .login-logo, .register-logo {
                font-size: 1.5rem;
            }
        }
    </style>

    @yield('styles')
</head>
<body class="hold-transition @yield('body-class')">

@yield('content')

<!-- jQuery -->
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<!-- Bootstrap 4 -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/js/bootstrap.bundle.min.js"></script>
<!-- AdminLTE App -->
<script src="https://cdn.jsdelivr.net/npm/admin-lte@3.2/dist/js/adminlte.min.js"></script>

@yield('scripts')

</body>
</html>