@extends('admin.layout.app')

@section('title', 'Create Product')

@section('content')

<h2>Create New Product</h2>

<!-- Back to Dashboard Button -->
<a href="{{route('products.index')}}" class="btn btn-gradient mb-4">
    <i class="fas fa-arrow-left"></i> Back to Products
</a>

<!-- Product Form -->
<div class="form-container">
    <form action="{{ route('products.store') }}" method="post" id="createProductForm">
        @csrf
        <div class="row">
            <!-- Left Column -->
            <div class="col-md-6">
                <div class="form-group">
                    <label for="productName"><i class="fas fa-tag"></i> Product Name</label>
                    <input type="text" class="form-control" id="productName" name="name" 
                           value="{{ old('name') }}" placeholder="Enter product name" required>
                    @error('name')
                        <div class="text-danger">{{ $message }}</div>
                    @enderror
                </div>
                
                <div class="form-group">
                    <label for="productSKU"><i class="fas fa-barcode"></i> SKU</label>
                    <input type="text" class="form-control" id="productSKU" name="sku"
                           value="{{ old('sku') }}" placeholder="Enter product SKU" required>
                    @error('sku')
                        <div class="text-danger">{{ $message }}</div>
                    @enderror
                </div>
                
                <div class="form-group">
                    <label for="productBrand"><i class="fas fa-building"></i> Brand</label>
                    <select class="form-control select2-search" id="productBrand" name="brand_id" required>
                        <option value="">Select brand</option>
                        @foreach($brands as $brand)
                            <option value="{{ $brand->id }}" {{ old('brand_id') == $brand->id ? 'selected' : '' }}>
                                {{ $brand->name }}
                            </option>
                        @endforeach
                    </select>
                    @error('brand_id')
                        <div class="text-danger">{{ $message }}</div>
                    @enderror
                </div>
                
                <div class="form-group">
                    <label for="productDescription"><i class="fas fa-align-left"></i> Description</label>
                    <textarea class="form-control" id="productDescription" name="description"
                              rows="4" placeholder="Enter product description">{{ old('description') }}</textarea>
                    @error('description')
                        <div class="text-danger">{{ $message }}</div>
                    @enderror
                </div>
            </div>

            <!-- Right Column -->
            <div class="col-md-6">
                <div class="form-group">
                    <label for="productCategory"><i class="fas fa-list"></i> Category</label>
                    <select class="form-control select2-search" id="productCategory" name="category_id" required>
                        <option value="">Select category</option>
                        @foreach($categories as $category)
                            <option value="{{ $category->id }}" {{ old('category_id') == $category->id ? 'selected' : '' }}>
                                {{ $category->name }}
                            </option>
                        @endforeach
                    </select>
                    @error('category_id')
                        <div class="text-danger">{{ $message }}</div>
                    @enderror
                </div>
                
                <div class="form-group">
                    <label for="productPrice"><i class="fas fa-dollar-sign"></i> Price</label>
                    <input type="number" class="form-control" id="productPrice" name="price"
                           value="{{ old('price') }}" placeholder="Enter product price" step="0.01" required>
                    @error('price')
                        <div class="text-danger">{{ $message }}</div>
                    @enderror
                </div>
                
                <div class="form-group">
                    <label for="productPieces"><i class="fas fa-boxes"></i> Pieces</label>
                    <input type="number" class="form-control" id="productPieces" name="pieces"
                           value="{{ old('pieces') }}" placeholder="Enter pieces" required>
                    @error('pieces')
                        <div class="text-danger">{{ $message }}</div>
                    @enderror
                </div>
                
                <div class="form-group">
                    <label for="productStatus"><i class="fas fa-check-circle"></i> Status</label>
                    <select class="form-control select2-search" id="productStatus" name="status" required>
                        <option value="instock" {{ old('status') == 'instock' ? 'selected' : '' }}>In Stock</option>
                        <option value="outofstock" {{ old('status') == 'outofstock' ? 'selected' : '' }}>Out of Stock</option>
                        <option value="discontinued" {{ old('status') == 'discontinued' ? 'selected' : '' }}>Discontinued</option>
                    </select>
                    @error('status')
                        <div class="text-danger">{{ $message }}</div>
                    @enderror
                </div>
            </div>
        </div>

        <!-- Submit Button -->
        <button type="submit" class="btn btn-gradient btn-sm btn-block">
            <i class="fas fa-plus"></i> Create Product
        </button>
    </form>
</div>

<!-- Add Select2 CSS -->
<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
<style>
    /* Adjust Select2 height to match Bootstrap form controls */
    .select2-container--default .select2-selection--single {
        height: calc(2.25rem + 2px) !important;
        padding: 0.375rem 0.75rem !important;
        font-size: 1rem !important;
        line-height: 1.5 !important;
        border: 1px solid #ced4da !important;
        border-radius: 0.25rem !important;
    }
    
    .select2-container--default .select2-selection--single .select2-selection__arrow {
        height: calc(2.25rem + 2px) !important;
    }
    
    .select2-container--default .select2-selection--single .select2-selection__rendered {
        line-height: 1.5 !important;
    }
    
    /* Make sure the dropdown matches the input width */
    .select2-container {
        width: 100% !important;
    }
</style>

<script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.bundle.min.js"></script>
<script>
$(document).ready(function() {
    $('#sidebarToggle').click(function() {
        $('.sidebar').toggleClass('active');
        $('.header').toggleClass('active');
        $('.content').toggleClass('active');
    });
    
    // Initialize Select2 for all dropdowns with class 'select2-search'
    $('.select2-search').select2({
        placeholder: function() {
            return $(this).data('placeholder') || 'Select an option';
        },
        width: 'resolve'
    });
});
</script>

@endsection