<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Group;
use App\Events\MessageSent;

class ChatsController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function fetchMessages(Request $request)
    { 
        return Group::with('messages.user')->where('id', $request->group_id)->get();
    }

    public function fetchGroups()
    {   
        return Group::whereHas('users', function($query) {
            $query->where('user_id', auth()->user()->id);
        })->get();
    }

    public function sendMessage(Request $request)
    {
        try {
            $message = auth()->user()->messages()->create([
                'message'=> $request->message,
                'group_id' => $request->group_id
            ]);

            broadcast(new MessageSent($message->load('user'), $request->group_id))->toOthers();
        } catch (\Throwable $th) {
           throw $th;
        }
    }

}