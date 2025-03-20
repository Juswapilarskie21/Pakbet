@extends('layouts.app')

@section('content')
<div class="d-flex justify-content-between mb-3">
    <h2>Products</h2>
    <a href="{{ route('products.create') }}" class="btn btn-primary">Add Product</a>
</div>

@if(session('success'))
    <script>
        Swal.fire({
            icon: 'success',
            title: 'Success!',
            text: "{{ session('success') }}"
        });
    </script>
@endif

<table class="table table-bordered table-striped">
    <thead class="table-dark">
        <tr>
            <th>Product Code</th>
            <th>Name</th>
            <th>Category</th>
            <th>Description</th>
            <th class="text-center">Actions</th>
        </tr>
    </thead>
    <tbody>
    @forelse($products as $product)
        <tr>
            <td>{{ $product->product_code }}</td>
            <td>{{ $product->name }}</td>
            <td>{{ $product->category->name ?? 'N/A' }}</td>
            <td>{{ $product->description }}</td>
            <td class="text-center">
                <a href="{{ route('products.edit', $product->product_id) }}" class="btn btn-sm btn-warning">Edit</a>
                <form action="{{ route('products.destroy', $product->product_id) }}" method="POST" class="d-inline delete-form">
                    @csrf
                    @method('DELETE')
                    <button type="button" class="btn btn-sm btn-danger btn-delete">Delete</button>
                </form>
            </td>
        </tr>
    @empty
        <tr>
            <td colspan="5" class="text-center">No products found.</td>
        </tr>
    @endforelse
    </tbody>
</table>
@endsection

@section('scripts')
<script>
    // Attach a click event on delete buttons to show confirmation with SweetAlert2
    document.querySelectorAll('.btn-delete').forEach(button => {
        button.addEventListener('click', function (e) {
            e.preventDefault();
            let form = this.closest('form');
            Swal.fire({
                title: 'Are you sure?',
                text: "This action cannot be undone!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Yes, delete it!'
            }).then((result) => {
                if (result.isConfirmed) {
                    form.submit();
                }
            });
        });
    });
</script>
@endsection
