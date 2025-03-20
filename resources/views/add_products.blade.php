<style>
        .content-container{
            z-index: -1;
        }
        .upload-box {
            border: 2px dashed #007bff;
            border-radius: 10px;
            text-align: center;
            padding: 30px;
            cursor: pointer;
            transition: 0.3s;
        }
        .upload-box:hover {
            background-color: #f8f9fa;
        }
        .upload-box i {
            font-size: 50px;
            color: #007bff;
        }
        .progress {
            display: none;
            margin-top: 10px;
        }
        .preview img {
            max-width: 100%;
            height: auto;
            margin-top: 10px;
            border-radius: 5px;
        }
    </style>

@extends('layouts.app')

@section('title', 'Dashboard')

@section('content')

<!-- Main Content -->
<div class="d-flex justify-content-center align-items-center">
    <div class="container">
        <div class="content-container flex-grow-1 mt-3">
            <div class="d-flex justify-content-between align-items-center">
                <h2 class="fw-bold">Add New Product</h2>
            </div>

            <form action="{{ route('product.store') }}" method="POST">
                @csrf
                <div class="row justify-content-center mt-2">
                    <!-- Product Image Section -->
                    <div class="col-lg-8 col-md-10">
                    <div class="card p-4">
                            <h3 class="fw-bold mb-4">General Information</h3>
                            <div class="mb-4">
                                <label class="fw-semibold fs-5">Category</label>
                                <select name="category_id" class="form-control form-control-lg" required>
                                    <option value="" disabled selected>Select Category</option>
                                    @foreach($categories as $category)
                                        <option value="{{ $category->category_id }}">{{ $category->name }}</option>
                                    @endforeach
                                </select>
                            </div>

                            <div class="mb-4">
                                <label class="fw-semibold fs-5">Product Name</label>
                                <input type="text" name="name" class="form-control form-control-lg" placeholder="Enter Product Name" required>
                            </div>

                            <div class="row">
                                <div class="col-md-6 mb-4">
                                    <label class="fw-semibold fs-5">Product Code</label>
                                    <input type="text" name="product_code" class="form-control form-control-lg" placeholder="Enter Product Code" required>
                                </div>

                                <div class="col-md-6 mb-4">
                                    <label class="fw-semibold fs-5">Description</label>
                                    <textarea name="description" class="form-control form-control-lg" rows="4" placeholder="Enter Product Description"></textarea>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Submit Button -->
                <div class="text-center mt-5">
                    <button type="submit" class="btn btn-dark text-light px-5 py-2 fs-5">Next</button>
                </div>
            </form>
        </div>
    </div>
</div>



@endsection

