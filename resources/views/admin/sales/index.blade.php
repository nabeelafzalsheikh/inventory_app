@extends('admin.layout.app')

@section('title', 'Sales List')

@section('content')
<div class="container-fluid">
    @if(session('success'))
    <div class="alert alert-success alert-dismissible fade show" role="alert">
        {{ session('success') }}
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
    </div>
@endif
    <div class="row mb-4">
        <div class="col-md-12">
            <h2>Sales Records</h2>
        </div>
    </div>

    <!-- Filters Card -->
    <div class="card mb-4">
        <div class="card-header">
            <div class="d-flex justify-content-between align-items-center">
                <h5 class="mb-0">Filters</h5>
                <button class="btn btn-sm btn-gradient" type="button" data-toggle="collapse" data-target="#filterCollapse">
                    <i class="fas fa-filter"></i> Toggle Filters
                </button>
            </div>
        </div>
        <div class="collapse show" id="filterCollapse">
            <div class="card-body">
                <form action="{{ route('sales.index') }}" method="GET">
                    <div class="row">
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="search">Search</label>
                                <input type="text" name="search" id="search" class="form-control" 
                                       placeholder="Search by invoice, customer..." value="{{ request('search') }}">
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group">
                                <label for="date_from">From Date</label>
                                <input type="date" name="date_from" id="date_from" class="form-control" 
                                       value="{{ request('date_from') }}">
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group">
                                <label for="date_to">To Date</label>
                                <input type="date" name="date_to" id="date_to" class="form-control" 
                                       value="{{ request('date_to') }}">
                            </div>
                        </div>
                        <div class="col-md-2 d-flex align-items-end">
                            <button type="submit" class="btn btn-gradient btn-block">
                                <i class="fas fa-search"></i> Apply
                            </button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- Sales Table -->
    <div class="card">
        <div class="card-header">
            <div class="d-flex justify-content-between align-items-center">
                <h5 class="mb-0">All Sales</h5>
                <a href="{{ route('sales.create') }}" class="btn btn-gradient">
                    <i class="fas fa-plus"></i> New Sale
                </a>
            </div>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table id="saletable" class="table table-striped table-bordered nowrap" style="width:100%">
                    <thead class="thead-light">
                        <tr>
                            <th>Invoice #</th>
                            <th>Date</th>
                            <th>Customer</th>
                            <th>Items</th>
                            <th class="text-right">Total</th>
                            <th>Created_at</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($sales as $sale)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ $sale->created_at->format('d M Y') }}</td>
                            <td>
                                {{ $sale->customer_name }}<br>
                                <small class="text-muted">{{ $sale->customer_phone }}</small>
                            </td>
                            <td>
                                @if($sale->items->count() > 0)
    {{ $sale->items->first()->product->name ?? 'N/A' }} ({{ $sale->items->first()->quantity }})
    @if($sale->items->count() > 1)
        +{{ $sale->items->count() - 1 }} more
    @endif
@else
    No items
@endif
                            </td>
                            <td class="text-right">{{ number_format($sale->grand_total, 2) }}</td>
                            <td>{{ $sale->created_at }}</td>
                            <td>
                                <a href="{{ route('sales.show', $sale) }}" class="btn btn-sm btn-info" 
                                   title="View Invoice" data-toggle="tooltip">
                                    <i class="fas fa-eye"></i>
                                </a>
                                <a href="#" class="btn btn-sm btn-warning" 
                                   title="Edit" data-toggle="tooltip">
                                    <i class="fas fa-edit"></i>
                                </a> 
                                 <button onclick="confirmDelete('{{ route('sales.destroy', $sale->id) }}')" 
                                        class="btn btn-danger btn-sm">
                                    <i class="fas fa-trash-alt"></i> Delete
                                </button>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="6" class="text-center">No sales found</td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
            
            <!-- Pagination -->
           
        </div>
        <div class="card-footer text-right">
            <strong>Total Sales: {{ number_format($sales->sum('grand_total'), 2) }}</strong>
        </div>
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

<script>
$(document).ready(function() {
    // Initialize tooltips
    $('[data-toggle="tooltip"]').tooltip();
    
    // Set default dates for date filters
    if(!$('#date_from').val()) {
        $('#date_from').val('{{ now()->subDays(30)->format('Y-m-d') }}');
    }
    if(!$('#date_to').val()) {
        $('#date_to').val('{{ now()->format('Y-m-d') }}');
    }

    $('#saletable').DataTable({
        "responsive": true,
        "paging": true,
        "searching": true,
        "ordering": true,
        "info": true,
        "lengthChange": true,
        "lengthMenu": [5, 10, 25, 50, 100],
        "pageLength": 5,
        "order": [[5, "desc"]],
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

});

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


</script>
@endsection