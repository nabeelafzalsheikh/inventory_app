@extends('admin.layout.app')

@section('title', 'Dashboard')

@section('content')
<h2>Permissions Form</h2>

<!-- Back to Dashboard Button -->
<a href="dashboard.php" class="btn btn-gradient mb-4">
    <i class="fas fa-arrow-left"></i> Back to Dashboard
</a>

<!-- Permissions Form -->
<div class="form-container">
    <form id="permissionsForm" method="POST" action="{{ route('permissions.store') }}">
        @csrf
        <!-- Field Name -->
        <div class="form-group">
            <label for="fieldName"><i class="fas fa-key"></i> Permission Name</label>
            <input type="text" class="form-control" id="name" name="name" placeholder="Enter permission name" required>
        </div>

        <!-- Submit Button -->
        <button type="submit" class="btn btn-gradient btn-block">
            <i class="fas fa-save"></i> Save Permission
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
