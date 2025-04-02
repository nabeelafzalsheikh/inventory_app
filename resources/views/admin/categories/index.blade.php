@extends('admin.layout.app')

@section('title', 'Dashboard')

@section('content')
<h2>Category List</h2>

<!-- Add Brand Button -->
<a href="{{route('categories.create')}}" class="btn btn-gradient mb-4">
    <i class="fas fa-plus"></i> Add category
</a>

<!-- Success Message -->
@if(session('success'))
    <div class="alert alert-success alert-dismissible fade show">
        <i class="fas fa-check-circle mr-2"></i> {{ session('success') }}
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
    </div>
@endif
<table id="categoryTable" class="table table-striped table-bordered" style="width:100%">
    <thead>
        <tr>
            <th>ID</th>
            <th>Category Name</th>
            <th>Description</th>
            <th>Status</th>
            <th>Operations</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($categories as $category)
            <tr>
                <td>{{ $category->id }}</td>
                <td>{{ $category->name }}</td>
                <td>{{ $category->status }}</td>
                <td>{{ $category->description }}</td>
                <td>
                    <a href="{{ route('categories.edit', $category->id) }}" class="btn btn-warning">Edit</a>
                    <form action="{{ route('categories.destroy', $category->id) }}" method="POST" style="display:inline;">
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
    $('#categoryTable').DataTable({
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
function viewDetails(categoryId) {
    alert("Viewing details for category ID: " + categoryId);
    // You can redirect to a details page or open a modal here
    // Example: window.location.href = "category_details.php?id=" + categoryId;
}

// Edit Category Functionality
function editCategory(categoryId) {
    alert("Editing category ID: " + categoryId);
    // You can redirect to an edit page or open a modal here
    // Example: window.location.href = "edit_category.php?id=" + categoryId;
}

// Delete Category Functionality
function deleteCategory(categoryId) {
    if (confirm("Are you sure you want to delete category ID: " + categoryId + "?")) {
        alert("Deleting category ID: " + categoryId);
        // Add AJAX call or form submission to delete the category
    }
}
</script>

@endsection
