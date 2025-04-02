@extends('admin.layout.app')

@section('content')
<div class="container-fluid">
    <h2>Sales Analysis Dashboard</h2>

    <!-- Month and Year Selection Dropdowns with Submit Button -->
    <div class="row mb-4">
        <div class="col-md-3">
            <div class="form-group">
                <label for="monthSelect"><i class="fas fa-calendar-alt"></i> Select Month</label>
                <select class="form-control" id="monthSelect">
                    @for($i = 1; $i <= 12; $i++)
                        <option value="{{ $i }}" {{ $month == $i ? 'selected' : '' }}>{{ date('F', mktime(0, 0, 0, $i, 1)) }}</option>
                    @endfor
                </select>
            </div>
        </div>
        <div class="col-md-3">
            <div class="form-group">
                <label for="yearSelect"><i class="fas fa-calendar-alt"></i> Select Year</label>
                <select class="form-control" id="yearSelect">
                    @for($i = date('Y'); $i >= 2020; $i--)
                        <option value="{{ $i }}" {{ $year == $i ? 'selected' : '' }}>{{ $i }}</option>
                    @endfor
                </select>
            </div>
        </div>
        <div class="col-md-2">
            <div class="form-group">
                <label>&nbsp;</label>
                <button id="filterBtn" class="btn btn-primary btn-block">
                    <i class="fas fa-filter"></i> Filter
                </button>
            </div>
        </div>
    </div>

    <!-- Cards for Summary Statistics with Icons -->
    <div class="row mb-4">
        <div class="col-md-3">
            <div class="card bg-primary text-white">
                <div class="card-body">
                    <h5 class="card-title"><i class="fas fa-shopping-cart"></i> Total Purchase Price</h5>
                    <p class="card-text">${{ number_format($totalPurchasePrice, 2) }}</p>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card bg-success text-white">
                <div class="card-body">
                    <h5 class="card-title"><i class="fas fa-dollar-sign"></i> Total Sale Price</h5>
                    <p class="card-text">${{ number_format($totalSalePrice, 2) }}</p>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card bg-warning text-white">
                <div class="card-body">
                    <h5 class="card-title"><i class="fas fa-money-bill-wave"></i> Total Amount Payable</h5>
                    <p class="card-text">${{ number_format($totalAmountPayable, 2) }}</p>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card bg-info text-white">
                <div class="card-body">
                    <h5 class="card-title"><i class="fas fa-boxes"></i> Total Sold Items</h5>
                    <p class="card-text">{{ $totalSoldItems }}</p>
                </div>
            </div>
        </div>
    </div>

    <div class="row mb-4">
        <div class="col-md-3">
            <div class="card bg-danger text-white">
                <div class="card-body">
                    <h5 class="card-title"><i class="fas fa-box-open"></i> Total Remaining Items</h5>
                    <p class="card-text">{{ $remainingItems }}</p>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card bg-secondary text-white">
                <div class="card-body">
                    <h5 class="card-title"><i class="fas fa-chart-line"></i> Total Revenue Without Payable</h5>
                    <p class="card-text">${{ number_format($totalRevenueWithoutPayable, 2) }}</p>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card bg-dark text-white">
                <div class="card-body">
                    <h5 class="card-title"><i class="fas fa-chart-bar"></i> Total Revenue With Payable</h5>
                    <p class="card-text">${{ number_format($totalRevenueWithPayable, 2) }}</p>
                </div>
            </div>
        </div>
    </div>

    <!-- Graphs in One Row -->
    <div class="row mb-4">
        <!-- Small Pie Chart -->
        <div class="col-md-4">
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title"><i class="fas fa-chart-pie"></i> Sales Overview</h5>
                    <canvas id="salesPieChart"></canvas>
                </div>
            </div>
        </div>

        <!-- Line Chart -->
        <div class="col-md-8">
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title"><i class="fas fa-chart-line"></i> Sales Trend</h5>
                    <canvas id="salesTrendChart"></canvas>
                </div>
            </div>
        </div>
    </div>

    <!-- Analysis Report Table -->
    <div class="card">
        <div class="card-body">
            <h5 class="card-title"><i class="fas fa-table"></i> Sales Analysis Report</h5>
            <table id="analysisTable" class="table table-striped table-bordered" style="width:100%">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Date</th>
                        <th>Product</th>
                        <th>SKU</th>
                        <th>Category</th>
                        <th>Purchase Price</th>
                        <th>Sale Price</th>
                        <th>Amount Payable</th>
                        <th>Sold Items</th>
                        <th>Remaining Items</th>
                        <th>Revenue Without Payable</th>
                        <th>Revenue With Payable</th>
                        <th>Status</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($tableData as $item)
                    <tr>
                        <td>{{ $item['id'] }}</td>
                        <td>{{ $item['date'] }}</td>
                        <td>{{ $item['product'] }}</td>
                        <td>{{ $item['sku'] }}</td>
                        <td>{{ $item['category'] }}</td>
                        <td>${{ number_format($item['purchase_price'], 2) }}</td>
                        <td>${{ number_format($item['sale_price'], 2) }}</td>
                        <td>${{ number_format($item['amount_payable'], 2) }}</td>
                        <td>{{ $item['sold_items'] }}</td>
                        <td>{{ $item['remaining_items'] }}</td>
                        <td>${{ number_format($item['revenue_without_payable'], 2) }}</td>
                        <td>${{ number_format($item['revenue_with_payable'], 2) }}</td>
                        <td><span class="badge badge-success">{{ $item['status'] }}</span></td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>

