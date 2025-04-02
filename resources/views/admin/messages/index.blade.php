@extends('admin.layout.app')

@section('title', 'Messages')

@section('content')
<div class="container-fluid">
    <div class="row mb-4">
        <div class="col-md-6">
            <h2>Messages</h2>
        </div>
        <div class="col-md-6 text-right">
            <a href="{{ route('messages.create') }}" class="btn btn-primary">
                <i class="fas fa-plus"></i> New Message
            </a>
        </div>
    </div>

    <ul class="nav nav-tabs" id="messagesTab" role="tablist">
        <li class="nav-item">
            <a class="nav-link active" id="inbox-tab" data-toggle="tab" href="#inbox" role="tab">Inbox</a>
        </li>
        <li class="nav-item">
            <a class="nav-link" id="sent-tab" data-toggle="tab" href="#sent" role="tab">Sent</a>
        </li>
    </ul>

    <div class="tab-content" id="messagesTabContent">
        <div class="tab-pane fade show active" id="inbox" role="tabpanel">
            <div class="card shadow mt-3">
                <div class="card-body">
                    @if($receivedMessages->isEmpty())
                        <div class="alert alert-info">No messages received</div>
                    @else
                        <div class="table-responsive">
                            <table class="table table-hover">
                                <thead>
                                    <tr>
                                        <th>From</th>
                                        <th>Subject</th>
                                        <th>Received</th>
                                        <th>Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($receivedMessages as $message)
                                        <tr class="{{ $message->is_read ? '' : 'font-weight-bold' }}">
                                            <td>{{ $message->message->sender->name }}</td>
                                            <td>
                                                <a href="{{ route('messages.show', $message->id) }}">
                                                    {{ $message->message->subject }}
                                                </a>
                                            </td>
                                            <td>{{ $message->created_at->diffForHumans() }}</td>
                                            <td>
                                                <form action="{{ route('messages.destroy', $message->id) }}" method="POST" class="d-inline">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('Are you sure?')">
                                                        <i class="fas fa-trash"></i>
                                                    </button>
                                                </form>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                        {{ $receivedMessages->links() }}
                    @endif
                </div>
            </div>
        </div>

        <div class="tab-pane fade" id="sent" role="tabpanel">
            <div class="card shadow mt-3">
                <div class="card-body">
                    @if($sentMessages->isEmpty())
                        <div class="alert alert-info">No messages sent</div>
                    @else
                        <div class="table-responsive">
                            <table class="table table-hover">
                                <thead>
                                    <tr>
                                        <th>To</th>
                                        <th>Subject</th>
                                        <th>Sent</th>
                                        <th>Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($sentMessages as $message)
                                        <tr>
                                            <td>
                                                {{ $message->recipients->pluck('recipient.name')->implode(', ') }}
                                            </td>
                                            <td>{{ $message->subject }}</td>
                                            <td>{{ $message->created_at->diffForHumans() }}</td>
                                            <td>
                                                <a href="#" class="btn btn-sm btn-info">
                                                    <i class="fas fa-eye"></i>
                                                </a>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                        {{ $sentMessages->links() }}
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
<!-- Include jQuery and Bootstrap JS -->
<script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.bundle.min.js"></script>

<script>
$(document).ready(function() {
    // Initialize Bootstrap tabs
    $('#messagesTab a').on('click', function (e) {
        e.preventDefault();
        $(this).tab('show');
    });

    // Optional: Remember the last active tab
    $('a[data-toggle="tab"]').on('shown.bs.tab', function (e) {
        localStorage.setItem('lastTab', $(e.target).attr('href'));
    });
    
    // Restore last active tab if available
    var lastTab = localStorage.getItem('lastTab');
    if (lastTab) {
        $('#messagesTab a[href="' + lastTab + '"]').tab('show');
    }
});
</script>
@endsection