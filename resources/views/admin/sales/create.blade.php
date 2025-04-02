@extends('admin.layout.app')

@section('title', 'Billing & Invoice Form')

@section('content')
<h2>Billing & Invoice Form</h2>

<!-- Back to Dashboard Button -->
<a  class="btn btn-gradient mb-4">
    <i class="fas fa-arrow-left"></i> Back to Dashboard
</a>

<!-- Sell Form -->
<div class="form-container">
    <form id="sellForm" action="{{ route('sales.store') }}" method="POST">
        @csrf
        
        <!-- Customer Information -->
        <div class="row">
            <div class="col-md-6">
                <div class="form-group">
                    <label for="customerName"><i class="fas fa-user"></i> Customer Name</label>
                    <input type="text" class="form-control @error('customer_name') is-invalid @enderror" 
                           id="customerName" name="customer_name" placeholder="Enter customer name" 
                           value="{{ old('customer_name') }}" required>
                    @error('customer_name')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-group">
                    <label for="customerPhone"><i class="fas fa-phone"></i> Customer Phone</label>
                    <input type="text" class="form-control @error('customer_phone') is-invalid @enderror" 
                           id="customerPhone" name="customer_phone" placeholder="Enter customer phone" 
                           value="{{ old('customer_phone') }}" required>
                    @error('customer_phone')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
            </div>
        </div>

        <!-- Items Table -->
        <div class="table-responsive">
            <table id="itemsTable" class="table table-bordered">
                <thead>
                    <tr>
                        <th>Product</th>
                        <th>Quantity</th>
                        <th>Unit Price</th>
                        <th>Total Price</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    <!-- Initial Row -->
                    <tr>
                        <td>
                            <select class="form-control product @error('items.0.product_id') is-invalid @enderror" 
                                    name="items[0][product_id]" required>
                                <option value="">Select product</option>
                                @foreach($products as $product)
                                    <option value="{{ $product->id }}">
                                        {{ $product->name }}
                                    </option>
                                @endforeach
                            </select>
                            @error('items.0.product_id')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </td>
                        <td>
                            <input type="number" class="form-control quantity @error('items.0.quantity') is-invalid @enderror" 
                                   name="items[0][quantity]" placeholder="Quantity" required>
                            @error('items.0.quantity')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </td>
                        <td>
                            <input type="number" class="form-control unitPrice @error('items.0.unit_price') is-invalid @enderror" 
                                   name="items[0][unit_price]" placeholder="Unit Price" step="0.01" required>
                            @error('items.0.unit_price')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </td>
                        <td>
                            <input type="number" class="form-control totalPrice" 
                                   name="items[0][total_price]" placeholder="Total Price" readonly>
                        </td>
                        <td>
                            <button type="button" class="btn btn-danger btn-sm removeRow">
                                <i class="fas fa-trash"></i>
                            </button>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>

        <!-- Add Item Button -->
        <button type="button" id="addItem" class="btn btn-success btn-sm mb-3">
            <i class="fas fa-plus"></i> Add Item
        </button>

        <!-- Grand Total -->
        <div class="form-group">
            <label for="grandTotal"><i class="fas fa-calculator"></i> Grand Total</label>
            <input type="number" class="form-control" id="grandTotal" 
                   name="grand_total" placeholder="Grand Total" readonly>
        </div>

        <!-- Submit Button -->
        <button type="submit" class="btn btn-gradient btn-sm btn-block">
            <i class="fas fa-save"></i> Save Sale
        </button>
    </form>
</div>
<script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.bundle.min.js"></script>

<script>
    $(document).ready(function() {
        let rowCount = 1;

        // Add Item Row
        $('#addItem').click(function() {
            const newRow = `
                <tr>
                    <td>
                        <select class="form-control product" name="items[${rowCount}][product_id]" required>
                            <option value="">Select product</option>
                            @foreach($products as $product)
                                <option value="{{ $product->id }}">
                                    {{ $product->name }}
                                </option>
                            @endforeach
                        </select>
                    </td>
                    <td>
                        <input type="number" class="form-control quantity" 
                               name="items[${rowCount}][quantity]" placeholder="Quantity" required>
                    </td>
                    <td>
                        <input type="number" class="form-control unitPrice" 
                               name="items[${rowCount}][unit_price]" placeholder="Unit Price" step="0.01" required>
                    </td>
                    <td>
                        <input type="number" class="form-control totalPrice" 
                               name="items[${rowCount}][total_price]" placeholder="Total Price" readonly>
                    </td>
                    <td>
                        <button type="button" class="btn btn-danger btn-sm removeRow">
                            <i class="fas fa-trash"></i>
                        </button>
                    </td>
                </tr>
            `;
            $('#itemsTable tbody').append(newRow);
            rowCount++;
        });

        // Remove Item Row
        $(document).on('click', '.removeRow', function() {
            if($('#itemsTable tbody tr').length > 1) {
                $(this).closest('tr').remove();
                calculateGrandTotal();
            } else {
                alert('You must have at least one item.');
            }
        });

        // Calculate Total Price for Each Row
        $(document).on('input', '.quantity, .unitPrice', function() {
            const row = $(this).closest('tr');
            const quantity = parseFloat(row.find('.quantity').val()) || 0;
            const unitPrice = parseFloat(row.find('.unitPrice').val()) || 0;
            const totalPrice = quantity * unitPrice;
            row.find('.totalPrice').val(totalPrice.toFixed(2));
            calculateGrandTotal();
        });

        // Calculate Grand Total
        function calculateGrandTotal() {
            let grandTotal = 0;
            $('#itemsTable tbody tr').each(function() {
                const totalPrice = parseFloat($(this).find('.totalPrice').val()) || 0;
                grandTotal += totalPrice;
            });
            $('#grandTotal').val(grandTotal.toFixed(2));
        }

        // Initialize calculations
        calculateGrandTotal();
    });
</script>
@endsection