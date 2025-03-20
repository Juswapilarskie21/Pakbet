
<style>
        body {
            font-family: 'Poppins', sans-serif;
            background-color: #f4f6f9;
        }
        .table-responsive {
            overflow-x: auto;
        }
        .btn {
            padding: 12px 20px;
            font-size: 14px;
            border-radius: 6px;
        }
        #icon {
            color: white;
        }
        .card-header {
            background-color: #a2201a !important;
        }
        .small-box .inner {
            background-color: rgba(162, 32, 26, 1);
        }
        .small-box {
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
        }
        .table th, .table td {
            text-align: center;
        }
        .table-striped tbody tr:nth-child(odd) {
            background-color: rgba(162, 32, 26, 0.1);
        }
        .table td {
            vertical-align: middle;
        }

        /* Improved spacing and responsiveness */
        .content-header {
            padding: 15px;
            background-color: #ffffff;
            border-bottom: 2px solid #ddd;
        }
        .container-fluid {
            padding: 20px;
        }

        @media (max-width: 576px) {
            .btn-group-mobile {
                flex-direction: column;
                gap: 10px;
            }
        }

        /* Custom Card Layout */
        .card-custom {
            border-radius: 8px;
            box-shadow: 0 0 20px rgba(0, 0, 0, 0.1);
            margin-bottom: 20px;
        }

        /* Chart Style */
        .card-body canvas {
            width: 100% !important;
            max-height: 400px;
        }
    </style>

@extends('layouts.app')

@section('title', 'Dashboard')

@section('content')
   

        <!-- Content Wrapper -->
        <div class="content-wrapper">
            <!-- Content Header -->
            <div class="content-header">
                <div class="container-fluid">
                    <h1 class="m-0">Payment Management System</h1>
                </div>
            </div>

            <!-- Dashboard -->
            <div class="row">
                <!-- Dashboard Stats -->
                <div class="col-lg-3 col-md-6 col-sm-12">
                    <div class="small-box bg-info">
                        <div class="inner">
                            <h3>150</h3>
                            <p>Total Payments</p>
                        </div>
                        <div class="icon" id="icon">
                            <i class="fas fa-credit-card"></i>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6 col-sm-12">
                    <div class="small-box bg-success">
                        <div class="inner">
                            <h3>44</h3>
                            <p>Refunded Payments</p>
                        </div>
                        <div class="icon" id="icon">
                            <i class="fas fa-undo-alt"></i>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6 col-sm-12">
                    <div class="small-box bg-danger">
                        <div class="inner">
                            <h3>65</h3>
                            <p>Failed Payments</p>
                        </div>
                        <div class="icon" id="icon">
                            <i class="fas fa-ban"></i>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6 col-sm-12">
                    <div class="small-box bg-danger">
                        <div class="inner">
                            <h3>65</h3>
                            <p>Pending Payments</p>
                        </div>
                        <div class="icon" id="icon">
                            <i class="fas fa-clock"></i>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Payment List and Transaction Overview -->
            <section class="content">
                <div class="container-fluid">
                    <div class="card card-custom">
                        <div class="card-header">
                            <h3 class="card-title text-white">Payments List</h3>
                        </div>
                        <div class="d-flex flex-wrap justify-content-between align-items-center m-3 btn-group-mobile">
                            <div class="d-flex gap-3">
                                <button class="btn btn-outline-dark btn-sm" id="exportCSV" data-bs-toggle="tooltip" title="Export payments as CSV">
                                    <i class="fas fa-file-csv"></i> Export CSV
                                </button>
                                <button class="btn btn-sm text-white" style="background-color: #a2201a;" id="exportExcel" data-bs-toggle="tooltip" title="Export payments as Excel">
                                    <i class="fas fa-file-excel"></i> Export Excel
                                </button>
                                <button class="btn btn-outline-dark btn-sm" id="updatePayments" data-bs-toggle="tooltip" title="Refresh payments list">
                                    <i class="fas fa-sync"></i> Update Payments
                                </button>
                                <button class="btn btn-outline-dark btn-sm" id="processRefunds" data-bs-toggle="tooltip" title="Process Refunds for selected payments">
                                    <i class="fas fa-undo-alt"></i> Process Refunds
                                </button>
                            </div>

                            <div>
                                <select id="paymentStatusFilter" class="form-select form-select-sm w-auto">
                                    <option value="">All Statuses</option>
                                    <option value="Pending">Pending</option>
                                    <option value="Completed">Completed</option>
                                    <option value="Cancelled">Cancelled</option>
                                </select>
                            </div>
                        </div>

                        <div class="table-responsive">
                            <table id="paymentTable" class="table table-striped">
                                <thead>
                                    <tr>
                                        <th><input type="checkbox" id="selectAll"></th>
                                        <th>Payment ID</th>
                                        <th>Customer Name</th>
                                        <th>Payment Status</th>
                                        <th>Total Amount</th>
                                        <th>Payment Date</th>
                                        <th>Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td><input type="checkbox" class="paymentCheckbox"></td>
                                        <td>#1001</td>
                                        <td>John Doe</td>
                                        <td><span class="badge bg-warning text-dark">Pending</span></td>
                                        <td>$150.00</td>
                                        <td>2025-02-22</td>
                                        <td>
                                        <div class="d-flex gap-2">
    <button class="btn btn-outline-dark btn-sm" data-bs-toggle="tooltip" title="View Payment">
        View
    </button>
    <button class="btn btn-outline-dark btn-sm" data-bs-toggle="tooltip" title="Refund Payment">
        Refund
    </button>
    <button class="btn btn-danger btn-sm" data-bs-toggle="tooltip" title="Cancel Payment">
        Cancel
    </button>
