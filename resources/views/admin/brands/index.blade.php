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
    <table id="brandTable" class="table table-striped table-bordered nowrap" style="width:100%">
        <thead>
            <tr>
                <th>ID</th>
                <th>Brand Name</th>
                <th>Brand Description</th>
                <th>Created_at</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($brands as $brand)
                <tr>
                    <td>{{ $loop->iteration }}</td>
                    <td>{{ $brand->name }}</td>
                    <td>{{ $brand->description }}</td>
                    <td>{{ $brand->created_at }}</td>
                    <td>
                        <a href="{{ route('brands.edit', $brand->id) }}" class="btn btn-warning">Edit</a>
                        <button onclick="confirmDelete('{{ route('brands.destroy', $brand->id) }}')" 
                            class="btn btn-danger btn-sm">
                        <i class="fas fa-trash-alt"></i> Delete
                    </button>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>
</div>

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

<!-- DataTables CSS -->
<link rel="stylesheet" href="https://cdn.datatables.net/1.10.21/css/dataTables.bootstrap4.min.css">

<script>

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


$(document).ready(function() {
    // Initialize DataTable
    $('#brandTable').DataTable({
        "responsive": true,
        "paging": true,
        "searching": true,
        "ordering": true,
        "info": true,
        "lengthChange": true,
        "lengthMenu": [5, 10, 25, 50, 100],
        "pageLength": 5,
        "order": [[3, "desc"]],
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

    $('#sidebarToggle').click(function() {
        $('.sidebar').toggleClass('active');
        $('.header').toggleClass('active');
        $('.content').toggleClass('active');
    });
   
      // Auto-dismiss alerts after 5 seconds
      setTimeout(function() {
        $('.alert').fadeTo(500, 0).slideUp(500, function(){
            $(this).remove(); 
        });
    }, 5000);
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
