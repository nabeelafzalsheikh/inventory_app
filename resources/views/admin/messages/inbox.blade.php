@extends('layouts.app')

@section('title', 'Dashboard')

@section('content')
<h2>Inbox</h2>

<!-- Message Table -->
<table id="inboxTable" class="table table-striped table-bordered" style="width:100%">
    <thead>
        <tr>
            <th>#</th>
            <th>From</th>
            <th>Subject</th>
            <th>Message</th>
            <th>Received At</th>
            <th>Actions</th>
        </tr>
    </thead>
    <tbody>
        <tr>
            <td>1</td>
            <td>John Doe</td>
            <td>Meeting Reminder</td>
            <td>Dont forget about the meeting at 3 PM.</td>
            <td>2024-03-12 10:15 AM</td>
            <td>
                <button class='btn btn-sm btn-info' onclick='viewMessage(1)'>
                    <i class='fas fa-eye'></i> View
                </button>
                <button class='btn btn-sm btn-danger' onclick='deleteMessage(1)'>
                    <i class='fas fa-trash'></i> Delete
                </button>
            </td>
        </tr>
        <tr>
            <td>2</td>
            <td>Jane Smith</td>
            <td>Project Update</td>
            <td>The project is 80% complete.</td>
            <td>2024-03-12 09:30 AM</td>
            <td>
                <button class='btn btn-sm btn-info' onclick='viewMessage(2)'>
                    <i class='fas fa-eye'></i> View
                </button>
                <button class='btn btn-sm btn-danger' onclick='deleteMessage(2)'>
                    <i class='fas fa-trash'></i> Delete
                </button>
            </td>
        </tr>
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
$(document).ready(function() {
    // Initialize DataTable
    $('#inboxTable').DataTable({
        "paging": true,
        "searching": true,
        "ordering": true,
        "info": true,
        "responsive": true
    });
});

// Function to view a message
function viewMessage(messageId) {
    alert(`Viewing message with ID: ${messageId}`);
}

// Function to delete a message
function deleteMessage(messageId) {
    if (confirm("Are you sure you want to delete this message?")) {
        alert(`Deleting message with ID: ${messageId}`);
    }
}
</script>

@endsection
