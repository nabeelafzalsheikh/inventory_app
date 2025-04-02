@extends('admin.layout.app')

@section('title', 'Dashboard')

@section('content')
<h2>Supplier List</h2>
<table id="supplierTable" class="table table-striped table-bordered" style="width:100%">
    <thead>
        <tr>
            <th>Name</th>
            <th>Email</th>
            <th>Contact Person</th>
            <th>Phone</th>
            <th>Actions</th>
        </tr>
    </thead>
    <tbody>
        @foreach($suppliers as $supplier)
            <tr>
                <td>{{ $supplier->name }}</td>
                <td>{{ $supplier->email }}</td>
                <td>{{ $supplier->contact_person_name }}</td>
                <td>{{ $supplier->phone }}</td>
                <td>
                    <a href="{{ route('suppliers.show', $supplier) }}" class="btn btn-info">View</a>
                    <a href="{{ route('suppliers.edit', $supplier) }}" class="btn btn-warning">Edit</a>
                    <form action="{{ route('suppliers.destroy', $supplier) }}" method="POST" style="display:inline;">
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
    $('#supplierTable').DataTable({
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
function viewDetails(supplierId) {
    alert("Viewing details for supplier ID: " + supplierId);
    // You can redirect to a details page or open a modal here
    // Example: window.location.href = "supplier_details.php?id=" + supplierId;
}

// Edit Supplier Functionality
function editSupplier(supplierId) {
    alert("Editing supplier ID: " + supplierId);
    // You can redirect to an edit page or open a modal here
    // Example: window.location.href = "edit_supplier.php?id=" + supplierId;
}

// Delete Supplier Functionality
function deleteSupplier(supplierId) {
    if (confirm("Are you sure you want to delete supplier ID: " + supplierId + "?")) {
        alert("Deleting supplier ID: " + supplierId);
        // Add AJAX call or form submission to delete the supplier
    }
}
</script>

@endsection
