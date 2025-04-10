@extends('admin.layout.app')

@section('title', 'Dashboard')

@section('content')
@if(session('success'))
    <div class="alert alert-success alert-dismissible fade show" role="alert">
        {{ session('success') }}
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
    </div>
@endif
<h2>Product List</h2>
<div class="table-responsive">
    <table id="productTable" class="table table-striped table-bordered nowrap" style="width:100%">
        <thead>
            <tr>
                <th>#</th>
                <th>Product Name</th>
                <th>Category</th>
                <th>SKU</th>
                <th>Price</th>
                <th>Quantity</th>
                <th>Status</th>
                <th>Created_at</th>
                <th>Operations</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($products as $index => $product)
                <tr>
                    <td>{{ $index+1}}</td>
                    <td>{{ $product->name }}</td>
                    <td>{{ $product->category->name }}</td>
                    <td>{{ $product->sku }}</td>
                    <td>{{ $product->price }}</td>
                    <td>{{ $product->pieces }}</td>
                    <td>{{ $product->status }}</td>
                    <td>{{ $product->created_at }}</td>
                    <td>
                        <a href="{{ route('products.edit', $product->id) }}" class="btn btn-warning btn-sm">Edit</a>
                        <button onclick="confirmDelete('{{ route('products.destroy', $product->id) }}')" class="btn btn-danger btn-sm">Delete</button>
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
<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/responsive/2.2.7/css/responsive.bootstrap4.min.css">
<script type="text/javascript" src="https://cdn.datatables.net/1.10.24/js/jquery.dataTables.min.js"></script>
<script type="text/javascript" src="https://cdn.datatables.net/1.10.24/js/dataTables.bootstrap4.min.js"></script>
<script type="text/javascript" src="https://cdn.datatables.net/responsive/2.2.7/js/dataTables.responsive.min.js"></script>
<script type="text/javascript" src="https://cdn.datatables.net/responsive/2.2.7/js/responsive.bootstrap4.min.js"></script>

<!-- Include SweetAlert2 -->
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<script>
$(document).ready(function() {
       $('#productTable').DataTable({
        "responsive": true,
        "paging": true,
        "searching": true,
        "ordering": true,
        "info": true,
        "lengthChange": true,
        "lengthMenu": [5, 10, 25, 50, 100],
        "pageLength": 5,
        "order": [[7, "desc"]],
        "columnDefs": [
            {
                "targets": 0, // First column (index column)
                "orderable": false, // Disable sorting
                "searchable": false // Disable searching
            },
            {
                "targets": -1, // Last column (operations)
                "orderable": false,
                "searchable": false,
                "responsivePriority": 1 // Higher priority to show on small screens
            },
            {
                "targets": [1, 2, 3], // Product Name, Category, SKU
                "responsivePriority": 2 // Medium priority
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

    // Show success message from session
    @if(session('success'))
        Swal.fire({
            icon: 'success',
            title: 'Success!',
            text: '{{ session('success') }}',
            timer: 3000,
            showConfirmButton: false
        });
    @endif
});

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

// Sidebar Toggle
$('#sidebarToggle').click(function() {
    $('.sidebar').toggleClass('active');
    $('.header').toggleClass('active');
    $('.content').toggleClass('active');
});
</script>
@endsection