<!DOCTYPE html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>AdminLTE v3 Dashboard</title>

    <!-- Bootstrap 5 -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">

    <!-- AdminLTE 3 -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/admin-lte/3.2.0/css/adminlte.min.css">

    <!-- FontAwesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">

    <!-- DataTables -->
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.6/css/jquery.dataTables.min.css">

    <style>
        body {
            font-family: 'Poppins', sans-serif;
        }

        .nav-sidebar .nav-item {

    border-radius: 5px; /* Rounded corners */
    margin-bottom: 6px; /* Space between items */
    padding: 5px; /* Space inside the item */
}

.nav-sidebar .nav-link {
    padding: 12px 15px; /* More padding for better spacing */
    font-size: 18px; /* Slightly larger font */
    display: flex;
    align-items: center;
    gap: 10px; /* Space between icon and text */
}

.nav-sidebar .nav-icon {
    font-size: 18px; /* Slightly larger icons */
}

/* Optional: Improve hover effect */
.nav-sidebar .nav-item:hover {
    background-color: #f8f9fa;
    transition: 0.3s;
}


    </style>
    </head>
    <body class="hold-transition sidebar-mini layout-fixed">
    <div class="wrapper">

   <!-- Navbar -->
   <nav class="main-header navbar navbar-expand navbar-white navbar-light">
        <ul class="navbar-nav">
            <li class="nav-item">
                <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
            </li>
        </ul>
    </nav>

<aside class="main-sidebar sidebar-light-white elevation-2">
    <!-- Brand Logo -->
    @if(Auth::check())
    <a href="" class="brand-link text-center">
        <span class="brand-text font-weight-light text-center">{{ Auth::user()->first_name }} </span>
    </a>
    @endif

    <!-- Sidebar -->
    <div class="sidebar">
        <!-- Sidebar Menu -->
        <nav class="mt-2">
            <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu">
                <!-- Dashboard -->
                <li class="nav-item">
                    <a href="{{ route('dashboard') }}" class="nav-link">
                        <i class="nav-icon fas fa-tachometer-alt"></i>
                        <p>Dashboard</p>
                    </a>
                </li>

                <!-- Customer Management -->
                <li class="nav-item">
                    <a href="{{ route('customers') }}" class="nav-link">
                        <i class="nav-icon fas fa-users"></i>
                        <p>Customers</p>
                    </a>
                </li>

                <!-- Order Management -->
                <li class="nav-item">
                    <a href="{{ route('orders') }}" class="nav-link">
                        <i class="nav-icon fas fa-shopping-cart"></i>
                        <p>Orders</p>
                    </a>
                </li>

                <!-- Product Management -->
                <li class="nav-item">
                    <a href="{{ route('products') }}" class="nav-link">
                        <i class="nav-icon fas fa-box"></i>
                        <p>Products</p>
                    </a>
                </li>

                <!-- Content Management -->
                <li class="nav-item">
                    <a href="{{ route('cms') }}" class="nav-link">
                        <i class="nav-icon fas fa-file-alt"></i>
                        <p>CMS</p>
                    </a>
                </li>

                <!-- Payment Management -->
                <li class="nav-item">
                    <a href="{{ route('payment') }}" class="nav-link">
                        <i class="nav-icon fas fa-credit-card"></i>
                        <p>Payment</p>
                    </a>
                </li>

                      <li class="nav-item">
                      <form action="{{ route('logout') }}" method="POST" id="logout-form">
                      @csrf
                    <button type="submit" class="nav-link" id="logout-btn">
                    <i class="nav-icon fas fa-sign-out-alt"></i>
                        <p>Logout</p>
                    </button>

                    </form>
                </li>

            </ul>
        </nav>
        <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
</aside>

<script>
    document.getElementById('logout-btn').addEventListener('click', function(event) {
        event.preventDefault();
        Swal.fire({
            title: 'Are you sure?',
            text: 'You are about to log out!',
            icon: 'warning',
            showCancelButton: true,
            confirmButtonText: 'Yes, log out!',
            cancelButtonText: 'Cancel',
            reverseButtons: true
        }).then((result) => {
            if (result.isConfirmed) {
                document.getElementById('logout-form').submit();
            }
        });
    });
</script>

<!-- AdminLTE -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/admin-lte/3.2.0/js/adminlte.min.js"></script>
<!-- jQuery -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>

<!-- Bootstrap Bundle -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

</body>
</html>