<!-- Include jQuery and Bootstrap JS -->
<script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.bundle.min.js"></script>

<!-- Include DataTables CSS and JS -->
<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.24/css/dataTables.bootstrap4.min.css">
<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/responsive/2.2.9/css/responsive.bootstrap4.min.css">
<script type="text/javascript" src="https://cdn.datatables.net/1.10.24/js/jquery.dataTables.min.js"></script>
<script type="text/javascript" src="https://cdn.datatables.net/1.10.24/js/dataTables.bootstrap4.min.js"></script>
<script type="text/javascript" src="https://cdn.datatables.net/responsive/2.2.9/js/dataTables.responsive.min.js"></script>
<script type="text/javascript" src="https://cdn.datatables.net/responsive/2.2.9/js/responsive.bootstrap4.min.js"></script>

<!-- Include Chart.js -->
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

<!-- Include FontAwesome for Icons -->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">

<script>
    $(document).ready(function() {
        // Initialize DataTable with Responsive Extension
        $('#analysisTable').DataTable({
            "paging": true,
            "searching": true,
            "ordering": true,
            "info": true,
            "responsive": true
        });

        // Pie Chart Data
        const pieChartData = {
            labels: {!! json_encode($pieChartData['labels']) !!},
            datasets: [{
                data: {!! json_encode($pieChartData['data']) !!},
                backgroundColor: ['#007bff', '#28a745', '#ffc107'],
            }]
        };

        // Render Pie Chart
        const pieChartCtx = document.getElementById('salesPieChart').getContext('2d');
        new Chart(pieChartCtx, {
            type: 'pie',
            data: pieChartData,
            options: {
                responsive: true,
                plugins: {
                    legend: {
                        position: 'bottom',
                    },
                    tooltip: {
                        callbacks: {
                            label: function(context) {
                                return `${context.label}: $${context.raw.toFixed(2)}`;
                            }
                        }
                    }
                }
            }
        });

        // Line Chart Data
        const salesTrendData = {
            labels: {!! json_encode($lineChartData['labels']) !!},
            datasets: [{
                label: 'Sales Trend',
                data: {!! json_encode($lineChartData['data']) !!},
                borderColor: '#007bff',
                fill: false,
                tension: 0.1
            }]
        };

        // Render Line Chart
        const trendChartCtx = document.getElementById('salesTrendChart').getContext('2d');
        new Chart(trendChartCtx, {
            type: 'line',
            data: salesTrendData,
            options: {
                responsive: true,
                plugins: {
                    legend: {
                        display: true,
                        position: 'bottom',
                    },
                    tooltip: {
                        callbacks: {
                            label: function(context) {
                                return `Sales: $${context.raw.toFixed(2)}`;
                            }
                        }
                    }
                }
            }
        });

        // Filter Button Click Event
        $('#filterBtn').click(function() {
            const month = $('#monthSelect').val();
            const year = $('#yearSelect').val();
            window.location.href = "{{ route('sales.dashboard') }}?month=" + month + "&year=" + year;
        });
    });
</script>
@endsection
