@extends('admin.layout.app')

@section('title', 'Edit Product')

@section('content')
    <h2>Edit Product</h2>

    <!-- Back to Dashboard Button -->
    <a href="{{ route('products.index') }}" class="btn btn-gradient mb-4">
        <i class="fas fa-arrow-left"></i> Back to Products
    </a>

    @if(session('success'))
        <div class="alert alert-success alert-dismissible fade show">
            <i class="fas fa-check-circle mr-2"></i> {{ session('success') }}
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
    @endif

    <!-- Product Form -->
    <div class="form-container">
        <form action="{{ route('products.update', $product->id) }}" method="post" id="editProductForm">
            @csrf
            @method('PUT')
            <div class="row">
                <!-- Left Column -->
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="productName"><i class="fas fa-tag"></i> Product Name</label>
                        <input type="text" class="form-control @error('name') is-invalid @enderror" 
                               id="productName" name="name" 
                               value="{{ old('name', $product->name) }}" 
                               placeholder="Enter product name" required>
                        @error('name')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    
                    <div class="form-group">
                        <label for="productSKU"><i class="fas fa-barcode"></i> SKU</label>
                        <input type="text" class="form-control @error('sku') is-invalid @enderror" 
                               id="productSKU" name="sku"
                               value="{{ old('sku', $product->sku) }}" 
                               placeholder="Enter product SKU" required>
                        @error('sku')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    
                    <div class="form-group">
                        <label for="productBrand"><i class="fas fa-building"></i> Brand</label>
                        <select class="form-control @error('brand_id') is-invalid @enderror" 
                                id="productBrand" name="brand_id" required>
                            <option value="">Select brand</option>
                            @foreach($brands as $brand)
                                <option value="{{ $brand->id }}" 
                                    {{ (old('brand_id', $product->brand_id) == $brand->id) ? 'selected' : '' }}>
                                    {{ $brand->name }}
                                </option>
                            @endforeach
                        </select>
                        @error('brand_id')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    
                    <div class="form-group">
                        <label for="productDescription"><i class="fas fa-align-left"></i> Description</label>
                        <textarea class="form-control @error('description') is-invalid @enderror" 
                                  id="productDescription" name="description"
                                  rows="4" placeholder="Enter product description">{{ old('description', $product->description) }}</textarea>
                        @error('description')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>

                <!-- Right Column -->
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="productCategory"><i class="fas fa-list"></i> Category</label>
                        <select class="form-control @error('category_id') is-invalid @enderror" 
                                id="productCategory" name="category_id" required>
                            <option value="">Select category</option>
                            @foreach($categories as $category)
                                <option value="{{ $category->id }}" 
                                    {{ (old('category_id', $product->category_id) == $category->id) ? 'selected' : '' }}>
                                    {{ $category->name }}
                                </option>
                            @endforeach
                        </select>
                        @error('category_id')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    
                    <div class="form-group">
                        <label for="productPrice"><i class="fas fa-dollar-sign"></i> Price</label>
                        <input type="number" class="form-control @error('price') is-invalid @enderror" 
                               id="productPrice" name="price"
                               value="{{ old('price', $product->price) }}" 
                               placeholder="Enter product price" step="0.01" required>
                        @error('price')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    
                    <div class="form-group">
                        <label for="productPieces"><i class="fas fa-boxes"></i> Pieces</label>
                        <input type="number" class="form-control @error('pieces') is-invalid @enderror" 
                               id="productPieces" name="pieces"
                               value="{{ old('pieces', $product->pieces) }}" 
                               placeholder="Enter pieces" required>
                        @error('pieces')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    
                    <div class="form-group">
                        <label for="productStatus"><i class="fas fa-check-circle"></i> Status</label>
                        <select class="form-control @error('status') is-invalid @enderror" 
                                id="productStatus" name="status" required>
                            <option value="instock" {{ old('status', $product->status) == 'in_stock' ? 'selected' : '' }}>In Stock</option>
                            <option value="outofstock" {{ old('status', $product->status) == 'out_of_stock' ? 'selected' : '' }}>Out of Stock</option>
                            <option value="discontinued" {{ old('status', $product->status) == 'discontinued' ? 'selected' : '' }}>Discontinued</option>
                        </select>
                        @error('status')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
            </div>

            <!-- Submit Button -->
            <button type="submit" class="btn btn-gradient btn-sm btn-block">
                <i class="fas fa-save"></i> Update Product
            </button>
        </form>
    </div>

@section('scripts')
<script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.bundle.min.js"></script>
<script>
$(document).ready(function() {
    $('#sidebarToggle').click(function() {
        $('.sidebar').toggleClass('active');
        $('.header').toggleClass('active');
        $('.content').toggleClass('active');
    });

    // Auto-dismiss alerts after 5 seconds
    setTimeout(function() {
        $('.alert').fadeTo(500, 0).slideUp(500, function(){
            $(this).remove(); 
        });
    }, 5000);
});
</script>
@endsection
@endsection