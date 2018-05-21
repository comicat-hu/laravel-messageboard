<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Message;
use App\Repositories\MessageRepository;

class MessageController extends Controller
{
    /**
     * The repository instance.
     *
     * @var MessageRepository
     */
    protected $messages;

    /**
     * Create a new controller instance.
     *
     * @param  MessageRepository  $messages
     * @return void
     */
    public function __construct(MessageRepository $messages)
    {
        $this->middleware('auth');

        $this->messages = $messages;
    }

    /**
     * Display a list of all of the user's message.
     *
     * @param  Request  $request
     * @return Response
     */
    public function index(Request $request)
    {
        return view('messages.index', [
            'messages' => $this->messages->forUser($request->user()),
        ]);
    }

    /**
     * Create a new message.
     *
     * @param  Request  $request
     * @return Response
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'name' => 'required|max:255',
        ]);

        $request->user()->messages()->create([
            'name' => $request->name,
        ]);

        return redirect('messages');
    }

    public function destroy(Request $request, Message $message)
    {
        $this->authorize('destroy', $message);
        
        $message->delete();

        return redirect('/messages');
    }
}
