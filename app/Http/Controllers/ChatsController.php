<?php

namespace App\Http\Controllers;

use App\Models\Chat;
use App\Models\Message;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Support\Facades\Storage;
use Pusher\Pusher;

class ChatsController extends Controller
{
    public function __construct() 
    {  
        $this->middleware(['auth']);
    }

    public function viewDirects(){
        return view('chats.chats');
    }

    public function getDirects(){
        $userId = Auth::user()->id;
        $chats = Chat::when($userId, function ($query, $userId) {
            return $query->join('users', function ($join) use ($userId) {
                $join->on('chats.to', '=', 'users.id')
                     ->where('chats.from', $userId)
                     ->orWhere(function ($query) use ($userId) {
                         $query->on('chats.from', '=', 'users.id')
                               ->where('chats.to', $userId);
                     });
            });
        })
        ->where('chats.status', 1)
        ->whereNull('chats.AcceptFrom')
        ->whereNull('chats.AcceptTo')
        ->select(['chats.*', 'users.photo as photo', 'users.UserName as UserName', 'users.subscribed as verify'])
        ->get();
        
        $peoples = [];
        foreach($chats as $chat){
            $peoples[] = view('components.chats.people', [
                'name' => $chat->UserName, 'photo' => $chat->photo, 'id' => $chat->id, 'verify' => $chat->verify
            ])->render();
        }
        return $peoples;
    }

    public function viewTransactions(){
        $userId = Auth::user()->id;
        $chats = Chat::when($userId, function ($query, $userId) {
            return $query->join('users', function ($join) use ($userId) {
                $join->on('chats.to', '=', 'users.id')
                     ->where('chats.from', $userId)
                     ->orWhere(function ($query) use ($userId) {
                         $query->on('chats.from', '=', 'users.id')
                               ->where('chats.to', $userId);
                     });
            });
        })
        ->where('chats.status', 1)
        ->whereNotNull('AcceptFrom')
        ->whereNotNull('AcceptTo')
        ->select(['chats.*', 'users.photo as photo', 'users.UserName as UserName', 'users.subscribed as verify'])
        ->get();
        
        $peoples = [];
        foreach($chats as $chat){
            $peoples[] = view('components.chats.people', [
                'name' => $chat->UserName, 'photo' => $chat->photo, 'id' => $chat->id, 'verify' => $chat->verify
            ])->render();
        }
        return $peoples;
    }

    public function showChat(Chat $chat){
        $messages = Message::join('users', 'messages.user', '=', 'users.id')->where('messages.chat', $chat->id)->
            where('messages.status', '!=', 0)->select('messages.*', 'users.photo as photo', 'users.UserName as UserName')->get();

        $views = [];
        foreach($messages as $message){
            $views[] = view('components.chats.messages.'.($message->user == auth()->user()->id ? 'my' : 'your'), [
                'text' => $message->body, 'time' => $message->created_at->format('H:i'),
                'photo' => Storage::url($message->photo), 'name' => $message->UserName
            ])->render();
        }
        return $views;
    }

    public function storeChat(Request $request){
        $validated = $request->validate([
            'to' => ['required','integer'],
        ]);

        $data = array_merge($validated, [
            'from' => auth()->user()->id,
            'AcceptFrom' => $request->has('type') ? 0 : null,
            'AcceptTo' => $request->has('type') ? 0 : null,
        ]);

        $verify = Chat::where('from', $data['from'])->where('to', $data['to'])->where('chats.status', 1)->first();
        if($verify === null){
            $CurrentChat = Chat::create($data);
        } else {
            $CurrentChat = $verify;
        }

        return redirect()->route('chat.directs.view', ['CurrentChat' => $CurrentChat]);
    }

    public function destroyChat(Chat $chat){
        $chat->status = 0;
        $messages = Message::where('chat', $chat->id)->get();
        foreach($messages as $message){
            $message->status = 0;
            $message->save();
        }

        return back();
    }

    public function updateChatTime(Chat $chat){
        $chat->time += 48;
        $chat->update();

        return back();
    }

    public function updateChatAccept(Request $request, Chat $chat){
        if($request->input('accept') != null){
            $chat->AcceptTo = 1;
        }else{
            $chat->AcceptFrom = 1;
        }

        $chat->update();

        return back();
    }

    private function CreateMessage($request, $id){
        $validated = $request->validate([
            'message' => ['required', 'string'],
        ]);

        Message::create([
            'chat' => $id,
            'user' => auth()->user()->id,
            'body' => $validated['message']
        ]);
    }

    public function storeMessage(Request $request, Chat $chat){
        self::CreateMessage($request, $chat->id);

        return back();
    }

    public function destroyMessage(Message $message){
        $message->update(['status'=>0]);

        return back();
    }

    private function SendMessage($message)
    {
        $pusher = new Pusher(
            config('broadcasting.connections.pusher.key'),
            config('broadcasting.connections.pusher.secret'),
            config('broadcasting.connections.pusher.app_id'),
            array(
                'cluster' => config('broadcasting.connections.pusher.options.cluster'),
                'useTLS' => config('broadcasting.connections.pusher.options.useTLS')
            )
        );
    
        $pusher->trigger('public', 'chat', ['message' => $message, 'socket_id' => request()->get('socket_id')]);
    }

    public function broadcast(Request $request): Factory|View|Application
    {
        self::SendMessage($request->get('message'));
        self::CreateMessage($request, $request->get('chat'));

        return view('components.chats.messages.my', [
            'text' => $request->get('message'), 'time' => now()->format('H:i')
        ]);
    }

    public function receive(Request $request): Factory|View|Application
    {
        $userId = Auth::user()->id;
        $chat = Chat::when($userId, function ($query, $userId) {
            return $query->join('users', function ($join) use ($userId) {
                $join->on('chats.to', '=', 'users.id')
                    ->where('chats.from', $userId)
                    ->orWhere(function ($query) use ($userId) {
                        $query->on('chats.from', '=', 'users.id')
                            ->where('chats.to', $userId);
                    });
            });
        })
        ->where('chats.status', 1)
        ->where('chats.id', $request->get('chat'))
        ->select(['chats.*', 'users.photo as photo', 'users.UserName as UserName'])
        ->first();
        return view('components.chats.messages.your', [
            'text' => $request->get('message'), 'time' => now()->format('H:i'), 'photo' => $chat->photo, 'name' => $chat->UserName
        ]);
    }
}
