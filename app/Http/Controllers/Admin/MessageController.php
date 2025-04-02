<?php
namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Admin;
use App\Models\AdminMessage;
use App\Models\AdminMessageRecipient;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class MessageController extends Controller
{
    public function index()
    {
        $receivedMessages = AdminMessageRecipient::with(['message.sender', 'recipient'])
            ->where('recipient_id', Auth::guard('admin')->id())
            ->latest()
            ->paginate(10);

            $sentMessages = AdminMessage::with(['recipients.recipient', 'sender'])
            ->where('sender_id', Auth::guard('admin')->id())
            ->latest()
            ->paginate(10);
        return view('admin.messages.index', compact('receivedMessages', 'sentMessages'));
    }

    public function create()
    {
        $admins = Admin::where('id', '!=', Auth::guard('admin')->id())->get();
        return view('admin.messages.create', compact('admins'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'recipients' => 'required|array',
            'recipients.*' => 'exists:admins,id',
            'subject' => 'required|string|max:255',
            'message' => 'required|string',
        ]);

        $message = AdminMessage::create([
            'sender_id' => Auth::guard('admin')->id(),
            'subject' => $request->subject,
            'message' => $request->message,
        ]);

        foreach ($request->recipients as $recipientId) {
            AdminMessageRecipient::create([
                'message_id' => $message->id,
                'recipient_id' => $recipientId,
            ]);
        }

        return redirect()->route('messages.index')->with('success', 'Message sent successfully');
    }

    public function show($id)
    {
        $message = AdminMessageRecipient::with(['message.sender', 'recipient'])
            ->where('id', $id)
            ->where('recipient_id', Auth::guard('admin')->id())
            ->firstOrFail();

        // Mark as read
        if (!$message->is_read) {
            $message->update([
                'is_read' => true,
                'read_at' => now(),
            ]);
        }
        return view('admin.messages.show', compact('message'));
    }

    public function destroy($id)
    {
        $message = AdminMessageRecipient::where('id', $id)
            ->where('recipient_id', Auth::guard('admin')->id())
            ->firstOrFail();

        $message->delete();

        return redirect()->route('messages.index')->with('success', 'Message deleted successfully');
    }
}