@extends('admin.layout.app')

@section('title', 'Invoice Details')

@section('content')
<div class="container">
    <div class="card">
        <div class="card-header">
            <h2>Invoice: {{ $sale->invoice_number }}</h2>
        </div>
        <div class="card-body">
            <div class="row mb-4">
                <div class="col-md-6">
                    <h4>Customer Information</h4>
                    <p><strong>Name:</strong> {{ $sale->customer_name }}</p>
                    <p><strong>Phone:</strong> {{ $sale->customer_phone }}</p>
                </div>
                <div class="col-md-6 text-right">
                    <p><strong>Date:</strong> {{ $sale->created_at->format('d M Y') }}</p>
                    <p><strong>Invoice #:</strong> {{ $sale->invoice_number }}</p>
                </div>
            </div>

            <div class="table-responsive">
                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th>Product</th>
                            <th>Quantity</th>
                            <th>Unit Price</th>
                            <th>Total</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($sale->items as $item)
                        <tr>
                            <td>{{ $item->product->name }}</td>
                            <td>{{ $item->quantity }}</td>
                            <td>{{ number_format($item->unit_price, 2) }}</td>
                            <td>{{ number_format($item->total_price, 2) }}</td>
                        </tr>
                        @endforeach
                    </tbody>
                    <tfoot>
                        <tr>
                            <th colspan="3" class="text-right">Grand Total:</th>
                            <th>{{ number_format($sale->grand_total, 2) }}</th>
                        </tr>
                    </tfoot>
                </table>
            </div>

            <div class="mt-4">
                <a href="{{ route('sales.create') }}" class="btn btn-gradient">
                    <i class="fas fa-plus"></i> New Sale
                </a>
                <button onclick="window.print()" class="btn btn-primary">
                    <i class="fas fa-print"></i> Print Invoice
                </button>
            </div>
        </div>
    </div>
</div>
@endsection