@extends('admin.layout.app')

@section('title', 'Add Brand')

@section('content')
    <h2>Add Brand</h2>

    <!-- Back to Dashboard Button -->
    <a href="{{route('brands.index')}}" class="btn btn-gradient mb-4">
        <i class="fas fa-arrow-left"></i> Back to Brands
    </a>

   

    <!-- Brand Form -->
    <div class="form-container">
        <form action="{{ route('brands.store') }}" method="post" id="brandForm">
            @csrf
            
            <!-- Brand Name -->
            <div class="form-group">
                <label for="brandName"><i class="fas fa-tag"></i> Brand Name</label>
                <input type="text" class="form-control @error('name') is-invalid @enderror" 
                       id="brandName" name="name" 
                       value="{{ old('name') }}" 
                       placeholder="Enter brand name" required>
                @error('name')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <!-- Brand Description -->
            <div class="form-group">
                <label for="brandDescription"><i class="fas fa-align-left"></i> Brand Description</label>
                <textarea class="form-control @error('description') is-invalid @enderror" 
                          id="brandDescription" name="description" 
                          rows="4" placeholder="Enter a short description about the brand">{{ old('description') }}</textarea>
                @error('description')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <!-- Submit Button -->
            <button type="submit" class="btn btn-gradient btn-sm btn-block">
                <i class="fas fa-save"></i> Save Brand
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

  
});
</script>
@endsection