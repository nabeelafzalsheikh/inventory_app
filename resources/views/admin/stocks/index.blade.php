@extends('admin.layout.app')

@section('content')
<div class="container">
    <h2>Stock List</h2>
    <table id="stockTable" class="table table-striped table-bordered" style="width:100%">
        <thead>
            <tr>
                <th>#</th>
                <th>Product Name</th>
                <th>Quantity</th>
                <th>Total Amount</th>
                <th>Stock Status</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach($stocks as $stock)
            <tr>
                <td>{{ $loop->iteration }}</td>
                <td>{{ $stock->product->name ?? null }}</td>
                <td>{{ $stock->quantity ?? 0 }}</td>
                <td>{{ number_format($stock->total_stock_value) }}</td>
                <td>
                    @php
                        $quantity = $stock->quantity ?? 0;
                    @endphp
                    @if($quantity > 10)
                        <span class="badge badge-success">In Stock</span>
                    @elseif($quantity > 0)
                        <span class="badge badge-warning">Low Stock</span>
                    @else
                        <span class="badge badge-danger">Out of Stock</span>
                    @endif
                </td>
                <td>
                    <a href="{{ route('stocks.details', $stock->id) }}" class="btn btn-sm btn-info">
                        <i class="fas fa-eye"></i> View Details
                    </a>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
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
        // Show it after 500ms (0.5 seconds)
        

        $('#stockTable').DataTable({
           "responsive": true,
        "paging": true,
        "searching": true,
        "ordering": true,
        "info": true,
        "lengthChange": true,
        "lengthMenu": [5, 10, 25, 50, 100],
        "pageLength": 5,
        
        });
    });
</script>
@endsection
