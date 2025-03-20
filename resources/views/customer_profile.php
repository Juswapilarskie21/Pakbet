
<style>
        body {
            background-color: #f8f9fa;
        }
        .profile-img {
            width: 150px;
            height: 150px;
            border-radius: 50%;
            object-fit: cover;
            border: 4px solid #fff;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
        }
        .card-custom {
            border-radius: 12px;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
        }
        .btn-custom {
            background-color: #007bff;
            color: white;
            transition: 0.3s;
        }
        .btn-custom:hover {
            background-color: #0056b3;
        }
        .info p {
            margin-bottom: 8px;
        }
    </style>

@extends('layouts.app')

@section('title', 'Dashboard')

@section('content')


   
    <div class="content-container flex-grow-1">
    <div class="container py-5">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h2 class="fw-bold">Customer Profile</h2>
        </div>

        <div class="row g-4">
            <!-- Profile Card -->
            <div class="col-lg-4 col-md-5 col-sm-12 text-center">
                <div class="card p-5 bg-white border-0 h-100 d-flex flex-column align-items-center">
                    <img src="https://scontent.fmnl30-2.fna.fbcdn.net/v/t39.30808-6/480053584_122093281748783884_3498989272574484826_n.jpg?_nc_cat=109&ccb=1-7&_nc_sid=6ee11a&_nc_eui2=AeGL93Mz89o8GpH2qHBIvItOwybO5GFMQkDDJs7kYUxCQBHCbxRFElQJ5T_3DVNoV44_ETnmVneexjVYc3DVscHq&_nc_ohc=FBlHzZRDmYAQ7kNvgFbHjfd&_nc_oc=Adgtf6K1KxVBS4jZsFA9QSGED5h_iDS1eqhx6wfnaYBhhqdmnwnIxeFQiGlDYXWyD2U&_nc_zt=23&_nc_ht=scontent.fmnl30-2.fna&_nc_gid=Aq9luvfvm4UGjq98nJvRXm9&oh=00_AYDN1ZVa0K_ByC9kmT2LXdbMpIdg83s3b7D17RXhpk1Grg&oe=67C060B1" 
                        class="profile-img mb-3 rounded-circle" 
                        alt="Customer Image" 
                        style="width: 200px; height: 200px; object-fit: cover;">
                    <h4 class="fw-bold">John Doe</h4>
                    <p class="text-muted mb-3">john.doe@example.com</p>
                    <button class="btn btn-sm px-4 text-white" style="background-color: black;">
                        <i class="bi bi-pencil-square"></i> Edit Profile
                    </button>
                </div>
            </div>

            <!-- Personal Information -->
            <div class="col-lg-8 col-md-7 col-sm-12">
                <div class="card p-5 bg-white border-0 h-100">
                    <h5 class="fw-bold text-secondary">
                        <i class="bi bi-person-circle"></i> Personal Information
                    </h5>
                    <hr>
                    <div class="info">
                        <p><strong>Full Name:</strong> John Doe</p>
                        <p><strong>Email:</strong> john.doe@example.com</p>
                        <p><strong>Phone:</strong> +123 456 7890</p>
                        <p><strong>Date of Birth:</strong> January 1, 1990</p>
                    </div>

                    <h5 class="fw-bold text-secondary mt-4">
                        <i class="bi bi-geo-alt-fill"></i> Address Details
                    </h5>
                    <hr>
                    <div class="info">
                        <p><strong>Street:</strong> 123 Main Street</p>
                        <p><strong>City:</strong> New York</p>
                        <p><strong>State:</strong> NY</p>
                        <p><strong>ZIP Code:</strong> 10001</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection