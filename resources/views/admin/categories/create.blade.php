@extends('admin.layout.app')

@section('title', 'Create Category')

@section('content')
    <h2>Create New Category</h2>

    <!-- Back to Dashboard Button -->
    <a class="btn btn-gradient mb-4">
        <i class="fas fa-arrow-left"></i> Back to Dashboard
    </a>

   
    <!-- Category Form -->
    <div class="form-container">
        <form action="{{ route('categories.store') }}" method="POST" id="createCategoryForm">
            @csrf
            
            <div class="row">
                <!-- Left Column -->
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="categoryName"><i class="fas fa-tag"></i> Category Name</label>
                        <input type="text" class="form-control @error('name') is-invalid @enderror" 
                               id="categoryName" name="name" 
                               value="{{ old('name') }}" 
                               placeholder="Enter category name" required>
                        @error('name')
                            <div class="invalid-feedback">
                                <i class="fas fa-exclamation-circle"></i> {{ $message }}
                            </div>
                        @enderror
                    </div>
                </div>

                <!-- Right Column -->
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="categoryStatus"><i class="fas fa-check-circle"></i> Status</label>
                        <select class="form-control @error('status') is-invalid @enderror" 
                                id="categoryStatus" name="status" required>
                            <option value="active" {{ old('status') == 'active' ? 'selected' : '' }}>Active</option>
                            <option value="inactive" {{ old('status') == 'inactive' ? 'selected' : '' }}>Inactive</option>
                        </select>
                        @error('status')
                            <div class="invalid-feedback">
                                <i class="fas fa-exclamation-circle"></i> {{ $message }}
                            </div>
                        @enderror
                    </div>
                </div>
            </div>

            <!-- Description (Single Column) -->
            <div class="form-group">
                <label for="categoryDescription"><i class="fas fa-align-left"></i> Description</label>
                <textarea class="form-control @error('description') is-invalid @enderror" 
                          id="categoryDescription" name="description" 
                          rows="4" placeholder="Enter category description">{{ old('description') }}</textarea>
                @error('description')
                    <div class="invalid-feedback">
                        <i class="fas fa-exclamation-circle"></i> {{ $message }}
                    </div>
                @enderror
            </div>

            <!-- Submit Button -->
            <button type="submit" class="btn btn-gradient btn-sm btn-block">
                <i class="fas fa-plus"></i> Create Category
            </button>
        </form>
    </div>

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