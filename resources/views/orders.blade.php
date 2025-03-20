@if(session('success'))
    <script>
        Swal.fire("Success", "{{ session('success') }}", "success");
    </script>
@endif

@if(session('error'))
    <script>
        Swal.fire("Error", "{{ session('error') }}", "error");
    </script>
@endif

<style>
        body {
            font-family: 'Poppins', sans-serif;
        }
        .table-responsive {
            overflow-x: auto;
        }
        .btn {
            padding: 10px 15px;
            font-size: 14px;
            border-radius: 6px;
        }
        #icon{
            color:white;
        }

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
   
<head>
    <!-- SweetAlert2 -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <script>
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
    </script>
     
</head>

    <div class="content-wrapper">
        <div class="content-header">
            <div class="container-fluid">
                <h1 class="m-0">Manage Orders</h1>
            </div>
        </div>

        <div class="container-fluid">
    <div class="row">
        <!-- Cards -->

        <div class="col-lg-3 col-6">
            <div class="small-box bg-info">
                <div class="inner" style="background-color: rgba(162, 32, 26, 1);">
                    <h3>150</h3>
                    <p>Total Orders</p>
                </div>
                <div class="icon" id="icon">
                    <i class="fas fa-shopping-bag"></i> <!-- Changed to a shopping bag for total orders -->
                </div>
            </div>
        </div>

        <div class="col-lg-3 col-6">
            <div class="small-box bg-success">
                <div class="inner" style="background-color: rgba(162, 32, 26, 1);">
                    <h3>44</h3>
                    <p>Refund Orders</p>
                </div>
                <div class="icon" id="icon">
                    <i class="fas fa-undo-alt"></i> <!-- Changed to refund-related icon -->
                </div>
            </div>
        </div>

        <div class="col-lg-3 col-6">
            <div class="small-box bg-primary">
                <div class="inner" style="background-color: rgba(162, 32, 26, 1);">
                    <h3>65</h3>
                    <p>Cancelled Orders</p>
                </div>
                <div class="icon" id="icon">
                    <i class="fas fa-ban"></i> <!-- Changed to ban/cancel icon -->
                </div>
            </div>
        </div>

        <div class="col-lg-3 col-6">
            <div class="small-box bg-primary">
                <div class="inner" style="background-color: rgba(162, 32, 26, 1);">
                    <h3>65</h3>
                    <p>Pending Orders</p>
                </div>
                <div class="icon" id="icon">
                    <i class="fas fa-clock"></i> <!-- Changed to clock for pending status -->
                </div>
            </div>
        </div>



        <div class="card">
   

    </div>
</div>
        <section class="content">
            <div class="container-fluid">
                <div class="card">
                    <div class="card-header" style="background-color: rgba(162, 32, 26, 1);">
                        <h3 class="card-title text-white">Orders List</h3>
                    </div>

                    <div class="d-flex flex-wrap justify-content-between align-items-center m-3 btn-group-mobile">
                    <div class="d-flex gap-2">
                        <button class="btn btn-outline-dark btn-sm" id="exportCSV" data-bs-toggle="tooltip" title="Export orders as CSV">
                        <i class="fas fa-file-csv"></i> Export CSV
                        </button>
                        <button class="btn btn-sm text-white" style="background-color: rgba(162, 32, 26, 1);" id="exportExcel" data-bs-toggle="tooltip" title="Export orders as Excel">
                        <i class="fas fa-file-excel"></i> Export Excel
                        </button>
                        <button class="btn btn-outline-dark btn-sm" id="updateOrders" data-bs-toggle="tooltip" title="Refresh order list">
                        <i class="fas fa-sync"></i> Update Orders
                        </button>
                        <button class="btn btn-outline-dark btn-sm" id="processRefunds" data-bs-toggle="tooltip" title="Initiate refunds for selected orders">
                        <i class="fas fa-undo-alt"></i> Process Refunds
                        </button>
                        <button class="btn btn-outline-dark btn-sm" id="generateInvoices" data-bs-toggle="tooltip" title="Generate invoices for selected orders">
                        <i class="fas fa-file-invoice"></i> Generate Invoices
                        </button>
                    </div>

                <div>
                    <select id="orderStatusFilter" class="form-select form-select-sm w-auto">
                        <option value="">All Statuses</option>
                        <option value="Pending">Pending</option>
                        <option value="Completed">Completed</option>
                        <option value="Cancelled">Cancelled</option>
                    </select>
                </div>
            </div>


                    <div class="table-responsive">
                        <table id="orderTable" class="table">
                            <thead>
                                <tr>
                                    <th><input type="checkbox" id="selectAll"></th>
                                    <th>Order ID</th>
                                    <th>Customer Name</th>
                                    <th>Order Status</th>
                                    <th>Total Amount</th>
                                    <th>Date Ordered</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                        @foreach($orders as $order)
                                <tr>
                                    <td><input type="checkbox" class="orderCheckbox"></td>
                                    <td>{{$order->order_id}}</td>
                                    <td>{{$order->user->first_name}} {{$order->user->last_name}}</td>

                                    <td><span class="badge bg-warning text-dark">{{$order->order_status}}</span></td>
                                    <td>{{$order->total_price}}</td>
                                    <td>{{$order->created_at}}</td>
                                    <td>
                                        <div class="d-flex flex-wrap gap-2">
                                            <button class="btn btn-outline-dark btn-sm viewOrder" data-id="{{ $order->order_id }}" title="View Order">
                                                View
                                            </button>
                                            <button class="btn btn-outline-dark btn-sm editOrder" data-id="{{ $order->order_id }}" title="Edit Order">
                                                Edit
                                            </button>
                                            <button class="btn btn-outline-dark btn-sm refundOrder" data-id="{{ $order->order_id }}" title="Refund Order">
                                                Refund
                                            </button>
                                            <button class="btn btn-outline-dark btn-sm changeStatus" data-id="{{ $order->order_id }}" title="Change Order Status">
                                                Change Status
                                            </button>
                                            <button class="btn btn-danger btn-sm cancelOrder" data-id="{{ $order->order_id }}" title="Cancel Order">
                                                Cancel
                                            </button>
                                        </div>
                                    </td>
                                    
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </section>
    </div>
