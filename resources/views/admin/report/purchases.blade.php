@extends('admin.layout.app')

@section('content')
<div class="container-fluid">
    <h2>Purchase Report</h2>

    <!-- Filter Section -->
    <div class="card mb-4">
        <div class="card-body">
            <h5 class="card-title"><i class="fas fa-filter"></i> Filters</h5>
            <form id="filterForm" method="GET" action="{{ route('purchases.report') }}">
                <div class="row align-items-end">
                    <!-- Product Filter -->
                    <div class="col-md-3">
                        <div class="form-group">
                            <label for="product">Product</label>
                            <select class="form-control" id="product" name="product">
                                <option value="">All Products</option>
                                @foreach($products as $product)
                                    <option value="{{ $product->id }}" 
                                        {{ request('product') == $product->id ? 'selected' : '' }}>
                                        {{ $product->name }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                    </div>

                    <!-- Date Filter -->
                    <div class="col-md-3">
                        <div class="form-group">
                            <label for="date">Date</label>
                            <input type="date" class="form-control" id="date" name="date" 
                                   value="{{ request('date') }}">
                        </div>
                    </div>

                    <!-- Supplier Filter -->
                    <div class="col-md-3">
                        <div class="form-group">
                            <label for="supplier">Supplier</label>
                            <select class="form-control" id="supplier" name="supplier">
                                <option value="">All Suppliers</option>
                                @foreach($suppliers as $supplier)
                                    <option value="{{ $supplier->id }}" 
                                        {{ request('supplier') == $supplier->id ? 'selected' : '' }}>
                                        {{ $supplier->name }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                    </div>

                    <!-- Action Buttons -->
                    <div class="col-md-3">
                        <div class="form-group">
                            <button type="submit" class="btn btn-primary">
                                <i class="fas fa-filter"></i> Apply Filters
                            </button>
                            <a href="{{ route('purchases.report') }}" class="btn btn-secondary">
                                <i class="fas fa-undo"></i> Reset
                            </a>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>

    <!-- Purchase Report Table -->
    <div class="card">
        <div class="card-body">
            <div >
                <table id="purchaseReportTable" class="table table-striped table-bordered nowrap" style="width:100%">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Purchase Date</th>
                            <th>Supplier</th>
                            <th>Product</th>
                            <th>Quantity</th>
                            <th>Total Amount</th>
                            <th>Amount Paid</th>
                            <th>Amount Payable</th>
                            <th>Created_at</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($purchases as $purchase)
                        <tr>
                            <td>{{ $purchase->id }}</td>
                            <td>{{ $purchase->created_at->format('Y-m-d') }}</td>
                            <td>{{ $purchase->supplier->name }}</td>
                            <td>{{ $purchase->product->name }}</td>
                            <td>{{ $purchase->quantity }}</td>
                            <td>${{ number_format($purchase->total_price, 2) }}</td>
                            <td>${{ number_format($purchase->amount_paid, 2) }}</td>
                            <td>${{ number_format($purchase->remaining_balance, 2) }}</td>
                            <td>{{ $purchase->created_at}}</td>
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
            
            
        </div>
    </div>
</div>

    <!-- DataTables CSS -->
    <style>
        #purchaseReportTable {
            width: 100%;
            margin-top: 20px;
        }

        #purchaseReportTable th {
            background-color: #007bff;
            color: #fff;
        }

        #purchaseReportTable td {
            vertical-align: middle;
        }
        
        .pagination {
            justify-content: center;
        }
    </style>

  
    <script>
        $(document).ready(function() {
            // Initialize DataTable with server-side processing disabled
            $('#purchaseReportTable').DataTable({
                "responsive": true,
        "paging": true,
        "searching": true,
        "ordering": true,
        "info": true,
        "lengthChange": true,
        "lengthMenu": [5, 10, 25, 50, 100],
        "pageLength": 5,
        "order": [[8, "desc"]],
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
    </script>
    @endsection
