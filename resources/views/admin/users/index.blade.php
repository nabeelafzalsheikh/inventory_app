@extends('layouts.app')

@section('title', 'Dashboard')

@section('content')
<h2>User List</h2>

<!-- Buttons for Excel Export and Print -->
<div class="mb-3">
    <button id="exportExcel" class="btn btn-success">
        <i class="fas fa-file-excel"></i> Export to Excel
    </button>
    <button id="printTable" class="btn btn-primary">
        <i class="fas fa-print"></i> Print
    </button>
</div>

<!-- User Table -->
<table id="userTable" class="table table-striped table-bordered" style="width:100%">
    <thead>
        <tr>
            <th>ID</th>
            <th>Name</th>
            <th>Email</th>
            <th>Role</th>
            <th>Operations</th>
        </tr>
    </thead>
    <tbody>
        <!-- Sample Data -->
        <tr>
            <td>1</td>
            <td>John Doe</td>
            <td>john@example.com</td>
            <td>Admin</td>
            <td>
                <button class="btn btn-sm btn-primary" onclick="editUser(1)">Edit</button>
                <button class="btn btn-sm btn-danger" onclick="deleteUser(1)">Delete</button>
            </td>
        </tr>
        <tr>
            <td>2</td>
            <td>Jane Smith</td>
            <td>jane@example.com</td>
            <td>Manager</td>
            <td>
                <button class="btn btn-sm btn-primary" onclick="editUser(2)">Edit</button>
                <button class="btn btn-sm btn-danger" onclick="deleteUser(2)">Delete</button>
            </td>
        </tr>
        <tr>
            <td>3</td>
            <td>Mike Johnson</td>
            <td>mike@example.com</td>
            <td>Staff</td>
            <td>
                <button class="btn btn-sm btn-primary" onclick="editUser(3)">Edit</button>
                <button class="btn btn-sm btn-danger" onclick="deleteUser(3)">Delete</button>
            </td>
        </tr>
        <!-- Add more rows as needed -->
    </tbody>
</table>
</div>

<!-- Include jQuery and Bootstrap JS -->
<script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.bundle.min.js"></script>

<!-- Include DataTables CSS and JS -->
<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.24/css/dataTables.bootstrap4.min.css">
<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/buttons/2.0.1/css/buttons.dataTables.min.css">
<script type="text/javascript" src="https://cdn.datatables.net/1.10.24/js/jquery.dataTables.min.js"></script>
<script type="text/javascript" src="https://cdn.datatables.net/1.10.24/js/dataTables.bootstrap4.min.js"></script>
<script type="text/javascript" src="https://cdn.datatables.net/buttons/2.0.1/js/dataTables.buttons.min.js"></script>
<script type="text/javascript" src="https://cdn.datatables.net/buttons/2.0.1/js/buttons.html5.min.js"></script>
<script type="text/javascript" src="https://cdn.datatables.net/buttons/2.0.1/js/buttons.print.min.js"></script>

<script>
$(document).ready(function() {
    // Initialize DataTable with Buttons
    const table = $('#userTable').DataTable({
        "paging": true, // Enable pagination
        "searching": true, // Enable search
        "ordering": true, // Enable sorting
        "info": true, // Show table information
        "responsive": true, // Make table responsive
        "dom": 'Bfrtip', // Add buttons to the DOM
        "buttons": [
            {
                extend: 'excel', // Excel export button
                text: '<i class="fas fa-file-excel"></i> Export to Excel',
                className: 'btn btn-success'
            },
            {
                extend: 'print', // Print button
                text: '<i class="fas fa-print"></i> Print',
                className: 'btn btn-primary'
            }
        ]
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

    // Manual Excel Export Button
    $('#exportExcel').click(function() {
        table.button('.buttons-excel').trigger();
    });

    // Manual Print Button
    $('#printTable').click(function() {
        table.button('.buttons-print').trigger();
    });

    // Edit User Functionality
    function editUser(userId) {
        alert("Editing user ID: " + userId);
        // You can redirect to an edit page or open a modal here
        // Example: window.location.href = "edit_user.php?id=" + userId;
    }

    // Delete User Functionality
    function deleteUser(userId) {
        if (confirm("Are you sure you want to delete user ID: " + userId + "?")) {
            alert("Deleting user ID: " + userId);
            // Add AJAX call or form submission to delete the user
        }
    }
});
</script>

@endsection
