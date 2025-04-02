@extends('admin.layout.app')

@section('title', isset($admin) ? 'Edit Admin' : 'Add Admin')

@section('content')
<h2>{{ isset($admin) ? 'Edit' : 'Add' }} Admin</h2>

<!-- Back Button -->
<a href="{{ route('admins.index') }}" class="btn btn-gradient mb-4">
    <i class="fas fa-arrow-left"></i> Back to Admins
</a>

<!-- Admin Form -->
<div class="form-container">
    <form id="adminForm" action="{{ isset($admin) ? route('admins.update', $admin->id) : route('admins.store') }}" method="POST">
        @csrf
        @if(isset($admin))
            @method('PUT')
        @endif

        <div class="row">
            <!-- Left Column -->
            <div class="col-md-6">
                <div class="form-group">
                    <label for="name"><i class="fas fa-user"></i> Name</label>
                    <input type="text" class="form-control @error('name') is-invalid @enderror" 
                           id="name" name="name" 
                           value="{{ old('name', $admin->name ?? '') }}" 
                           placeholder="Enter name" required>
                    @error('name')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
                
                <div class="form-group">
                    <label for="email"><i class="fas fa-envelope"></i> Email</label>
                    <input type="email" class="form-control @error('email') is-invalid @enderror" 
                           id="email" name="email" 
                           value="{{ old('email', $admin->email ?? '') }}" 
                           placeholder="Enter email" required>
                    @error('email')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
            </div>

            <!-- Right Column -->
            <div class="col-md-6">
                <div class="form-group">
                    <label for="password"><i class="fas fa-lock"></i> Password</label>
                    <input type="password" class="form-control @error('password') is-invalid @enderror" 
                           id="password" name="password" 
                           placeholder="Enter password" {{ !isset($admin) ? 'required' : '' }}>
                    @error('password')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
                
                <div class="form-group">
                    <label for="password_confirmation"><i class="fas fa-lock"></i> Confirm Password</label>
                    <input type="password" class="form-control" 
                           id="password_confirmation" name="password_confirmation" 
                           placeholder="Confirm password" {{ !isset($admin) ? 'required' : '' }}>
                </div>
            </div>
        </div>

        <!-- Roles Section -->
        <div class="form-group ">
            <label><i class="fas fa-user-tag"></i> Roles</label>
            <div class="dropdown">
                <button class="btn btn-secondary dropdown-toggle w-100 text-left" type="button" 
                        id="rolesDropdown" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    Select Roles
                </button>
                <div class="dropdown-menu " aria-labelledby="rolesDropdown">
                    @foreach($roles as $role)
                        <div class="dropdown-item">
                            <div class="custom-control custom-checkbox">
                                <input type="checkbox" class="custom-control-input role-checkbox" 
                                       id="role-{{ $role->id }}" 
                                       name="roles[]" 
                                       value="{{ $role->id }}"
                                       {{ in_array($role->id, old('roles', $adminRoles ?? [])) ? 'checked' : '' }}>
                                <label class="custom-control-label" for="role-{{ $role->id }}">
                                    {{ $role->name }}
                                </label>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
            <div id="selectedRoles" class="mt-2">
                @php
                    $selectedRoles = old('roles', $adminRoles ?? []);
                    $selectedRoleNames = $roles->whereIn('id', $selectedRoles)->pluck('name');
                @endphp
                @foreach($selectedRoleNames as $name)
                    <span class="badge badge-primary mr-1">{{ $name }}</span>
                @endforeach
            </div>
            @error('roles')
                <div class="text-danger small">{{ $message }}</div>
            @enderror
        </div>
        

        <!-- Submit Button -->
        <button type="submit" class="btn btn-gradient btn-sm btn-block mt-4">
            <i class="fas fa-save"></i> {{ isset($admin) ? 'Update' : 'Save' }} Admin
        </button>
    </form>
</div>
<script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.bundle.min.js"></script>

<script>
$(document).ready(function() {
    // Form validation
    $('#adminForm').on('submit', function(e) {
        // You can add additional client-side validation here if needed
        const password = $('#password').val();
        const confirm = $('#password_confirmation').val();
        
        if (password && password !== confirm) {
            alert('Password and confirmation do not match!');
            e.preventDefault();
        }
    });

    // Toggle password fields requirement for edit
    @if(isset($admin))
        $('#password, #password_confirmation').removeAttr('required');
    @endif

    $('.role-checkbox').change(function() {
        const selectedNames = [];
        $('.role-checkbox:checked').each(function() {
            selectedNames.push($(this).next('label').text());
        });
        
        const dropdownBtn = $('#rolesDropdown');
        if (selectedNames.length > 0) {
            dropdownBtn.text(selectedNames.join(', '));
        } else {
            dropdownBtn.text('Select Roles');
        }
        
        // Update the badges display
        $('#selectedRoles').html(
            selectedNames.map(name => `<span class="badge badge-primary mr-1">${name}</span>`).join('')
        );
    });
    
    // Prevent dropdown from closing when clicking inside
    $('.dropdown-menu').on('click', function(e) {
        e.stopPropagation();
    });
});
</script>
@endsection
