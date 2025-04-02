@extends('admin.layout.app')

@section('title', 'Dashboard')

@section('content')
<h2>Purchase List</h2>
<table id="PurchaseTable" class="table table-striped table-bordered" style="width:100%">
    <thead>
        <tr>
            <th>Product</th>
            <th>Supplier</th>
            <th>Quantity</th>
            <th>Unit Price</th>
            <th>Total</th>
            <th>Paid</th>
            <th>Balance</th>
            <th>Actions</th>
        </tr>
    </thead>
    <tbody>
        @foreach($purchases as $purchase)
            <tr>
                <td>{{ $purchase->product->name }}</td>
                <td>{{ $purchase->supplier->name }}</td>
                <td>{{ $purchase->quantity }}</td>
                <td>{{ number_format($purchase->unit_price, 2) }}</td>
                <td>{{ number_format($purchase->total_price, 2) }}</td>
                <td>{{ number_format($purchase->amount_paid, 2) }}</td>
                <td>{{ number_format($purchase->remaining_balance, 2) }}</td>
                <td>
                    <a href="{{ route('purchases.show', $purchase) }}" class="btn btn-info">View</a>
                    <a href="{{ route('purchases.edit', $purchase) }}" class="btn btn-warning">Edit</a>
                    <form action="{{ route('purchases.destroy', $purchase) }}" method="POST" style="display:inline;">
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
    $('#PurchaseTable').DataTable({
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
function viewDetails(PurchaseId) {
    alert("Viewing details for Purchase ID: " + PurchaseId);
    // You can redirect to a details page or open a modal here
    // Example: window.location.href = "purchase_details.php?id=" + PurchaseId;
}

// Edit Purchase Functionality
function editPurchase(PurchaseId) {
    alert("Editing Purchase ID: " + PurchaseId);
    // You can redirect to an edit page or open a modal here
    // Example: window.location.href = "edit_purchase.php?id=" + PurchaseId;
}

// Delete Purchase Functionality
function deletePurchase(PurchaseId) {
    if (confirm("Are you sure you want to delete Purchase ID: " + PurchaseId + "?")) {
        alert("Deleting Purchase ID: " + PurchaseId);
        // Add AJAX call or form submission to delete the purchase entry
    }
}
</script>

@endsection
