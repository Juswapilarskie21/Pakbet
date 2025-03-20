@extends('layouts.app')

@section('title', 'Dashboard')

@section('content')
   
    <style>
        body {
            font-family: 'Poppins', sans-serif;
        }
        .export-btn {
            background-color: #FFD700;
            color: #8B0000;
            border: none;
            padding: 8px 12px;
            font-weight: bold;
            border-radius: 5px;
            margin-bottom: 10px;
        }

          /* Ensure table is scrollable on small screens */
    .table-responsive {
        overflow-x: auto;
    }

    /* Make buttons stack on mobile */
    @media (max-width: 576px) {
        .btn-group-mobile {
            flex-direction: column;
            gap: 5px;
        }
    }
    </style>


    <!-- Content Wrapper -->
    <div class="content-wrapper">
        <div class="content-header">
            <div class="container-fluid">
                <h1 class="m-0">Customers</h1>
            </div>
        </div>

        <!-- Main Content -->
        <section class="content">
            <div class="container-fluid">

<!-- Stock Levels Table -->
<div class="row">
    <div class="col-lg-12">
        <div class="card">
            <div class="card-header d-flex justify-content-between align-items-center" style="background-color: rgba(162, 32, 26, 1);">
                <h3 class="card-title text-white">Customers List</h3>
            </div>

<!-- Buttons Row (Now Mobile-Friendly) -->
<div class="d-flex flex-wrap gap-2 m-3 btn-group-mobile">
    <button class="btn btn-outline-dark btn-sm">
        <i class="fas fa-file-csv"></i> Export CSV
    </button>
    <button class="btn btn-sm text-white" style="background-color: rgba(162, 32, 26, 1);">
        <i class="fas fa-file-excel"></i> Export Excel
    </button>
</div>

<!-- Table (Now Responsive with Tooltips) -->
<div class="table-responsive">
    <table id="stockTable" class="table">
        <thead>
            <tr>
                <th>Customer ID</th>
                <th>Customer Name</th>
                <th>Email</th>
                <th>Order History</th>
                <th>Status</th>
                <th>Date Joined</th>
                <th>Location</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td>1</td>
                <td><a href="product_details.php?id=1">Lorem</a></td>
                <td>lorem@email.com</td>
                <td><a href="product_details.php?id=1">Lorem</a></td>
                <td><span class="badge bg-warning text-dark">Lorem</span></td>
                <td>2024-02-22</td>
                <td>New York</td>
                <td>
                <div class="d-flex flex-wrap gap-2">
    <button class="btn btn-outline-dark btn-sm" data-bs-toggle="tooltip" data-bs-placement="top" title="View Details">
        <a href="{{ route('customer_profile') }}" class="text-decoration-none text-dark">View</a>
    </button>
    <button class="btn btn-outline-dark btn-sm" data-bs-toggle="tooltip" data-bs-placement="top" title="Edit Customer">
        Edit
    </button>
    <button class="btn btn-outline-dark btn-sm" data-bs-toggle="tooltip" data-bs-placement="top" title="Activate Customer">
        Activate
    </button>
    <button class="btn btn-danger btn-sm" data-bs-toggle="tooltip" data-bs-placement="top" title="Deactivate Customer">
        Deactivate
    </button>
</div>

                </td>
            </tr>
        </tbody>
    </table>
</div>
        </div>
    </div>
</div>
            </div>
        </section>
    </div>
</div>


      <!-- Chart.js -->
      <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

<script>
    $(document).ready(function() {
        $('#stockTable').DataTable();
    });

    document.addEventListener("DOMContentLoaded", function () {
        var tooltipTriggerList = document.querySelectorAll('[data-bs-toggle="tooltip"]');
        var tooltipList = [...tooltipTriggerList].map(tooltipTriggerEl => new bootstrap.Tooltip(tooltipTriggerEl));
    });
</script>

@endsection