</div>

                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </section>

            <!-- Shipping Fee Configuration -->
            <section class="content">
                <div class="container-fluid">
                    <div class="card card-custom">
                        <div class="card-header">
                            <h3 class="card-title text-white">Shipping Fee Configuration</h3>
                        </div>
                        <div class="card-body">
                            <form>
                                <div class="form-group mb-4">
                                    <label for="baseRate">Base Shipping Rate</label>
                                    <div class="input-group">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text"><i class="fas fa-dollar-sign"></i></span>
                                        </div>
                                        <input type="number" class="form-control" id="baseRate" name="baseRate" placeholder="Enter base rate">
                                    </div>
                                </div>
                                <div class="form-group mb-4">
                                    <label for="zoneRate">Zone-based Shipping Rate</label>
                                    <div class="input-group">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text"><i class="fas fa-map-marker-alt"></i></span>
                                        </div>
                                        <input type="number" class="form-control" id="zoneRate" name="zoneRate" placeholder="Enter zone rate">
                                    </div>
                                </div>
                                <div class="form-group mb-4">
                                    <label for="weightRate">Weight-based Shipping Rate</label>
                                    <div class="input-group">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text"><i class="fas fa-weight-hanging"></i></span>
                                        </div>
                                        <input type="number" class="form-control" id="weightRate" name="weightRate" placeholder="Enter weight rate">
                                    </div>
                                </div>
                                <div class="form-group mb-4">
                                    <label for="freeShipping">Free Shipping Threshold</label>
                                    <div class="input-group">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text"><i class="fas fa-gift"></i></span>
                                        </div>
                                        <input type="number" class="form-control" id="freeShipping" name="freeShipping" placeholder="Enter free shipping threshold">
                                    </div>
                                </div>
                                <button type="submit" class="btn btn-gradient btn-block">Save Shipping Fee Configuration</button>
                            </form>
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
            $('#paymentTable').DataTable();
        });

        document.addEventListener("DOMContentLoaded", function () {
            var tooltipTriggerList = document.querySelectorAll('[data-bs-toggle="tooltip"]');
            var tooltipList = [...tooltipTriggerList].map(tooltipTriggerEl => new bootstrap.Tooltip(tooltipTriggerEl));
        });

        document.getElementById("selectAll").addEventListener("click", function() {
            let checkboxes = document.querySelectorAll(".paymentCheckbox");
            checkboxes.forEach(cb => cb.checked = this.checked);
        });

        // Placeholder for chart (Payment Overview)
        const ctx = document.getElementById('paymentChart').getContext('2d');
        const paymentChart = new Chart(ctx, {
            type: 'bar',
            data: {
                labels: ['Payments', 'Refunds', 'Failed', 'Pending'],
                datasets: [{
                    label: 'Payment Status Overview',
                    data: [150, 44, 65, 65], // Example data
                    backgroundColor: ['#17a2b8', '#28a745', '#dc3545', '#ffc107'],
                }]
            },
            options: {
                responsive: true,
                plugins: {
                    legend: {
                        position: 'top',
                    },
                    tooltip: {
                        callbacks: {
                            label: function(tooltipItem) {
                                return tooltipItem.dataset.label + ': ' + tooltipItem.raw;
                            }
                        }
                    }
                }
            }
        });
    </script>

@endsection