<!-- Header -->
<div class="header">
    <div class="header-title">Inventory Management</div>
    <div class="header-buttons d-flex align-items-center">
        <!-- Sidebar Toggle Button -->
        <button id="sidebarToggle" class="btn btn-light">
            <i class="fas fa-bars"></i>
        </button>

        <!-- Notification Dropdown -->
        <!-- <div class="dropdown ml-3">
            <button class="btn btn-light position-relative" type="button" id="notificationDropdown" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                <i class="fas fa-bell"></i>
                <span class="badge badge-danger position-absolute" style="top: 0; right: 0; font-size: 12px;">2</span>
            </button>
            <div class="dropdown-menu dropdown-menu-right" aria-labelledby="notificationDropdown" style="width: 300px;">
                <h6 class="dropdown-header">Notifications</h6>
                <a class="dropdown-item d-flex align-items-center" href="#">
                    <div class="mr-2">
                        <i class="fas fa-exclamation-circle fa-2x text-warning"></i>
                    </div>
                    <div>
                        <strong>Low Stock Alert</strong>
                        <p class="small text-muted mb-0">Product XYZ is running low.</p>
                    </div>
                </a>
                <a class="dropdown-item d-flex align-items-center" href="#">
                    <div class="mr-2">
                        <i class="fas fa-check-circle fa-2x text-success"></i>
                    </div>
                    <div>
                        <strong>Order Shipped</strong>
                        <p class="small text-muted mb-0">Order #123 has been shipped.</p>
                    </div>
                </a>
                <a class="dropdown-item text-center text-primary" href="#">View All Notifications</a>
            </div>
        </div> -->

        <!-- Message Dropdown -->
        <div class="dropdown ml-3">
            <button class="btn btn-light position-relative" type="button" id="messageDropdown" 
                    data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                <i class="fas fa-envelope"></i>
                @php
                    $unreadCount = auth()->guard('admin')->user()->unreadMessages()->count();
                @endphp
                @if($unreadCount > 0)
                    <span class="badge badge-danger position-absolute" style="top: 0; right: 0; font-size: 12px;">
                        {{ $unreadCount }}
                    </span>
                @endif
            </button>
            <div class="dropdown-menu dropdown-menu-right" aria-labelledby="messageDropdown" style="width: 300px;">
                <h6 class="dropdown-header">Messages</h6>
                
                @php
                    $recentMessages = auth()->guard('admin')->user()->recentMessages(5);
                    @endphp
                
                @forelse($recentMessages as $message)
                    <a class="dropdown-item d-flex align-items-center" href="{{ route('messages.show', $message->id) }}">
                        <div class="mr-2">
                            <i class="fas fa-user-circle fa-2x {{ $message->is_read ? 'text-secondary' : 'text-primary' }}"></i>
                        </div>
                        <div>
                            <strong class="{{ $message->is_read ? '' : 'font-weight-bold' }}">
                                {{ $message->sender ? $message->sender->name : 'System' }}
                            </strong>
                            <p class="small text-muted mb-0 text-truncate" style="max-width: 200px;">
                                {{ $message->subject }}
                            </p>
                            <small class="text-muted">
                                {{ $message->created_at->diffForHumans() }}
                            </small>
                        </div>
                    </a>
                @empty
                    <div class="dropdown-item text-muted">No new messages</div>
                @endforelse
                
                <div class="dropdown-divider"></div>
                <a class="dropdown-item text-center text-primary" href="{{ route('messages.index') }}">
                    View All Messages
                </a>
            </div>
        </div>

        <!-- Logout Button -->
        <form method="POST" action="{{ route('admin.logout') }}">
            @csrf
            <button type="submit" class="btn btn-light ml-3"><i class="fas fa-sign-out-alt"></i></button>
        </form>
        </div>
</div>
<script>
$(document).ready(function() {
    function updateMessageCount() {
        $.get('{{ route('messages.unread-count') }}', function(data) {
            const badge = $('#messageDropdown .badge');
            if (data.count > 0) {
                badge.text(data.count).show();
            } else {
                badge.hide();
            }
        });
    }
    
    // Update immediately
    updateMessageCount();
    
    // Then update every 60 seconds
    setInterval(updateMessageCount, 60000);
});
</script>
