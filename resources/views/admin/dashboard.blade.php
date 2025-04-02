@extends('admin.layout.app')

@section('title', 'Dashboard')

@section('content')
    <h2>Dashboard</h2>
    <p>Welcome to the Inventory Management System. Manage your inventory efficiently and effectively.</p>

    <!-- Cards -->
    <div class="row">
        <!-- Total Products -->
        <div class="col-md-3 mb-4">
            <div class="card bg-primary text-white">
                <div class="card-body">
                    <h5 class="card-title"><i class="fas fa-box"></i> Total Products</h5>
                    <p class="card-text display-4">{{ number_format($totalProducts) }}</p>
                    <a href="{{ route('products.index') }}" class="btn btn-outline-light btn-sm">View Details</a>
                </div>
            </div>
        </div>

        <!-- Total Stock Value -->
        <div class="col-md-3 mb-4">
            <div class="card bg-info text-white">
                <div class="card-body">
                    <h5 class="card-title"><i class="fas fa-dollar-sign"></i> Total Stock Value</h5>
                    <p class="card-text display-4">${{ number_format($totalStockValue, 2) }}</p>
                    <a href="{{ route('products.index') }}" class="btn btn-outline-light btn-sm">View Details</a>
                </div>
            </div>
        </div>

        <!-- Out of Stock -->
        <div class="col-md-3 mb-4">
            <div class="card bg-danger text-white">
                <div class="card-body">
                    <h5 class="card-title"><i class="fas fa-exclamation-circle"></i> Out of Stock</h5>
                    <p class="card-text display-4">{{ $outOfStock }}</p>
                    <a href="{{ route('products.index', ['status' => 'outofstock']) }}" class="btn btn-outline-light btn-sm">View Details</a>
                </div>
            </div>
        </div>

        <!-- Low Stock -->
        <div class="col-md-3 mb-4">
            <div class="card bg-orange text-white">
                <div class="card-body">
                    <h5 class="card-title"><i class="fas fa-exclamation-triangle"></i> Low Stock</h5>
                    <p class="card-text display-4">{{ number_format($lowStock) }}</p>
                    <a href="{{ route('products.index', ['status' => 'lowstock']) }}" class="btn btn-outline-light btn-sm">View Details</a>
                </div>
            </div>
        </div>

        <!-- Total Sale Today -->
        <div class="col-md-3 mb-4">
            <div class="card bg-purple text-white">
                <div class="card-body">
                    <h5 class="card-title"><i class="fas fa-chart-line"></i> Total Sale Today</h5>
                    <p class="card-text display-4">${{ number_format($totalSaleToday, 2) }}</p>
                    <a href="{{ route('sales.index', ['date' => today()->format('Y-m-d')]) }}" class="btn btn-outline-light btn-sm">View Details</a>
                </div>
            </div>
        </div>

        <!-- Amount Payable -->
        <div class="col-md-3 mb-4">
            <div class="card bg-teal text-white">
                <div class="card-body">
                    <h5 class="card-title"><i class="fas fa-money-bill-wave"></i> Amount Payable</h5>
                    <p class="card-text display-4">${{ number_format($amountPayable, 2) }}</p>
                    <a href="{{ route('purchases.index') }}" class="btn btn-outline-light btn-sm">View Details</a>
                </div>
            </div>
        </div>

        <!-- Today Revenue -->
        <div class="col-md-3 mb-4">
            <div class="card bg-green text-white">
                <div class="card-body">
                    <h5 class="card-title"><i class="fas fa-coins"></i> Today Revenue</h5>
                    <p class="card-text display-4">${{ number_format($todayRevenue, 2) }}</p>
                    <a href="{{ route('sales.index', ['date' => today()->format('Y-m-d')]) }}" class="btn btn-outline-light btn-sm">View Details</a>
                </div>
            </div>
        </div>

        <!-- Monthly Revenue -->
        <div class="col-md-3 mb-4">
            <div class="card bg-indigo text-white">
                <div class="card-body">
                    <h5 class="card-title"><i class="fas fa-chart-area"></i> Monthly Revenue</h5>
                    <p class="card-text display-4">${{ number_format($monthlyRevenue, 2) }}</p>
                    <a href="{{ route('sales.index', ['month' => today()->format('Y-m')]) }}" class="btn btn-outline-light btn-sm">View Details</a>
                </div>
            </div>
        </div>
    </div>

    <!-- Bar Chart for Monthly Sales Report -->
    <div class="row mt-4">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <h5 class="card-title"><i class="fas fa-chart-bar"></i> Monthly Sales Report</h5>
                </div>
                <div class="card-body">
                    <canvas id="monthlySalesChart"></canvas>
                </div>
            </div>
        </div>
    </div>

<!-- Include jQuery, Bootstrap JS, and Chart.js -->
<script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.bundle.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

<script>
    $(document).ready(function() {
        // Sidebar Toggle
        $('#sidebarToggle').click(function() {
            $('.sidebar').toggleClass('active');
            $('.header').toggleClass('active');
            $('.content').toggleClass('active');
        });

        // Bar Chart for Monthly Sales Report
        const ctx = document.getElementById('monthlySalesChart').getContext('2d');
        const monthlySalesChart = new Chart(ctx, {
            type: 'bar',
            data: {
                labels: @json($monthlySalesData['labels']),
                datasets: [{
                    label: 'Monthly Sales ($)',
                    data: @json($monthlySalesData['data']),
                    backgroundColor: 'rgba(54, 162, 235, 0.5)',
                    borderColor: 'rgba(54, 162, 235, 1)',
                    borderWidth: 1
                }]
            },
            options: {
                scales: {
                    y: {
                        beginAtZero: true
                    }
                }
            }
        });
    });
</script>

<!-- Custom CSS for Additional Card Colors -->
<style>
    .bg-orange {
        background-color: #ff9800 !important;
    }
    .bg-purple {
        background-color: #9c27b0 !important;
    }
    .bg-teal {
        background-color: #009688 !important;
    }
    .bg-green {
        background-color: #4caf50 !important;
    }
    .bg-indigo {
        background-color: #3f51b5 !important;
    }
    .card.text-white .card-body * {
        color: white !important;
    }
    .btn-outline-light {
        border-color: white;
        color: white;
    }
    .btn-outline-light:hover {
        background-color: rgba(255, 255, 255, 0.1);
    }
</style>
@endsection