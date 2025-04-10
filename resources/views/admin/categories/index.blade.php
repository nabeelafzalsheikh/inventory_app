@extends('admin.layout.app')

@section('title', 'Dashboard')

@section('content')
<h2>Category List</h2>
@if(session('success'))
    <div class="alert alert-success alert-dismissible fade show" role="alert">
        {{ session('success') }}
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
    </div>
@endif
<!-- Add Category Button -->
<a href="{{route('categories.create')}}" class="btn btn-gradient mb-4">
    <i class="fas fa-plus"></i> Add Category
</a>

<table id="categoryTable" class="table table-striped table-bordered nowrap" style="width:100%">
    <thead>
        <tr>
            <th>#</th>
            <th>Category Name</th>
            <th>Description</th>
            <th>Status</th>
            <th>Created_at</th>
            <th>Operations</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($categories as $category)
            <tr>
                <td>{{ $loop->iteration }}</td>
                <td>{{ $category->name }}</td>
                <td>{{ $category->description }}</td>
                <td>
                    <span class="badge badge-{{ $category->status == 'active' ? 'success' : 'secondary' }}">
                        {{ ucfirst($category->status) }}
                    </span>
                </td>
                <td>
                    {{$category->created_at}}
                </td>
                <td>
                    <a href="{{ route('categories.edit', $category->id) }}" class="btn btn-warning btn-sm">
                        <i class="fas fa-edit"></i> Edit
                    </a>
                    <button onclick="confirmDelete('{{ route('categories.destroy', $category->id) }}')" 
                            class="btn btn-danger btn-sm">
                        <i class="fas fa-trash-alt"></i> Delete
                    </button>
                </td>
            </tr>
        @endforeach
    </tbody>
</table>

<!-- Include jQuery and Bootstrap JS -->
<script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.bundle.min.js"></script>

<!-- Include SweetAlert2 -->
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<!-- Include DataTables CSS and JS -->
<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.24/css/dataTables.bootstrap4.min.css">
<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/responsive/2.2.7/css/responsive.bootstrap4.min.css">
<script type="text/javascript" src="https://cdn.datatables.net/1.10.24/js/jquery.dataTables.min.js"></script>
<script type="text/javascript" src="https://cdn.datatables.net/1.10.24/js/dataTables.bootstrap4.min.js"></script>
<script type="text/javascript" src="https://cdn.datatables.net/responsive/2.2.7/js/dataTables.responsive.min.js"></script>
<script type="text/javascript" src="https://cdn.datatables.net/responsive/2.2.7/js/responsive.bootstrap4.min.js"></script>

<script>
// Delete confirmation function
function confirmDelete(url) {
    Swal.fire({
        title: 'Are you sure?',
        text: "You won't be able to revert this!",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Yes, delete it!'
    }).then((result) => {
        if (result.isConfirmed) {
            // Create a form dynamically
            const form = document.createElement('form');
            form.action = url;
            form.method = 'POST';
            
            // Add CSRF token
            const csrf = document.createElement('input');
            csrf.type = 'hidden';
            csrf.name = '_token';
            csrf.value = document.querySelector('meta[name="csrf-token"]').content;
            
            // Add method spoofing for DELETE
            const method = document.createElement('input');
            method.type = 'hidden';
            method.name = '_method';
            method.value = 'DELETE';
            
            // Append inputs to form
            form.appendChild(csrf);
            form.appendChild(method);
            
            // Append form to body and submit
            document.body.appendChild(form);
            form.submit();
        }
    });
}

// Initialize DataTable
$(document).ready(function() {
    $('#categoryTable').DataTable({
        "responsive": true,
        "paging": true,
        "searching": true,
        "ordering": true,
        "info": true,
        "lengthChange": true,
        "lengthMenu": [5, 10, 25, 50, 100],
        "pageLength": 5,
        "order": [[4, "desc"]],
        "columnDefs": [
            {
                "targets": 0, // Serial number column
                "orderable": false,
                "searchable": false
            },
            {
                "targets": -1, // Operations column
                "orderable": false,
                "searchable": false,
                "responsivePriority": 1
            },
            {
                "targets": [1, 2], // Name and Description columns
                "responsivePriority": 2
            }
        ],
        "drawCallback": function(settings) {
            var api = this.api();
            var startIndex = api.page.info().page * api.page.info().length;
            
            api.column(0, {page: 'current'}).nodes().each(function(cell, i) {
                cell.innerHTML = startIndex + i + 1;
            });
        }
    });

    // Show success message if exists
    @if(session('success'))
        Swal.fire({
            icon: 'success',
            title: 'Success!',
            html: '{{ session('success') }}',
            timer: 3000,
            showConfirmButton: false
        });
    @endif
});

// Sidebar Toggle
$('#sidebarToggle').click(function() {
    $('.sidebar').toggleClass('active');
    $('.header').toggleClass('active');
    $('.content').toggleClass('active');
});
</script>

<style>
    .btn-sm {
        padding: 0.25rem 0.5rem;
        font-size: 0.875rem;
    }
    .badge {
        font-size: 0.85em;
        font-weight: 500;
        padding: 0.35em 0.65em;
    }
</style>
@endsection