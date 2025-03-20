@extends('layouts.app')

@section('title', 'Product Variants')

@section('content')

<style>
    .content-container {
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

<!-- Main Content -->
<div class="content-container flex-grow-1 mt-3">
    <div class="container">
        <h2 class="fw-bold">Product Variants</h2>

        <form action="{{ route('store.variant', ['productId' => $product->product_id]) }}" method="POST" enctype="multipart/form-data">
    @csrf
    <!-- Form fields here -->

            <div class="row">
                <!-- Left Section (Product Image) -->
                <div class="col-md-5">
                    <div class="card p-4">
                        <h5 class="fw-bold">Product Image</h5>
                        <div class="container mt-3">
                            <div id="drop-area" class="upload-box">
                                <p class="mt-2 text-muted">Drag & Drop Files Here Or</p>
                                <input type="file" name="image_url" id="fileInput" class="form-control d-none" accept="image/*">
                                <button type="button" class="btn btn-dark btn-sm" onclick="document.getElementById('fileInput').click()">Browse</button>
                            </div>
                            <div id="preview" class="preview mt-3 text-center"></div>
                        </div>
                    </div>
                </div>

                <!-- Right Section (Product Details) -->
                <div class="col-md-7">
                    <div class="card p-4">
                        <h5 class="fw-bold mb-3">Product Details</h5>
                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label class="fw-semibold">Size</label>
                                <input type="text" name="size" class="form-control" placeholder="Enter Size">
                            </div>
                            <div class="col-md-6 mb-3">
                                <label class="fw-semibold">Color</label>
                                <input type="text" name="color" class="form-control" placeholder="Enter Color" required>
                            </div>

                             <div class="col-md-6 mb-3">
                                <label class="fw-semibold">Height</label>
                                <input type="number" name="height" class="form-control" placeholder="e.g., 0.5" step="0.01" required>
                            </div>
                            <div class="col-md-6 mb-3">
                                <label class="fw-semibold">Width</label>
                                <input type="number" name="width" class="form-control" placeholder="e.g., 0.5" step="0.01" required>
                            </div>
                            <div class="col-md-6 mb-3">
                                <label class="fw-semibold">Weight (kg)</label>
                                <input type="number" name="weight" class="form-control" placeholder="e.g., 0.5" step="0.01" required>
                            </div>
                            <div class="col-md-6 mb-3">
                                <label class="fw-semibold">Price ($)</label>
                                <input type="number" name="price" class="form-control" placeholder="100.00" step="0.01" required>
                            </div>
                            <div class="col-md-6 mb-3">
                                <label class="fw-semibold">Stock Quantity</label>
                                <input type="number" name="stock" class="form-control" placeholder="2000" required>
                            </div>
                            <div class="col-md-12 mb-3">
                                <label class="fw-semibold">SKU</label>
                                <input type="text" name="sku" class="form-control" placeholder="SKU Code" required>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
                <div class="text-end mt-4">
    <button type="submit" class="btn btn-dark text-light px-4">Save Product</button>
</div>

        </form>
    </div>
</div>

<script>
    const fileInput = document.getElementById("fileInput");
    const preview = document.getElementById("preview");
    const dropArea = document.getElementById("drop-area");

    fileInput.addEventListener("change", handleFiles);
    dropArea.addEventListener("dragover", (e) => e.preventDefault());
    dropArea.addEventListener("drop", (e) => {
        e.preventDefault();
        fileInput.files = e.dataTransfer.files;
        handleFiles();
    });

    function handleFiles() {
        preview.innerHTML = "";
        const file = fileInput.files[0];
        if (file) {
            const reader = new FileReader();
            reader.onload = (e) => {
                const img = document.createElement("img");
                img.src = e.target.result;
                img.classList.add("img-fluid", "rounded", "shadow-sm");
                img.style.maxWidth = "100%";
                img.style.maxHeight = "250px";
                preview.appendChild(img);
            };
            reader.readAsDataURL(file);
        }
    }
</script>

@endsection
