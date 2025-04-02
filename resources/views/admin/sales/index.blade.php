@extends('admin.layout.app')

@section('title', 'Sales List')

@section('content')
<div class="container-fluid">
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
                <table class="table table-hover">
                    <thead class="thead-light">
                        <tr>
                            <th>Invoice #</th>
                            <th>Date</th>
                            <th>Customer</th>
                            <th>Items</th>
                            <th class="text-right">Total</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($sales as $sale)
                        <tr>
                            <td>{{ $sale->invoice_number }}</td>
                            <td>{{ $sale->created_at->format('d M Y') }}</td>
                            <td>
                                {{ $sale->customer_name }}<br>
                                <small class="text-muted">{{ $sale->customer_phone }}</small>
                            </td>
                            <td>
                                @foreach($sale->items as $item)
                                    {{ $item->product->name }} ({{ $item->quantity }})<br>
                                @endforeach
                            </td>
                            <td class="text-right">{{ number_format($sale->grand_total, 2) }}</td>
                            <td>
                                <a href="{{ route('sales.show', $sale) }}" class="btn btn-sm btn-info" 
                                   title="View Invoice" data-toggle="tooltip">
                                    <i class="fas fa-eye"></i>
                                </a>
                                <a href="#" class="btn btn-sm btn-warning" 
                                   title="Edit" data-toggle="tooltip">
                                    <i class="fas fa-edit"></i>
                                </a>
                                <form action="{{ route('sales.destroy', $sale) }}" method="POST" 
                                      style="display: inline-block;">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-sm btn-danger" 
                                            title="Delete" data-toggle="tooltip"
                                            onclick="return confirm('Are you sure you want to delete this sale?')">
                                        <i class="fas fa-trash"></i>
                                    </button>
                                </form>
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
            <div class="d-flex justify-content-center mt-4">
                {{ $sales->appends(request()->query())->links() }}
            </div>
        </div>
        <div class="card-footer text-right">
            <strong>Total Sales: {{ number_format($sales->sum('grand_total'), 2) }}</strong>
        </div>
    </div>
</div>
<script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.bundle.min.js"></script>

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
});
</script>
@endsection