@extends('admin.layout.app')

@section('content')
<div class="container">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h2>Stock Details: {{ $stock->product->name }}</h2>
        <a href="{{ route('stocks.index') }}" class="btn btn-primary">
            <i class="fas fa-arrow-left"></i> Back to Stock List
        </a>
    </div>

    <div class="card mb-4">
        <div class="card-body">
            <div class="row">
                <div class="col-md-4">
                    <h5>Total Quantity</h5>
                    <p class="display-4">{{ $stock->quantity }}</p>
                </div>
                <div class="col-md-4">
                    <h5>Total Value</h5>
                    <p class="display-4">${{ number_format($stock->total_stock_value) }}</p>
                </div>
                <div class="col-md-4">
                    <h5>Stock Status</h5>
                    @php
                        $quantity = $stock->quantity ?? 0;
                    @endphp
                    @if($quantity > 10)
                        <span class="badge badge-success p-2" style="font-size: 1.2rem;">In Stock</span>
                    @elseif($quantity > 0)
                        <span class="badge badge-warning p-2" style="font-size: 1.2rem;">Low Stock</span>
                    @else
                        <span class="badge badge-danger p-2" style="font-size: 1.2rem;">Out of Stock</span>
                    @endif
                </div>
            </div>
        </div>
    </div>

    <h4>Purchase Records</h4>
    <table class="table table-bordered">
        <thead>
            <tr>
                <th>Purchase Date</th>
                <th>Supplier</th>
                <th>Quantity</th>
                <th>Unit Price</th>
                <th>Total Price</th>
                <th>Lot Number</th>
                <th>Expiry Date</th>
                <th>Notes</th>
            </tr>
        </thead>
        <tbody>
            @foreach($purchases as $purchase)
            <tr>
                <td>{{ $purchase->created_at->format('Y-m-d') }}</td>
                <td>{{ $purchase->supplier->name }}</td>
                <td>{{ $purchase->quantity }}</td>
                <td>${{ number_format($purchase->unit_price, 2) }}</td>
                <td>${{ number_format($purchase->total_price, 2) }}</td>
                <td>{{ $purchase->lot_number }}</td>
                <td>{{ $purchase->expiry_date->format('Y-m-d') }}</td>
                <td>{{ $purchase->notes ?? 'N/A' }}</td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection