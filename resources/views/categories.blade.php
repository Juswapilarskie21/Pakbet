@extends('layouts.app')

@section('title', 'Add Categories')

@section('content')

<style>
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

<div class="content-container flex-grow-1 mt-3">
    <div class="container">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h2 class="fw-bold">Add Categories</h2>
        </div>

        <form action="{{ route('categories.store') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="row">
                <!-- General Information Section -->
                <div class="col-md-7">
                    <div class="card p-4">
                        <div class="mb-3">
                            <label class="fw-semibold">Category Name</label>
                            <input type="text" name="name" class="form-control" placeholder="Enter Category Name" required>
                        </div>
                        <div class="mb-3">
                            <label class="fw-semibold">Description</label>
                            <textarea name="description" class="form-control" rows="3"></textarea>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Submit Button -->
            <div class="text-end mt-4">
                <button type="submit" class="btn btn-dark text-light px-4">Save Category</button>
            </div>
        </form>
    </div>
</div>

@endsection