</div>

<script>
    $(document).ready(function() {
        let table = $('#orderTable').DataTable();

        // Select All Checkboxes
        $("#selectAll").on("click", function() {
            $(".orderCheckbox").prop("checked", this.checked);
        });

        // Initialize Bootstrap Tooltips
        document.querySelectorAll('[data-bs-toggle="tooltip"]').forEach(el => new bootstrap.Tooltip(el));

        // View Order
        $(document).on("click", ".viewOrder", function() {
            let orderId = $(this).data("id");
            window.location.href = `/orders/${orderId}`;
        });

        // Edit Order
        $(document).on("click", ".editOrder", function() {
            let orderId = $(this).data("id");
            window.location.href = `/orders/${orderId}/edit`;
        });

        // Process Refund
        $(document).on("click", ".refundOrder", function() {
            let orderId = $(this).data("id");
            Swal.fire({
                title: "Are you sure?",
                text: "Do you want to refund this order?",
                icon: "warning",
                showCancelButton: true,
                confirmButtonColor: "#28a745",
                cancelButtonColor: "#d33",
                confirmButtonText: "Yes, refund it!"
            }).then((result) => {
                if (result.isConfirmed) {
                    $.ajax({
                        url: `/orders/${orderId}/refund`,
                        type: "POST",
                        data: { _token: "{{ csrf_token() }}" },
                        success: function(response) {
                            Swal.fire({
                                title: "Refunded!",
                                text: response.message,
                                icon: "success",
                                timer: 3000,
                                didClose: () => table.ajax.reload()
                            });
                        },
                        error: function() {
                            Swal.fire("Error!", "Failed to process refund.", "error");
                        }
                    });
                }
            });
        });

        // Change Order Status
        $(document).on("click", ".changeStatus", function() {
            let orderId = $(this).data("id");

            Swal.fire({
                title: "Change Order Status",
                input: "select",
                inputOptions: {
                    Pending: "Pending",
                    Completed: "Completed",
                    Cancelled: "Cancelled",
                    Shipped: "Shipped",
                    Processing: "Processing"
                },
                inputPlaceholder: "Select status",
                showCancelButton: true,
                confirmButtonText: "Update",
                cancelButtonText: "Cancel"
            }).then((result) => {
                if (result.isConfirmed && result.value) {
                    $.ajax({
                        url: `/orders/${orderId}/status`,
                        type: "POST",
                        data: {
                            _token: "{{ csrf_token() }}",
                            status: result.value
                        },
                        success: function(response) {
                            if (response.success) {
                                Swal.fire({
                                    title: "Updated!",
                                    text: response.message,
                                    icon: "success",
                                    timer: 3000,
                                    didClose: () => location.reload()
                                });
                            } else {
                                Swal.fire("Error!", "Failed to update order status.", "error");
                            }
                        },
                        error: function(xhr) {
                            Swal.fire("Error!", "Failed to update order status. " + xhr.responseText, "error");
                        }
                    });
                }
            });
        });

        // Cancel Order
        $(document).on("click", ".cancelOrder", function() {
            let orderId = $(this).data("id");

            Swal.fire({
                title: "Are you sure?",
                text: "Do you want to cancel this order?",
                icon: "warning",
                showCancelButton: true,
                confirmButtonColor: "#dc3545",
                cancelButtonColor: "#6c757d",
                confirmButtonText: "Yes, cancel it!"
            }).then((result) => {
                if (result.isConfirmed) {
                    $.ajax({
                        url: `/orders/${orderId}/cancel`,
                        type: "POST",
                        data: { _token: "{{ csrf_token() }}" },
                        success: function(response) {
                            Swal.fire({
                                title: "Cancelled!",
                                text: "The order has been cancelled.",
                                icon: "success",
                                timer: 3000,
                                didClose: () => table.ajax.reload()
                            });
                        },
                        error: function() {
                            Swal.fire("Error!", "Failed to cancel order.", "error");
                        }
                    });
                }
            });
        });
    });
</script>

<script src="https://cdnjs.cloudflare.com/ajax/libs/xlsx/0.18.5/xlsx.full.min.js"></script>

<script>
document.addEventListener("DOMContentLoaded", function () {

    // Export to CSV
    document.getElementById("exportCSV").addEventListener("click", function () {
        let table = document.getElementById("orderTable");
        let rows = table.querySelectorAll("tr");
        let csvContent = "";

        rows.forEach(row => {
            let rowData = [];
            row.querySelectorAll("th, td").forEach(cell => {
                rowData.push(cell.innerText.trim()); 
            });
            csvContent += rowData.join(",") + "\n";
        });

        let blob = new Blob([csvContent], { type: "text/csv;charset=utf-8;" });
        let link = document.createElement("a");
        link.href = URL.createObjectURL(blob);
        link.download = "orders.csv";
        document.body.appendChild(link);
        link.click();
        document.body.removeChild(link);
    });

    // Export to Excel
    document.getElementById("exportExcel").addEventListener("click", function () {
        let table = document.getElementById("orderTable");
        let wb = XLSX.utils.book_new();
        let ws = XLSX.utils.table_to_sheet(table);
        
        XLSX.utils.book_append_sheet(wb, ws, "Orders");
        XLSX.writeFile(wb, "orders.xlsx");
    });

});
</script>



@endsection
