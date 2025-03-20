<style>
        body {
            font-family: 'Poppins', sans-serif;
        }

         /* Ensure table is scrollable on small screens */
    .table-responsive {
        overflow-x: auto;
    }

    /* Stack buttons on smaller screens */
    @media (max-width: 576px) {
        .btn-group-mobile {
            flex-direction: column;
            gap: 5px;
        }
    }
    </style>

@extends('layouts.app')

@section('title', 'Dashboard')

@section('content')

    <!-- Content Wrapper -->
    <div class="content-wrapper">
        <div class="content-header">
            <div class="container-fluid">
                <h1 class="m-0">Product Dashboard</h1>
            </div>
        </div>

        <!-- Main Content -->
        <section class="content">
            <div class="container-fluid">
                <div class="row">
                    <!-- Product Overview Cards -->
                    <div class="col-lg-4 col-md-6">
                        <div class="small-box bg-primary">
                            <div class="inner" style="background-color: rgba(162, 32, 26, 1);">
                                <h3>150</h3>
                                <p>Total Products</p>
                            </div>
                            <div class="icon">
                                <i class="fas fa-box text-white"></i>
                            </div>
                        </div>
                    </div>

                    <div class="col-lg-4 col-md-6">
                        <div class="small-box bg-primary">
                            <div class="inner" style="background-color: rgba(162, 32, 26, 1);">
                                <h3>12</h3>
                                <p>Low Stock</p>
                            </div>
                            <div class="icon">
                                <i class="fas fa-exclamation-triangle text-white"></i>
                            </div>
                        </div>
                    </div>

                    <div class="col-lg-4 col-md-6">
                        <div class="small-box bg-danger">
                            <div class="inner" style="background-color: rgba(162, 32, 26, 1);">
                                <h3>5</h3>
                                <p>Out of Stock</p>
                            </div>
                            <div class="icon">
                                <i class="fas fa-times-circle text-white"></i>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="container-fluid"> <!-- Ensures full width -->
                <div class="row justify-content-center">
    <div class="col-lg-12"> <!-- Adjust width -->
        <div class="card border border-dark">
            <div class="card-header" style="background-color: rgba(162, 32, 26, 1);">
                <h3 class="card-title text-white">Sales Trends</h3>
            </div>
            <div class="card-body">
                <canvas id="salesChart"></canvas>
            </div>
        </div>
    </div>
</div>

</div>

<!-- Stock Levels Table -->
<div class="row">
    <div class="col-lg-12">
        <div class="card">
            <div class="card-header d-flex justify-content-between align-items-center" style="background-color: rgba(162, 32, 26, 1);">
                <h3 class="card-title text-white">Stock Levels</h3>
            </div>
            <div class="d-flex justify-content-end m-3">
    <a href="{{ route('product.create') }}" class="btn btn-sm me-2 text-white" style="background-color: black;">
        <i class="fas fa-plus"></i> Add Products
    </a>
</div>

<div class="card-body">
    <div class="table-responsive">
        <table id="stockTable" class="table">
            <thead>
                <tr>
                    <th>Product ID</th>
                    <th>Image</th>
                    <th>Name</th>
                    <th>Category</th>
                    <th>Description</th>
                    <th>Size</th>
                    <th>Price</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>

                @foreach($products as $product)
                    @foreach($product->variants as $variant)
                        <tr>
                            <td>{{ $product->product_id }}</td>
                            <td>
                                @if ($variant->image_url)
                                    <img src="{{ asset('storage/' . $variant->image_url) }}" alt="Variant Image" width="50">
                                @else
                                    N/A
                                @endif
                            </td>
                            <td>{{ $product->name }}</td>
                            <td>{{ $product->category->name ?? 'No Category' }}</td>
                            <td>{{ $product->description }}</td>
                            <td>{{ $variant->size ?? 'N/A' }}</td>
                            <td>{{ $variant->price ?? 'N/A' }}</td>
                            <td class="d-flex flex-wrap gap-2 btn-group-mobile">
                                <button class="btn btn-outline-dark btn-sm">
                                    <i class="fas fa-edit"></i> Edit
                                </button>
                                <button class="btn btn-sm btn-danger delete-btn"
    data-id="{{ $product->product_id }}"
    data-url="{{ route('products.destroy', $product->product_id) }}">
    <i class="fas fa-trash"></i> Delete
</button>

                            </td>
                        </tr>
                    @endforeach
                @endforeach

            </tbody>
        </table>
    </div>
</div>

        </div>
    </div>
</div>
            </div>
        </section>
    </div>
</div>


<!-- Include SweetAlert2 -->
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<script>
    // Check if there's a success message in the session
    @if(session('success'))
        Swal.fire({
            title: "Success!",
            text: "{{ session('success') }}",
            icon: "success",
            confirmButtonColor: "#28a745"
        });
    @endif
</script>

      <!-- Chart.js -->
      <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

<script>
    $(document).ready(function() {
        $('#stockTable').DataTable();
    });

    const salesChartCanvas = document.getElementById('salesChart');

// Set the height of the parent container
salesChartCanvas.parentElement.style.height = "400px"; // Adjust the height as needed

var salesChart = new Chart(salesChartCanvas, {
    type: 'line',
    data: {
        labels: ['Jan', 'Feb', 'Mar', 'Apr', 'May'],
        datasets: [{
            label: 'Sales',
            data: [150, 200, 300, 250, 400],
            fill: true,
            borderColor: '#1E1E2D', // Line color
            borderWidth: 3
        }]
    },
    options: {
        responsive: true,
        maintainAspectRatio: false // Allows manual height adjustments
    }
});


</script>

<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

<script>
$(document).ready(function() {
    $('.delete-btn').click(function() {
        var productId = $(this).data('id'); // Get product ID

        Swal.fire({
            title: "Are you sure?",
            text: "This product and all its variants will be permanently deleted!",
            icon: "warning",
            showCancelButton: true,
            confirmButtonColor: "#d33",
            cancelButtonColor: "#3085d6",
            confirmButtonText: "Yes, delete it!"
        }).then((result) => {
            if (result.isConfirmed) {
                $.ajax({
                    url: "{{ route('products.destroy', '') }}/" + productId,
                    type: "POST",
                    data: {
                        _method: "DELETE",
                        _token: "{{ csrf_token() }}"
                    },
                    success: function(response) {
                        Swal.fire({
                            title: "Deleted!",
                            text: "Product deleted successfully!",
                            icon: "success",
                            timer: 2000,
                            showConfirmButton: false
                        }).then(() => {
                            window.location.href = "{{ route('products') }}"; // Redirect after success
                        });
                    },
                    error: function(xhr) {
                        Swal.fire("Error!", "Failed to delete product.", "error");
                    }
                });
            }
        });
    });

});
</script>


@endsection
