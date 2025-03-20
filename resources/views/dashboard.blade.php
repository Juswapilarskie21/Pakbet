<style>
        #icon{
            color:white;
        }

@media (max-width: 768px) {
    .small-box {
        margin-bottom: 15px;
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
                <h1 class="m-0">Dashboard</h1>
            </div>
        </div>

        <!-- Main Content -->
        <section class="content">
            <div class="container-fluid">
                <div class="row">
                    <!-- Cards -->

                    <div class="col-lg-3 col-6">
                        <div class="small-box bg-info">
                            <div class="inner" style="background-color: rgba(162, 32, 26, 1);">
                                <h3>150</h3>
                                <p>New Orders</p>
                            </div>
                            <div class="icon" id="icon">
                                <i class="fas fa-shopping-cart"></i>
                            </div>
                        </div>
                    </div>

                    <div class="col-lg-3 col-6">
                        <div class="small-box bg-success">
                            <div class="inner" style="background-color: rgba(162, 32, 26, 1);">
                                <h3>44</h3>
                                <p>User Registrations</p>
                            </div>
                            <div class="icon" id="icon">
                                <i class="fas fa-user-plus"></i>
                            </div>
                        </div>
                    </div>

                    <div class="col-lg-3 col-6">
                        <div class="small-box bg-primary">
                            <div class="inner" style="background-color: rgba(162, 32, 26, 1);">
                                <h3>65</h3>
                                <p>Unique Visitors</p>
                            </div>
                            <div class="icon" id="icon">
                                <i class="fas fa-chart-line"></i>
                            </div>
                        </div>
                    </div>

                    <div class="col-lg-3 col-6">
                        <div class="small-box bg-danger">
                            <div class="inner" style="background-color: rgba(162, 32, 26, 1);">
                                <h3>10</h3>
                                <p>Pending Issues</p>
                            </div>
                            <div class="icon" id="icon">
                                <i class="fas fa-exclamation-circle"></i>
                            </div>
                        </div>
                    </div>
                </div>


           <div class="container-fluid">
    <!-- Row for Line and Pie Charts -->
    <div class="row">
        <!-- Sales Line Graph -->
        <div class="col-lg-8 mb-4">
            <div class="card h-100 shadow-sm">
                <div class="card-header" style="background-color: rgba(162, 32, 26, 1);">
                    <h5 class="card-title mb-0 text-white">Sales Line Graph</h5>
                </div>
                <div class="card-body">
                    <canvas id="salesChart"></canvas>
                </div>
            </div>
        </div>

        <!-- Revenue Pie Chart -->
        <div class="col-lg-4 mb-4">
            <div class="card h-100 shadow-sm">
                <div class="card-header" style="background-color: rgba(162, 32, 26, 1);">
                    <h5 class="card-title mb-0 text-white">Revenue Pie Chart</h5>
                </div>
                <div class="card-body d-flex justify-content-center align-items-center">
                    <canvas id="revenueChart"></canvas>
                </div>
            </div>
        </div>
    </div>

    <!-- Bar Chart Row -->
    <div class="row">
        <div class="col-lg-12">
            <div class="card shadow-sm">
                <div class="card-header" style="background-color: rgba(162, 32, 26, 1);">
                    <h5 class="card-title mb-0 text-white">Monthly Sales (Bar Chart)</h5>
                </div>
                <div class="card-body">
                    <canvas id="barChart"></canvas>
                </div>
            </div>
        </div>
    </div>
</div>


                <!-- Data Table -->
                <div class="row">
                    <div class="col-lg-12">
                        <div class="card">
                            <div class="card-header">
                                <h3 class="card-title">Recent Orders</h3>
                            </div>
                            <div class="card-body">
                                <table id="ordersTable" class="display">
                                    <thead>
                                        <tr>
                                            <th>Order ID</th>
                                            <th>Customer</th>
                                            <th>Status</th>
                                            <th>Total</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td>1</td>
                                            <td>John Doe</td>
                                            <td>Completed</td>
                                            <td>$100</td>
                                        </tr>
                                        <tr>
                                            <td>2</td>
                                            <td>Jane Smith</td>
                                            <td>Pending</td>
                                            <td>$75</td>
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
      <!-- Chart.js -->
      <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

<script>
    var salesChart = new Chart(document.getElementById('salesChart'), {
        type: 'line',
        data: { labels: ['Jan', 'Feb', 'Mar', 'Apr', 'May'], datasets: [{ label: 'Sales', data: [150, 200, 300, 250, 400], borderColor: '#001F3F', fill: true }] }
    });

    var revenueChart = new Chart(document.getElementById('revenueChart'), {
        type: 'pie',
        data: { labels: ['Product A', 'Product B', 'Product C'], datasets: [{ data: [40, 30, 30], backgroundColor: ['rgba(162, 32, 26, 1)', 'rgba(241, 193, 129, 1)', 'black'] }] }
    });

    var barChart = new Chart(document.getElementById('barChart'), {
        type: 'bar',
        data: { labels: ['Jan', 'Feb', 'Mar', 'April', 'May', 'June'], datasets: [{ label: 'Revenue', data: [200, 300, 400, 500, 300, 375], backgroundColor: 'rgba(162, 32, 26, 1)' }] }
    });

    $(document).ready(function() {
        $('#ordersTable').DataTable();
    });
</script>
@endsection
