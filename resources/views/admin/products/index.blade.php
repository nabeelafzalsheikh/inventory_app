@extends('admin.layout.app')

@section('title', 'Dashboard')

@section('content')
<h2>Product List</h2>
<table id="productTable" class="table table-striped table-bordered" style="width:100%">
    <thead>
        <tr>
            <th>ID</th>
            <th>Product Name</th>
            <th>Category</th>
            <th>SKU</th>
            <th>Price</th>
            <th>Quantity</th>
            <th>Status</th>
            <th>Operations</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($products as $product)
            <tr>
                <td>{{ $product->id }}</td>
                <td>{{ $product->name }}</td>
                <td>{{ $product->category->name }}</td>
                <td>{{ $product->sku }}</td>
                <td>{{ $product->price }}</td>
                <td>{{ $product->pieces }}</td>
                <td>{{ $product->status }}</td>
                <td>
                    <a href="{{ route('products.edit', $product->id) }}" class="btn btn-warning">Edit</a>
                    <form action="{{ route('products.destroy', $product->id) }}" method="POST" style="display:inline;">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger">Delete</button>
                    </form>
                </td>
            </tr>
        @endforeach
    </tbody>
</table>
</div>

<!-- Include jQuery and Bootstrap JS -->
<script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.bundle.min.js"></script>

<!-- Include DataTables CSS and JS -->
<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.24/css/dataTables.bootstrap4.min.css">
<script type="text/javascript" src="https://cdn.datatables.net/1.10.24/js/jquery.dataTables.min.js"></script>
<script type="text/javascript" src="https://cdn.datatables.net/1.10.24/js/dataTables.bootstrap4.min.js"></script>

<script>
// Initialize DataTable
$(document).ready(function() {
    $('#productTable').DataTable({
        "paging": true, // Enable pagination
        "searching": true, // Enable search
        "ordering": true, // Enable sorting
        "info": true, // Show table information
        "responsive": true // Make table responsive
    });
});

// Sidebar Toggle
$('#sidebarToggle').click(function() {
    $('.sidebar').toggleClass('active');
    $('.header').toggleClass('active');
    $('.content').toggleClass('active');
});

// Logout Functionality
function logout() {
    window.location.href = "login.html"; // Redirect to login page
}

// View Details Functionality
function viewDetails(productId) {
    alert("Viewing details for product ID: " + productId);
    // You can redirect to a details page or open a modal here
    // Example: window.location.href = "product_details.php?id=" + productId;
}

// Edit Product Functionality
function editProduct(productId) {
    alert("Editing product ID: " + productId);
    // You can redirect to an edit page or open a modal here
    // Example: window.location.href = "edit_product.php?id=" + productId;
}

// Delete Product Functionality
function deleteProduct(productId) {
    if (confirm("Are you sure you want to delete product ID: " + productId + "?")) {
        alert("Deleting product ID: " + productId);
        // Add AJAX call or form submission to delete the product
    }
}
</script>
@endsection