@extends('admin.layout.app')

@section('content')
<div class="container">
    <h2>Stock List</h2>
    <table id="stockTable" class="table table-striped table-bordered" style="width:100%">
        <thead>
            <tr>
                <th>ID</th>
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
                <td>{{ $stock->id }}</td>
                <td>{{ $stock->product->name }}</td>
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

<!-- Include jQuery, Bootstrap JS, and DataTables -->
<script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.bundle.min.js"></script>
<script src="https://cdn.datatables.net/1.10.21/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.10.21/js/dataTables.bootstrap4.min.js"></script>

<!-- DataTables CSS -->
<link rel="stylesheet" href="https://cdn.datatables.net/1.10.21/css/dataTables.bootstrap4.min.css">

<script>
    $(document).ready(function() {
        $('#stockTable').DataTable({
            "paging": true,
            "searching": true,
            "ordering": true,
            "info": true,
            "responsive": true
        });
    });
</script>
@endsection
