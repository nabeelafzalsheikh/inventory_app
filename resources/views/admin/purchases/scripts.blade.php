@section('scripts')
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

    // Attach event listeners
    $('#quantity, #unit_price, #amount_paid').on('input', calculateTotals);

    // Calculate on page load if values exist
    calculateTotals();
});
</script>
@endsection