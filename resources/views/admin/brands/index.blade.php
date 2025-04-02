@extends('admin.layout.app')

@section('title', 'Dashboard')

@section('content')
<h2>Brand List</h2>

<!-- Add Brand Button -->
<a href="{{route('brands.create')}}" class="btn btn-gradient mb-4">
    <i class="fas fa-plus"></i> Add Brand
</a>
<!-- Success Message -->
@if(session('success'))
    <div class="alert alert-success alert-dismissible fade show">
        {{ session('success') }}
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
    </div>
@endif
<!-- Brand Datatable -->
<div class="table-responsive">
    <table id="brandTable" class="table table-striped table-bordered">
        <thead>
            <tr>
                <th>ID</th>
                <th>Brand Name</th>
                <th>Brand Description</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($brands as $brand)
                <tr>
                    <td>{{ $brand->id }}</td>
                    <td>{{ $brand->name }}</td>
                    <td>{{ $brand->description }}</td>
                    <td>
                        <a href="{{ route('brands.edit', $brand->id) }}" class="btn btn-warning">Edit</a>
                        <form action="{{ route('brands.destroy', $brand->id) }}" method="POST" style="display:inline;">
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
</div>

<!-- Include jQuery, Bootstrap JS, and DataTables -->
<script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.bundle.min.js"></script>
<script src="https://cdn.datatables.net/1.10.21/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.10.21/js/dataTables.bootstrap4.min.js"></script>

<!-- DataTables CSS -->
<link rel="stylesheet" href="https://cdn.datatables.net/1.10.21/css/dataTables.bootstrap4.min.css">

<script>
$(document).ready(function() {
    // Initialize DataTable
    $('#brandTable').DataTable({
        "paging": true, // Enable pagination
        "searching": true, // Enable search
        "ordering": true, // Enable sorting
        "info": true, // Show table information
        "responsive": true // Make table responsive
    });

    // Handle edit button click
    $('#brandTable').on('click', '.btn-primary', function() {
        const brandId = $(this).closest('tr').find('td:eq(0)').text();
        alert('Edit Brand ID: ' + brandId);
        // Redirect to edit page or open a modal
    });

    // Handle delete button click
    $('#brandTable').on('click', '.btn-danger', function() {
        const brandId = $(this).closest('tr').find('td:eq(0)').text();
        if (confirm('Are you sure you want to delete this brand?')) {
            alert('Delete Brand ID: ' + brandId);
            // Perform AJAX delete request
        }
    });

      // Auto-dismiss alerts after 5 seconds
      setTimeout(function() {
        $('.alert').fadeTo(500, 0).slideUp(500, function(){
            $(this).remove(); 
        });
    }, 5000);
});
</script>

@endsection
