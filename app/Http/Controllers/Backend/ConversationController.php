<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Conversation;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class ConversationController extends Controller
{
    //
    public function conversation(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'conversation' => ['required', 'max:140'],
        ], [
            'conversation.required' => 'Message vide',
            'conversation.max' => 'Le message doit avoir 140 caractères maximums',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status' => 400,
                'messages' => $validator->getMessageBag()
            ]);
        } else {

            Conversation::create([
                'ticket_id' => $request->input('ticket_id'),
                'user_id' => Auth::user()->id,
                'conversation' => $request->input('conversation'),
                'created_at' => Carbon::now(),
            ]);

            return response()->json([
                'status' => 200,
                'messages' => 'Message envoyé!',
            ]);
        }
    }
}
