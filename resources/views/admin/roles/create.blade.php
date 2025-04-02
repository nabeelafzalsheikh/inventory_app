@extends('admin.layout.app')

@section('title', 'Dashboard')

@section('content')
<h2>Role and Permission Form</h2>

    <!-- Back to Dashboard Button -->
    <a href="dashboard.html" class="btn btn-gradient mb-4">
        <i class="fas fa-arrow-left"></i> Back to Dashboard
    </a>
    @if ($errors->any())
    <div class="alert alert-danger">
        <ul class="mb-0">
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif
    <!-- Role and Permission Form -->
    <div class="form-container">
        <form id="rolePermissionForm" method="POST" action="{{ route('roles.store') }}">
            @csrf
            <div class="row">
                <!-- Left Column -->
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="roleName"><i class="fas fa-user-tag"></i> Role Name</label>
                        <input type="text" class="form-control" id="name" name="name" placeholder="Enter role name" required>
                    </div>
                </div>

                <!-- Right Column -->
                <div class="col-md-6">
                    <div class="form-group">
                        <label><i class="fas fa-key"></i> Permissions</label>
                        <div class="permissions-list">
                            @foreach($permissions as $permission)
        <div class="form-check">
            <input type="checkbox" class="form-check-input" id="permission_{{ $permission->id }}" 
                   name="permissions[]" value="{{ $permission->id }}" 
                   {{ in_array($permission->id, old('permissions', [])) ? 'checked' : '' }}>
            <label class="form-check-label" for="permission_{{ $permission->id }}">{{ $permission->name }}</label>
        </div>
    @endforeach
                        </div>
                    </div>
                </div>
            </div>

            <!-- Submit Button -->
            <button type="submit" class="btn btn-gradient btn-sm btn-block">
                <i class="fas fa-save"></i> Save Role and Permissions
            </button>
        </form>
    </div>
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
