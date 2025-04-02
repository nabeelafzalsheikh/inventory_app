@extends('admin.layout.app')

@section('title', 'Edit Purchase Entry')

@section('content')
<h2>Edit Purchase Entry</h2>

<!-- Back to Dashboard Button -->
<a href="{{ route('purchases.index') }}" class="btn btn-gradient mb-4">
    <i class="fas fa-arrow-left"></i> Back to Purchases
</a>

<!-- Purchase Form -->
<div class="form-container">
    <form action="{{ route('purchases.update', $purchase) }}" method="POST" id="purchaseForm">
        @csrf
        @method('PUT')
        
        <div class="row">
            <!-- Left Column -->
            <div class="col-md-6">
                <div class="form-group">
                    <label for="product_id"><i class="fas fa-box"></i> Product</label>
                    <select class="form-control @error('product_id') is-invalid @enderror" 
                            id="product_id" name="product_id" required>
                        <option value="">Select product</option>
                        @foreach($products as $product)
                            <option value="{{ $product->id }}" 
                                {{ $purchase->product_id == $product->id ? 'selected' : '' }}>
                                {{ $product->name }}
                            </option>
                        @endforeach
                    </select>
                    @error('product_id')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
                <div class="form-group">
                    <label for="quantity"><i class="fas fa-boxes"></i> Quantity</label>
                    <input type="number" class="form-control @error('quantity') is-invalid @enderror" 
                           id="quantity" name="quantity" placeholder="Enter quantity" 
                           value="{{ old('quantity', $purchase->quantity) }}" required>
                    @error('quantity')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
                <div class="form-group">
                    <label for="unit_price"><i class="fas fa-tag"></i> Unit Price</label>
                    <input type="number" class="form-control @error('unit_price') is-invalid @enderror" 
                           id="unit_price" name="unit_price" placeholder="Enter unit price" 
                           step="0.01" value="{{ old('unit_price', $purchase->unit_price) }}" required>
                    @error('unit_price')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
                <div class="form-group">
                    <label for="lot_number"><i class="fas fa-barcode"></i> Lot Number</label>
                    <input type="text" class="form-control @error('lot_number') is-invalid @enderror" 
                           id="lot_number" name="lot_number" placeholder="Enter lot number" 
                           value="{{ old('lot_number', $purchase->lot_number) }}" required>
                    @error('lot_number')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
                <div class="form-group">
                    <label for="expiry_date"><i class="fas fa-calendar-alt"></i> Expiry Date</label>
                    <input type="date" class="form-control @error('expiry_date') is-invalid @enderror" 
                           id="expiry_date" name="expiry_date" 
                           value="{{ old('expiry_date', $purchase->expiry_date->format('Y-m-d')) }}" required>
                    @error('expiry_date')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
            </div>

            <!-- Right Column -->
            <div class="col-md-6">
                <div class="form-group">
                    <label for="supplier_id"><i class="fas fa-truck"></i> Supplier</label>
                    <select class="form-control @error('supplier_id') is-invalid @enderror" 
                            id="supplier_id" name="supplier_id" required>
                        <option value="">Select supplier</option>
                        @foreach($suppliers as $supplier)
                            <option value="{{ $supplier->id }}" 
                                {{ $purchase->supplier_id == $supplier->id ? 'selected' : '' }}>
                                {{ $supplier->name }}
                            </option>
                        @endforeach
                    </select>
                    @error('supplier_id')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
                <div class="form-group">
                    <label for="total_price"><i class="fas fa-calculator"></i> Total Price</label>
                    <input type="number" class="form-control" id="total_price" 
                           name="total_price" placeholder="Total price" 
                           value="{{ old('total_price', $purchase->total_price) }}" readonly>
                </div>
                <div class="form-group">
                    <label for="amount_paid"><i class="fas fa-money-bill-wave"></i> Amount Paid</label>
                    <input type="number" class="form-control @error('amount_paid') is-invalid @enderror" 
                           id="amount_paid" name="amount_paid" placeholder="Enter amount paid" 
                           step="0.01" value="{{ old('amount_paid', $purchase->amount_paid) }}" required>
                    @error('amount_paid')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
                <div class="form-group">
                    <label for="remaining_balance"><i class="fas fa-balance-scale"></i> Remaining Balance</label>
                    <input type="number" class="form-control" id="remaining_balance" 
                           name="remaining_balance" placeholder="Remaining balance" 
                           value="{{ old('remaining_balance', $purchase->remaining_balance) }}" readonly>
                </div>
                <div class="form-group">
                    <label for="notes"><i class="fas fa-sticky-note"></i> Notes</label>
                    <textarea class="form-control @error('notes') is-invalid @enderror" 
                              id="notes" name="notes" rows="4" 
                              placeholder="Enter additional notes">{{ old('notes', $purchase->notes) }}</textarea>
                    @error('notes')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
            </div>
        </div>

        <!-- Submit Button -->
        <button type="submit" class="btn btn-gradient btn-sm btn-block">
            <i class="fas fa-save"></i> Update Purchase Entry
        </button>
    </form>
</div>

<script>
$(document).ready(function() {
    // Calculate Total Price and Remaining Balance
    function calculateTotals() {
        const quantity = parseFloat($('#quantity').val()) || 0;
        const unitPrice = parseFloat($('#unit_price').val()) || 0;
        const amountPaid = parseFloat($('#amount_paid').val()) || 0;

        const totalPrice = quantity * unitPrice;
        const remainingBalance = totalPrice - amountPaid;

        $('#total_price').val(totalPrice.toFixed(2));
        $('#remaining_balance').val(remainingBalance.toFixed(2));
    }

    // Attach event listeners to input fields
    $('#quantity, #unit_price, #amount_paid').on('input', calculateTotals);

    // Calculate on page load
    calculateTotals();
});
</script>
@endsection