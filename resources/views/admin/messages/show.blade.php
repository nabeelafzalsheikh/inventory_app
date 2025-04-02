@extends('admin.layout.app')

@section('title', 'View Message')

@section('content')
<div class="container-fluid">
    <div class="row mb-4">
        <div class="col-md-6">
            <h2>Message</h2>
        </div>
        <div class="col-md-6 text-right">
            <a href="{{ route('messages.index') }}" class="btn btn-secondary">
                <i class="fas fa-arrow-left"></i> Back to Messages
            </a>
        </div>
    </div>

    <div class="card shadow">
        <div class="card-header bg-primary text-white">
            <h4>{{ $message->message->subject }}</h4>
        </div>
        <div class="card-body">
            <div class="row mb-4">
                <div class="col-md-6">
                    <strong>From:</strong> {{ $message->message->sender->name }}
                </div>
                <div class="col-md-6 text-right">
                    <strong>Received:</strong> {{ $message->created_at->format('M j, Y g:i A') }}
                    @if($message->is_read)
                        <span class="badge badge-success ml-2">Read {{ $message->read_at }}</span>
                    @else
                        <span class="badge badge-warning ml-2">Unread</span>
                    @endif
                </div>
            </div>

            <div class="message-content p-3 border rounded">
                {!! nl2br(e($message->message->message)) !!}
            </div>

            <div class="mt-4">
                <form action="{{ route('messages.destroy', $message->id) }}" method="POST" class="d-inline">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-danger" onclick="return confirm('Are you sure?')">
                        <i class="fas fa-trash"></i> Delete
                    </button>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection