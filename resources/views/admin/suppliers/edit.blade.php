@extends('admin.layout.app')

@section('title', 'Edit Supplier')

@section('content')
<h2>Edit Supplier</h2>

<!-- Back to Dashboard Button -->
<a href="{{ route('suppliers.index') }}" class="btn btn-gradient mb-4">
    <i class="fas fa-arrow-left"></i> Back to Suppliers
</a>

<!-- Supplier Form -->
<div class="form-container">
    <form action="{{ route('suppliers.update', $supplier) }}" method="POST">
        @csrf
        @method('PUT')
        
        <div class="row">
            <!-- Left Column -->
            <div class="col-md-6">
                <div class="form-group">
                    <label for="name"><i class="fas fa-building"></i> Supplier Name</label>
                    <input type="text" class="form-control @error('name') is-invalid @enderror" 
                           id="name" name="name" placeholder="Enter supplier name" 
                           value="{{ old('name', $supplier->name) }}" required>
                    @error('name')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
                <div class="form-group">
                    <label for="contact_person_name"><i class="fas fa-user"></i> Contact Person</label>
                    <input type="text" class="form-control @error('contact_person_name') is-invalid @enderror" 
                           id="contact_person_name" name="contact_person_name" 
                           placeholder="Enter contact person" 
                           value="{{ old('contact_person_name', $supplier->contact_person_name) }}" required>
                    @error('contact_person_name')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
                <div class="form-group">
                    <label for="phone"><i class="fas fa-phone"></i> Phone</label>
                    <input type="text" class="form-control @error('phone') is-invalid @enderror" 
                           id="phone" name="phone" placeholder="Enter phone number" 
                           value="{{ old('phone', $supplier->phone) }}" required>
                    @error('phone')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
            </div>

            <!-- Right Column -->
            <div class="col-md-6">
                <div class="form-group">
                    <label for="email"><i class="fas fa-envelope"></i> Email</label>
                    <input type="email" class="form-control @error('email') is-invalid @enderror" 
                           id="email" name="email" placeholder="Enter email address" 
                           value="{{ old('email', $supplier->email) }}" required>
                    @error('email')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
                <div class="form-group">
                    <label for="address"><i class="fas fa-map-marker-alt"></i> Address</label>
                    <textarea class="form-control @error('address') is-invalid @enderror" 
                              id="address" name="address" rows="3" 
                              placeholder="Enter address" required>{{ old('address', $supplier->address) }}</textarea>
                    @error('address')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
            </div>
        </div>

        <!-- Submit Button -->
        <button type="submit" class="btn btn-gradient btn-sm btn-block">
            <i class="fas fa-save"></i> Update Supplier
        </button>
    </form>
</div>
<!-- Include jQuery and Bootstrap JS -->
<script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.bundle.min.js"></script>

<script>
$(document).ready(function() {
    // Sidebar Toggle
    $('#sidebarToggle').click(function() {
        $('.sidebar').toggleClass('active');
        $('.header').toggleClass('active');
        $('.content').toggleClass('active');
    });

    });
</script>
@endsection